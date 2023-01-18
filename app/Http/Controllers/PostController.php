<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;


class PostController extends Controller
{
    public function index()
    {
        $posts = Post::paginate(5);

        return view('postList', compact('posts'));
    }

    public function create()
    {
        return view('create');
    }

    public function store(PostRequest $request)
    {

        $data = [
            'title' => $request->title
        ];

        if ($request->hasFile('postImg')) {
            $fileName = uniqid() . $request->file('postImg')->getClientOriginalName();
            $request->file('postImg')->storeAs('public/uploads', $fileName);
            $data['postImg'] = $fileName;
        }

        Post::create($data);

        return redirect()->route('post.index');
    }

    public function destroy($id)
    {
        $post = Post::find($id);
        Storage::delete($post->postImg);
        $post->delete();

        return back();
    }

    public function edit($id)
    {
        $post = Post::find($id);

        return view('edit', compact('post'));
    }

    public function update(PostUpdateRequest $request, $id)
    {
        $updateData = [
            'title' => $request->title
        ];
        $post = Post::find($id);

        if ($request->hasFile('postImg')) {
            Storage::delete($post->postImg);
            $fileName = uniqid() . $request->file('postImg')->getClientOriginalName();
            $request->file('postImg')->storeAs('public/uploads', $fileName);
            $updateData['postImg'] = $fileName;
        }

        $post->update($updateData);

        return redirect()->route('post.index');
    }
}
