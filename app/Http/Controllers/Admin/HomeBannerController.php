<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Models\HomeBanner;

class HomeBannerController extends Controller
{
    /**
     * Display all banners
     */
    public function index()
    {
        $banners = HomeBanner::latest()->get();
        return view('admin.banner.index', compact('banners'));
    }

    /**
     * Show create form
     */
    public function create()
    {
        return view('admin.banner.create');
    }

    /**
     * Store banner
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'subtitle' => 'nullable|string',
            'image' => 'required|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $banner = new HomeBanner();

        $banner->title = $request->title;
        $banner->subtitle = $request->subtitle;
        $banner->button_text = $request->button_text;
        $banner->button_link = $request->button_link;
        $banner->status = $request->status ? 1 : 0;

        // If this banner is active, deactivate others
        if ($banner->status == 1) {
            HomeBanner::where('status', 1)->update(['status' => 0]);
        }

        // Image Upload
        if ($request->hasFile('image')) {

            $uploadPath = public_path('assets/uploads/banner');

            if (!File::exists($uploadPath)) {
                File::makeDirectory($uploadPath, 0755, true);
            }

            $image = $request->file('image');
            $imageName = time().'_'.Str::slug($request->title).'.'.$image->getClientOriginalExtension();
            $image->move($uploadPath, $imageName);

            $banner->image = 'assets/uploads/banner/'.$imageName;
        }

        $banner->save();

        return redirect()->route('admin.home-banner.index')
            ->with('message', 'Banner Added Successfully');
    }

    /**
     * Edit banner
     */
    public function edit($id)
    {
        $banner = HomeBanner::findOrFail($id);
        return view('admin.banner.edit', compact('banner'));
    }

    /**
     * Update banner
     */
    public function update(Request $request, $id)
    {
        $banner = HomeBanner::findOrFail($id);

        $request->validate([
            'title' => 'required|string|max:255',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $banner->title = $request->title;
        $banner->subtitle = $request->subtitle;
        $banner->button_text = $request->button_text;
        $banner->button_link = $request->button_link;
        $banner->status = $request->status ? 1 : 0;

        // If active, deactivate others
        if ($banner->status == 1) {
            HomeBanner::where('id', '!=', $banner->id)
                ->update(['status' => 0]);
        }

        // Image Update
        if ($request->hasFile('image')) {

            $uploadPath = public_path('assets/uploads/banner');

            // Delete old image
            if ($banner->image && File::exists(public_path($banner->image))) {
                File::delete(public_path($banner->image));
            }

            $image = $request->file('image');
            $imageName = time().'_'.Str::slug($request->title).'.'.$image->getClientOriginalExtension();
            $image->move($uploadPath, $imageName);

            $banner->image = 'assets/uploads/banner/'.$imageName;
        }

        $banner->update();

        return redirect()->route('admin.home-banner.index')
            ->with('message', 'Banner Updated Successfully');
    }

    /**
     * Delete banner
     */
    public function destroy($id)
    {
        $banner = HomeBanner::findOrFail($id);

        if ($banner->image && File::exists(public_path($banner->image))) {
            File::delete(public_path($banner->image));
        }

        $banner->delete();

        return redirect()->route('admin.home-banner.index')
            ->with('message', 'Banner Deleted Successfully');
    }
}