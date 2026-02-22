<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\PostFormRequest;
use App\Models\Category;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | List All Posts
    |--------------------------------------------------------------------------
    */
    public function index()
    {
        $posts = Post::latest()->get();
        return view('admin.post.index', compact('posts'));
    }

    /*
    |--------------------------------------------------------------------------
    | Draft Posts
    |--------------------------------------------------------------------------
    */
    public function draft()
    {
        $posts = Post::draft()->latest()->get();
        return view('admin.post.index', compact('posts'));
    }

    /*
    |--------------------------------------------------------------------------
    | Published Posts
    |--------------------------------------------------------------------------
    */
    public function published()
    {
        $posts = Post::published()->latest()->get();
        return view('admin.post.index', compact('posts'));
    }

    /*
    |--------------------------------------------------------------------------
    | Archived Posts
    |--------------------------------------------------------------------------
    */
    public function archived()
    {
        $posts = Post::archived()->latest()->get();
        return view('admin.post.index', compact('posts'));
    }

    /*
    |--------------------------------------------------------------------------
    | Trash Posts
    |--------------------------------------------------------------------------
    */
    public function trash()
    {
        $posts = Post::onlyTrashed()->latest()->get();
        return view('admin.post.trash', compact('posts'));
    }

    /*
    |--------------------------------------------------------------------------
    | Create
    |--------------------------------------------------------------------------
    */
    public function create()
    {
        $category = Category::where('status', 1)
            ->whereNull('deleted_at')
            ->get();
        return view('admin.post.create', compact('category'));
    }

    /*
    |--------------------------------------------------------------------------
    | Store
    |--------------------------------------------------------------------------
    */
    public function store(PostFormRequest $request)
    {
        $data = $request->validated();

        $post = new Post();
        $post->category_id = $data['category_id'];
        $post->name = $data['name'];
        $post->slug = !empty($data['slug']) 
                        ? Str::slug($data['slug']) 
                        : Str::slug($data['name']);
        $post->description = $data['description'];
        $post->yt_iframe = $data['yt_iframe'] ?? null;
        $post->meta_title = $data['meta_title'];
        $post->meta_description = $data['meta_description'];
        $post->meta_keyword = $data['meta_keyword'];

        // STATUS LOGIC
        $post->status = $data['status'] ?? 'draft';

        if ($post->status === 'published') {
            $post->published_at = now();
        }

        $post->is_featured = $request->has('is_featured');
        $post->created_by = Auth::id();

        // ✅ IMAGE UPLOAD LOGIC
        if ($request->hasFile('image')) {

            $image = $request->file('image');
            $filename = time() . '_' . Str::slug($data['name']) . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('uploads/posts');

            // create folder if not exists
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true);
            }

            $image->move($destinationPath, $filename);

            $post->image = 'uploads/posts/' . $filename;
        }

        $post->save();

        return redirect('admin/posts')->with('status', 'Post Created Successfully');
    }

    /*
    |--------------------------------------------------------------------------
    | Edit
    |--------------------------------------------------------------------------
    */
    public function edit($post_id)
    {
        $category = Category::where('status', 1)
            ->whereNull('deleted_at')
            ->get();
        $post = Post::findOrFail($post_id);

        return view('admin.post.edit', compact('post', 'category'));
    }

    /*
    |--------------------------------------------------------------------------
    | Update
    |--------------------------------------------------------------------------
    */
    public function update(PostFormRequest $request, $post_id)
    {
        $data = $request->validated();
        $post = Post::findOrFail($post_id);

        $post->category_id = $data['category_id'];
        $post->name = $data['name'];
        $post->slug = !empty($data['slug']) 
                        ? Str::slug($data['slug']) 
                        : Str::slug($data['name']);
        $post->description = $data['description'];
        $post->yt_iframe = $data['yt_iframe'] ?? null;
        $post->meta_title = $data['meta_title'];
        $post->meta_description = $data['meta_description'];
        $post->meta_keyword = $data['meta_keyword'];

        $post->status = $data['status'] ?? 'draft';

        if ($post->status === 'published' && !$post->published_at) {
            $post->published_at = now();
        }

        $post->is_featured = $request->has('is_featured');

        // ✅ IMAGE UPLOAD LOGIC
        if ($request->hasFile('image')) {

            // Delete old image if exists
            if ($post->image && File::exists(public_path($post->image))) {
                File::delete(public_path($post->image));
            }

            $image = $request->file('image');
            $filename = time() . '_' . Str::slug($post->name) . '.' . $image->getClientOriginalExtension();

            $destinationPath = public_path('uploads/posts');
            $image->move($destinationPath, $filename);

            $post->image = 'uploads/posts/' . $filename;
        }

        $post->save();

        return redirect('admin/posts')->with('status', 'Post Updated Successfully');
    }

    /*
    |--------------------------------------------------------------------------
    | Soft Delete (Move to Trash)
    |--------------------------------------------------------------------------
    */
    public function destroy($post_id)
    {
        $post = Post::findOrFail($post_id);
        $post->delete();

        return redirect('admin/posts')->with('status', 'Post Moved to Trash');
    }

    /*
    |--------------------------------------------------------------------------
    | Restore
    |--------------------------------------------------------------------------
    */
    public function restore($post_id)
    {
        $post = Post::onlyTrashed()->findOrFail($post_id);
        $post->restore();

        return redirect('admin/posts')->with('status', 'Post Restored Successfully');
    }

    /*
    |--------------------------------------------------------------------------
    | Permanent Delete
    |--------------------------------------------------------------------------
    */
    public function forceDelete($post_id)
    {
        $post = Post::onlyTrashed()->findOrFail($post_id);
        $post->forceDelete();

        return redirect('admin/posts/trash')->with('status', 'Post Permanently Deleted');
    }
}