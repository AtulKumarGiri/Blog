<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\HomeBanner;
use App\Models\Post;
use Illuminate\Http\Request;


class FrontendController extends Controller
{
    public function index()
    {
        $banner = HomeBanner::where('status', 1)->latest()->first();

        // Only active + not soft deleted categories
        $all_categories = Category::where('status', 1)
                                    ->whereNull('deleted_at')
                                    ->get();

        // Only published + not deleted posts
        $latest_posts = Post::where('status', 'published')
                            ->whereNull('deleted_at')
                            ->latest()
                            ->take(10)
                            ->get();

        return view('frontend.index', compact(
            'banner',
            'all_categories',
            'latest_posts'
        ));
    }

    public function viewCategoryPost(string $category_slug)
    {
        $category = Category::where('slug', $category_slug)
                    ->where('status','1')
                    ->first();

        if ($category) {

            $posts = Post::where('category_id', $category->id)
                        ->where('status','published')
                        ->latest()
                        ->paginate(6);

            $allCategories = Category::where('status','1')->get();

            return view('frontend.post.index',
                compact('posts','category','allCategories'));
        }

        return redirect('/');
    }

    public function viewPost(string $category_slug, string $post_slug)
    {
        $category = Category::where('slug', $category_slug)
                            ->where('status', 1)
                            ->firstOrFail();

        $post = Post::where('category_id', $category->id)
                    ->where('slug', $post_slug)
                    ->where('status', 'published')
                    ->firstOrFail();
        $all_categories = Category::where('status','1')->get();
        $latest_posts = Post::where('status','published')
                            ->latest()
                            ->take(5)
                            ->get();

        return view('frontend.post.view', compact(
            'post',
            'all_categories',
            'latest_posts'
        ));
    }

    public function allPosts()
    {
        $posts = Post::with('category','user')
                    ->where('status','published')
                    ->latest()
                    ->paginate(10);

        return view('frontend.posts', compact('posts'));
    }

    public function allCategories()
    {
        $categories = Category::where('status',1)->latest()->get();
        return view('frontend.categories', compact('categories'));
    }

    public function globalSearch(Request $request)
    {
        $query = $request->search;

        $posts = Post::with('category')
            ->where('status','published')
            ->where(function($q) use ($query){
                $q->where('name','LIKE',"%$query%")
                ->orWhere('description','LIKE',"%$query%");
            })
            ->get();

        $categories = Category::where('status',1)
            ->where('name','LIKE',"%$query%")
            ->get();

        return response()->json([
            'posts' => $posts,
            'categories' => $categories
        ]);
    }

}

