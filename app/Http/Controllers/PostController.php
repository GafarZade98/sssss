<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Topic;
use App\Models\Post;
use App\Models\Item;
class PostController extends Controller
{
    public function index()
    {
        return view('frontend.welcome');
    }

    public function posts(Request $request)
    {
        $items = Item::all();
        $topics = Topic::all();

        if (request()->item) {
            $posts = Post::with('item')->whereHas('item', function ($query) {
                $query->where('slug', request()->item);
            })->simplePaginate(9);


        } elseif (request()->topic) {
            $posts = Post::with('topic')->whereHas('topic', function ($query) {
                $query->where('slug', request()->topic);
            })->simplePaginate(9);

        } else {
            $posts = Post::take(12)->simplePaginate(6);
            $topics = Topic::all();
        }



        return view('frontend.posts', compact('items', 'topics', 'posts'));

    }

    public function detail($slug)

    {
        $posts = Post::where('slug', $slug)->firstOrFail();
        return view('frontend.posts')->with('posts', $posts,);

    }
}
