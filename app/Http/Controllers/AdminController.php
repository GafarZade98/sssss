<?php

namespace App\Http\Controllers;

use App\Models\Item;
use App\Models\Topic;
use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;



class AdminController extends Controller
{
    public function index()
    {
        return view('admin.dashboard');
    }

    public function posts()

    {
        $data['items'] = Item::get();
        $data['topics'] = Topic::get();
        return view('admin.posts-table', $data);
    }

        public function getPosts(Request $request)
    {
         $per_page = $request->get('limit') ?? 20;
        $offset = $request->get('offset') ?? 0;
        $search = $request->get('search') ?? null;
        $sort = $request->get('sort') ?? 'created_at';
        $order = $request->get('order') ?? 'asc';

        $users = Post::where('name', 'like', "$search%")
            ->orderBy($sort, $order);

        return response()->json([
            'total' => $users->count(),
            'rows' => $users->offset($offset)->limit($per_page)->get(),
        ]);

    }

    public function postStore(Request $request)
    {
        $post = Post::updateOrCreate(
            ['id' => $request->get('id')],
            $request->except('_token','id')
        );

        return response()->json($post);
    }

    public function postDelete(Request $request)
    {
        collect(json_decode($request->get('data')))->each(function ($cat){
            Post::destroy($cat->id);
        });

        return response('ok');
    }

    public function items()

    {
        return view('admin.items-table');
    }

    public function getItems(Request $request)
    {
        $per_page = $request->get('limit') ?? 20;
        $offset = $request->get('offset') ?? 0;
        $search = $request->get('search') ?? null;
        $sort = $request->get('sort') ?? 'created_at';
        $order = $request->get('order') ?? 'asc';

        $items = Item::where('name', 'like', "$search%")
            ->orderBy($sort, $order);

        return response()->json([
            'total' => $items->count(),
            'rows' => $items->offset($offset)->limit($per_page)->get(),
        ]);

    }

    public function itemStore(Request $request)
    {
        $item = Item::updateOrCreate(
            ['id' => $request->get('id')],
            $request->except('_token','id')
        );

        return response()->json($item);
    }

    public function itemDelete(Request $request)
    {
        collect(json_decode($request->get('data')))->each(function ($cat){
            Item::destroy($cat->id);
        });

        return response('ok');
    }


    public function topics()

    {
        return view('admin.topics-table');
    }

    public function getTopics(Request $request)
    {
        $per_page = $request->get('limit') ?? 20;
        $offset = $request->get('offset') ?? 0;
        $search = $request->get('search') ?? null;
        $sort = $request->get('sort') ?? 'created_at';
        $order = $request->get('order') ?? 'asc';

        $items = Topic::where('name', 'like', "$search%")
            ->orderBy($sort, $order);

        return response()->json([
            'total' => $items->count(),
            'rows' => $items->offset($offset)->limit($per_page)->get(),
        ]);

    }

    public function topicStore(Request $request)
    {
        $topic = Topic::updateOrCreate(
            ['id' => $request->get('id')],
            $request->except('_token','id')
        );

        return response()->json($topic);
    }

    public function topicDelete(Request $request)
    {
        collect(json_decode($request->get('data')))->each(function ($cat){
            Topic::destroy($cat->id);
        });

        return response('ok');
    }
}
