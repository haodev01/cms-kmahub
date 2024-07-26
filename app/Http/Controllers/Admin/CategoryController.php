<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\FilterHelper;
use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Models\Admin;
use App\Models\Category;
use Exception;
use Illuminate\Contracts\View\View;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $admins = Admin::all();
        $categories = Category::query();
        $categories = FilterHelper::filterStatusFromRequest($categories, $request);
        $categories = FilterHelper::filterSearchFromRequest($categories, $request);
        $categories = $categories->sortable()->paginate(10);
        return view('admin.pages.categories.index', compact('categories', 'admins'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        //
        $query = Category::where('parent_id', null);
        $categories = Category::scopeActive($query)->get();
        return view('admin.pages.categories.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(CategoryRequest $request): RedirectResponse
    {
        $data = [
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'status' => $request->input('status') ?? 'active',
            'parent_id' => $request->input('parent_id') ?? null
        ];
        try {
            Category::create($data);
            return redirect()->route('course-categories.index');
        } catch (Exception $exception) {
            if ($exception->errorInfo[1] === 1062) {
                return redirect()->back()->withErrors(['message' => 'Danh mục đã tồn tại trong hệ thống'])->withInput();
            }
            return redirect()->back()->withErrors(['message' => $exception->getMessage()])->withInput();
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
        $category = Category::findOrFail($id);
        $categories = Category::where('parent_id', null)->get();
        return view('admin.pages.categories.edit', compact('categories', 'category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(CategoryRequest $request, string $id): RedirectResponse
    {
        //
        $data = [
            'name' => $request->input('name'),
            'description' => $request->input('description'),
            'status' => $request->input('status') ?? 'active',
            'parent_id' => $request->input('parent_id') ?? null
        ];

        $category = Category::findOrFail($id);
        $category->update($data);
        if ($category) {
            return redirect()->route('course-categories.index')->with(['success' => 'Cập nhật danh mục thành công']);
        }
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        //
        try {
            $category = Category::findOrFail($id);
            $category->delete();
            return response()->json(['success' => 'Xóa danh mục thành công']);
        } catch (Exception $exception) {
            return response()->json(['error' => $exception->getMessage()]);
        }
    }

    public function destroyMany(Request $request): JsonResponse
    {
        try {
            $itemIds = $request->get('itemIds');
            Category::whereIn('id', $itemIds)->delete();
            return response()->json(['success' => 'Xóa danh mục thành công']);
        } catch (Exception $exception) {
            return response()->json(['error' => $exception->getMessage()]);
        }
    }
}
