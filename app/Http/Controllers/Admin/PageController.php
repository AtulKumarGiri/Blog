<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Page;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
class PageController extends Controller
{
    public function index()
    {
        $pages = Page::latest()->get();
        return view('admin.pages.index', compact('pages'));
    }

    public function create()
    {
        return view('admin.pages.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'featured_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        // ✅ Generate Unique Slug
        $baseSlug = Str::slug($request->title);
        $slug = $baseSlug;
        $count = 1;

        while (Page::where('slug', $slug)->exists()) {
            $slug = $baseSlug . '-' . $count++;
        }

        // ✅ Handle Image Upload
        $imageName = null;

        if ($request->hasFile('featured_image')) {

            $uploadPath = public_path('assets/uploads/pages');

            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true);
            }

            $image = $request->file('featured_image');

            $imageName = time() . '_' . $slug . '.' . $image->getClientOriginalExtension();

            $image->move($uploadPath, $imageName);
        }

        // ✅ Create Page
        Page::create([
            'title' => $request->title,
            'slug' => $slug,
            'content' => $request->content,
            'featured_image' => $imageName,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'show_in_header' => $request->has('show_in_header'),
            'show_in_footer' => $request->has('show_in_footer'),
            'status' => $request->has('status')
        ]);

        return redirect()->route('admin.pages.index')
            ->with('success', 'Page Created Successfully');
    }

    public function edit($id)
    {
        $page = Page::findOrFail($id);
        return view('admin.pages.edit', compact('page'));
    }

    public function update(Request $request, $id)
    {
        $page = Page::findOrFail($id);

        $request->validate([
            'title' => 'required',
            'content' => 'required',
            'featured_image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048'
        ]);

        $imageName = $page->featured_image;

        if ($request->hasFile('featured_image')) {

            $uploadPath = public_path('assets/uploads/pages');

            // Delete old image
            if ($page->featured_image &&
                File::exists($uploadPath.'/'.$page->featured_image)) {
                File::delete($uploadPath.'/'.$page->featured_image);
            }

            // Upload new image
            $image = $request->file('featured_image');
            $imageName = time().'_'.Str::slug($request->title).'.'.$image->getClientOriginalExtension();
            $image->move($uploadPath, $imageName);
        }

        $page->update([
            'title' => $request->title,
            'slug' => Str::slug($request->title),
            'content' => $request->content,
            'featured_image' => $imageName,
            'meta_title' => $request->meta_title,
            'meta_description' => $request->meta_description,
            'show_in_header' => $request->has('show_in_header') ? 1 : 0,
            'show_in_footer' => $request->has('show_in_footer') ? 1 : 0,
            'status' => $request->has('status') ? 1 : 0
        ]);

        return redirect()->route('admin.pages.index')
            ->with('success', 'Page Updated Successfully');
    }

    public function destroy($id)
    {
        $page = Page::findOrFail($id);

        $uploadPath = public_path('assets/uploads/pages');

        if ($page->featured_image &&
            File::exists($uploadPath.'/'.$page->featured_image)) {
            File::delete($uploadPath.'/'.$page->featured_image);
        }

        $page->delete();

        return redirect()->route('admin.pages.index')
            ->with('success', 'Page Deleted Successfully');
    }
}