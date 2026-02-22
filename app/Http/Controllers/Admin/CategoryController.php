<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\CategoryFormRequest;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    // ==============================
    // INDEX
    // ==============================
    public function index()
    {
        $category = Category::with('parent')
                        ->orderBy('sort_order', 'ASC')
                        ->get();

        return view('admin.category.index', compact('category'));
    }

    // ==============================
    // CREATE
    // ==============================
    public function create()
    {
        $categories = Category::whereNull('parent_id')->get(); // for parent dropdown
        return view('admin.category.create', compact('categories'));
    }

    // ==============================
    // STORE
    // ==============================
    public function store(CategoryFormRequest $request)
    {
        $data = $request->validated();

        $category = new Category();

        $category->name = $data['name'];
        $category->slug = !empty($data['slug']) 
                            ? Str::slug($data['slug']) 
                            : Str::slug($data['name']);

        $category->description = $data['description'] ?? null;

        // IMAGE UPLOAD
        if ($request->hasFile('image')) {

            $uploadPath = public_path('uploads/category');

            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true);
            }

            $file = $request->file('image');
            $filename = time().'_'.Str::slug($category->name).'.'.$file->getClientOriginalExtension();
            $file->move($uploadPath, $filename);

            $category->image = $filename;
        }

        // SEO
        $category->meta_title = $data['meta_title'] ?? null;
        $category->meta_description = $data['meta_description'] ?? null;
        $category->meta_keyword = $data['meta_keyword'] ?? null;
        $category->canonical_url = $data['canonical_url'] ?? null;

        // NEW FIELDS
        $category->parent_id = $data['parent_id'] ?? null;
        $category->sort_order = $data['sort_order'] ?? 0;
        $category->is_featured = $request->has('is_featured') ? 1 : 0;

        // STATUS
        $category->navbar_status = $request->has('navbar_status') ? 1 : 0;
        $category->status = $request->has('status') ? 1 : 0;

        $category->created_by = Auth::id();

        $category->save();

        return redirect('admin/category')->with('status', 'Category Added Successfully');
    }

    // ==============================
    // EDIT
    // ==============================
    public function edit($category_id)
    {
        $category = Category::findOrFail($category_id);
        $categories = Category::where('id', '!=', $category_id)->get();

        return view('admin.category.edit', compact('category', 'categories'));
    }

    // ==============================
    // UPDATE
    // ==============================
    public function update(CategoryFormRequest $request, $category_id)
    {
        $data = $request->validated();

        $category = Category::findOrFail($category_id);

        $category->name = $data['name'];
        $category->slug = !empty($data['slug']) 
                            ? Str::slug($data['slug']) 
                            : Str::slug($data['name']);

        $category->description = $data['description'] ?? null;

        // IMAGE UPDATE
        if ($request->hasFile('image')) {

            $destination = public_path('uploads/category/'.$category->image);

            if ($category->image && File::exists($destination)) {
                File::delete($destination);
            }

            $file = $request->file('image');
            $filename = time().'_'.Str::slug($category->name).'.'.$file->getClientOriginalExtension();
            $file->move(public_path('uploads/category'), $filename);

            $category->image = $filename;
        }

        // SEO
        $category->meta_title = $data['meta_title'] ?? null;
        $category->meta_description = $data['meta_description'] ?? null;
        $category->meta_keyword = $data['meta_keyword'] ?? null;
        $category->canonical_url = $data['canonical_url'] ?? null;

        // NEW FIELDS
        $category->parent_id = $data['parent_id'] ?? null;
        $category->sort_order = $data['sort_order'] ?? 0;
        $category->is_featured = $request->has('is_featured') ? 1 : 0;

        // STATUS
        $category->navbar_status = $request->has('navbar_status') ? 1 : 0;
        $category->status = $request->has('status') ? 1 : 0;

        $category->created_by = Auth::id();

        $category->update();

        return redirect('admin/category')->with('status', 'Category Updated Successfully');
    }

    // ==============================
    // DELETE
    // ==============================
    public function destroy($category_id)
    {
        $category = Category::findOrFail($category_id);

        // Soft delete only (image not deleted)
        $category->delete();

        return redirect('admin/category')
            ->with('status', 'Category Moved to Trash Successfully');
    }

    public function restore($id)
    {
        $category = Category::withTrashed()->findOrFail($id);
        $category->restore();

        return redirect()->back()
            ->with('status', 'Category Restored Successfully');
    }

    public function forceDelete($id)
    {
        $category = Category::withTrashed()->findOrFail($id);

        // Delete image file if exists
        if ($category->image) {
            $imagePath = public_path('uploads/category/'.$category->image);
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
        }

        $category->forceDelete();

        return redirect()->back()
            ->with('status', 'Category Deleted Permanently');
    }

    public function trash()
    {
        $categories = Category::onlyTrashed()->get();
        return view('admin.category.trash', compact('categories'));
    }
}