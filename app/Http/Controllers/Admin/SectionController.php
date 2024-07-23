<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\FilterHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateSectionRequest;
use App\Models\Course;
use App\Models\Section;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $courses = Course::select('id', 'name')->get();
        $sections = Section::query();
        $sections = FilterHelper::filterSearchFromRequest($sections, $request);
        $sections = FilterHelper::filterStatusFromRequest($sections, $request);
        $sections = FilterHelper::filterCourseFromRequest($sections, $request);
        $sections = $sections->sortable();
        $sections = $sections->paginate(10);
        return view('admin.pages.sections.index', compact('sections', 'courses'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $courses = Course::all();
        return view('admin.pages.sections.create', compact('courses'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CreateSectionRequest $request): RedirectResponse
    {
        try {
            $data = [
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'course_id' => $request->input('course_id'),
                'status' => $request->input('status') ?? 'active',
            ];
            Section::create($data);
            return redirect()->back()->with('success', 'Thêm chương học thành công');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
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
    public function edit(string $id)
    {
        //
        $section = Section::find($id);
        $courses = Course::all();
        return view('admin.pages.sections.edit', compact('section', 'courses'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        try {
            $data = [
                'name' => $request->input('name'),
                'description' => $request->input('description'),
                'status' => $request->input('status') ?? 'active',
            ];
            Section::find($id)->update($data);
            return redirect()->back()->with('success', 'Cập nhật chương học thành công');
        } catch (Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        try {
            $section = Section::find($id);
            $section->delete();
            return response()->json(['success' => 'Xóa chương học thành công.']);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()]);
        }
    }

    public function destroyMany(Request $request): JsonResponse
    {
        try {
            $itemIds = $request->get('itemIds');
            Section::whereIn('id', $itemIds)->delete();
            return response()->json(['success' => 'Xóa chương học thành công']);
        } catch (Exception $exception) {
            return response()->json(['error' => $exception->getMessage()]);
        }

    }
}
