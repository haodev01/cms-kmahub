<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\ConstantsHelper;
use App\Helpers\FileUpload;
use App\Http\Controllers\Controller;
use App\Http\Requests\LessonEditRequest;
use App\Models\Lesson;
use App\Models\Section;
use Exception;
use FFMpeg;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
        $lessons = Lesson::paginate(10);
        return view('admin.pages.lessons.index', compact('lessons'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $lessons = Section::all();
        return view('admin.pages.lessons.create', compact('lessons'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $data = [
            'name' => $request->input('name'),
            'section_id' => $request->input('section_id'),
            'status' => $request->input('status') ?? 'draft',
        ];
        $durationInSeconds = 0;
        if ($request->hasFile('video')) {
            $video = FileUpload::video($request->hasFile('videos/lessons'),);
            if (Storage::disk('public')->exists($video)) {
                $ffmpeg = FFMpeg::fromDisk('public')->open($video);
                $durationInSeconds = $ffmpeg->getDurationInSeconds();
            }
            $data['video'] = $video;
            $data['duration'] = $durationInSeconds;
        }
        Lesson::create($data);
        return redirect()->back();
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
    public function edit(string $id)
    {
        //
        $lesson = Lesson::find($id);
        $sections = Section::all();
        return view('admin.pages.lessons.edit', compact('lesson', 'sections'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function updateContent(LessonEditRequest $request, string $id): JsonResponse
    {
        $lessson = Lesson::find($id);
        $statusDraft = ConstantsHelper::LIST_STATUS['draft']['key'];
        $data = [
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'status' => $request->input('status') ?? $statusDraft,
        ];
        $video = $this->createVideoLesson($request, $lessson);
        if (Storage::disk('public')->exists($video)) {
            $ffmpeg = FFMpeg::fromDisk('public')->open($video);
            $durationInSeconds = $ffmpeg->getDurationInSeconds();
            $data['duration'] = $durationInSeconds;
        }
        if (!$video && !$lessson->video && $data['status'] !== $statusDraft) {
            return response()->json(
                ['errors' => [
                    'video' => ['Video không  được để trống'],
                    'status' => ['Bạn vui lòng chon video để thay đổi trạng thái']
                ]
                ])->setStatusCode(422);
        } else if ($video) {
            $data['video'] = $video;
        }
        $lessson->update($data);
        $lessson->save();
        return response()->json(['message' => 'Cập nhật bài học thành công']);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function destroyMany(Request $request): JsonResponse
    {
        try {
            $itemIds = $request->get('itemIds');
            Lesson::whereIn('id', $itemIds)->delete();
            return response()->json(['success' => 'Xóa bài học thành công']);
        } catch (Exception $exception) {
            return response()->json(['error' => $exception->getMessage()]);
        }
    }

    public function updateOrder(Request $request): JsonResponse
    {
        $orders = $request->input('orders');
        $news = Lesson::find($orders['new']['id']);
        $old = Lesson::find($orders['old']['id']);
        $old->order = (int)$orders['old']['order'];
        $old->update();
        $news->order = (int)$orders['new']['order'];
        $news->update();

        return response()->json($news);
//        dd($request->all());
    }

    public function createVideoLesson(Request $request, $lessson): bool|string
    {
        if ($request->hasFile('video')) {
            $video = FileUpload::video($request->file('video'), 'videos/sections/' . $lessson->section->id);
            if ($lessson->video) {
                FileUpload::delete($lessson->video);
            }
            return $video;
        }
        return false;
    }
}
