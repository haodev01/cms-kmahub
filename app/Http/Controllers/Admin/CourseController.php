<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\FileUpload;
use App\Helpers\FilterHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateCourseRequest;
use App\Http\Requests\EditCourseRequest;
use App\Models\Admin;
use App\Models\Category;
use App\Models\Course;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use FFMpeg;
use Illuminate\Support\Facades\Storage;

class CourseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $admins = Admin::all();
        $courses = Course::query();
        $courses = FilterHelper::filterStatusFromRequest($courses, $request);
        $courses = FilterHelper::filterSearchFromRequest($courses, $request);
        $courses = FilterHelper::filterLevelFromRequest($courses, $request);
        $courses = FilterHelper::filterCreatedFromRequest($courses, $request);
        $courses = $courses->with(['category', 'createdBy'])->sortable()->paginate(10);
        return view('admin.pages.courses.index', compact('courses', 'admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $categories = Category::all();
        return view('admin.pages.courses.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $request->validated();
            $thumb = FileUpload::image($request->file('thumbnail'));
            $video_preview = FileUpload::video($request->file('video'));
            $durationInSeconds = 0;
            if (Storage::disk('public')->exists($video_preview)) {
                $ffmpeg = FFMpeg::fromDisk('public')->open($video_preview);
                $durationInSeconds = $ffmpeg->getDurationInSeconds();
            }
            $data = [
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'slug' => $request->input('slug'),
                'category_id' => $request->input('category_id'),
                'thumbnail' => $thumb,
                'video_preview' => $video_preview,
                'status' => $request->input('status') ?? 'active',
                'price_original' => $request->input('price_original'),
                'price_sale' => $request->input('price_sale'),
                'level' => $request->input('level') ?? 'beginner',
                'duration' => $durationInSeconds,
            ];
            $course = Course::create($data);
            $this->createRequirementsForCourse($course, $request->input('requirments'));
            $this->createBenefitsForCourse($course, $request->input('benefits'));
            return response()->json([
                "data" => [
                    "id" => $course->id
                ]
            ]);
        } catch (Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id): View
    {
        //
        $categories = Category::all();
        $course = Course::find($id);
        return view('admin.pages.courses.edit', compact('course', 'categories'));
    }


    public function updateForm(EditCourseRequest $request, string $id)
    {
        $data = [
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'category_id' => $request->input('category_id'),
            'status' => $request->input('status') ?? 'active',
            'price_original' => $request->input('price_original'),
            'price_sale' => $request->input('price_sale'),
            'level' => $request->input('level') ?? 'beginner',
        ];
        $course = Course::findOrFail($id);
        $data = $this->updateThumbnailAndVideoForCourse($request, $course, $data);
        $course->update($data);
        $course->requirements()->delete();
        $this->createRequirementsForCourse($course, $request->input('requirments'));
        $course->benefits()->delete();
        $this->createBenefitsForCourse($course, $request->input('benefits'));
        return response()->json();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        try {
            $course = Course::find($id);
            $course->delete();
            return response()->json(['success' => 'Xóa khóa học thành công.']);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function updateContent($id): View
    {
        $course = Course::find($id);
        $course = $course->with('sections.lessons')->first();
    
        return view('admin.pages.courses.update-content', compact('id', 'course'));
    }

    public function destroyMany(Request $request): JsonResponse
    {
        try {
            $itemIds = $request->get('itemIds');
            Course::whereIn('id', $itemIds)->delete();
            return response()->json(['success' => 'Xóa khóa học thành công']);
        } catch (Exception $exception) {
            return response()->json(['error' => $exception->getMessage()]);
        }
    }

    function createRequirementsForCourse($course, $requirements): void
    {
        $requirements = array_filter($requirements ?? []);
        foreach ($requirements as $requirement) {
            $course->requirements()->create([
                'requirement' => $requirement
            ]);
        }
    }

    function createBenefitsForCourse($course, $benefits): void
    {
        $benefits = array_filter($benefits ?? []);
        foreach ($benefits as $benefit) {
            $course->benefits()->create([
                'name' => $benefit
            ]);
        }
    }

    function updateThumbnailAndVideoForCourse($request, $course, $data)
    {
        if ($request->hasFile('thumbnail')) {
            {
                $thumb = FileUpload::image($request->file('thumbnail'));
                if (!$thumb) {
                    return redirect()->back()->withErrors(['message' => 'Thumbnail upload failed.'])->withInput();
                }
                $data['thumbnail'] = $thumb;
                FileUpload::delete($course->thumbnail);
            }
        }
        if ($request->hasFile('video')) {
            {
                $video = FileUpload::video($request->file('video'));
                if (!$video) {
                    return redirect()->back()->withErrors(['error' => 'Thumbnail upload failed.'])->withInput();
                }
                $data['video_preview'] = $video;
                FileUpload::delete($course->video_preview);
            }
        }
        return $data;
    }
}
