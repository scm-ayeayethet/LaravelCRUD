<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Http\Requests\PostUpdateRequest;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;


class PostController extends Controller
{
    public function getPost()
    {
        $posts = Post::all()->toArray();
        return view('postList', compact('posts'));
    }

    public function create()
    {
        return view('create');
    }

    public function postCreate(PostRequest $req)
    {

        $data = $this->getPostData($req);

        if ($req->hasFile('postImg')) {
            $fileName = uniqid() . $req->file('postImg')->getClientOriginalName();
            $req->file('postImg')->storeAs('public/uploads', $fileName);
            $data['postImg'] = $fileName;
        }

        Post::create($data);
        return redirect()->route('post#list');
    }

    public function postDelete($id)
    {
        $image = Post::find($id);
        Storage::delete($image->postImg);
        Post::where('id', $id)->delete();
        return redirect()->route('post#list');
    }

    public function edit($id)
    {
        $post = Post::where('id', $id)->first()->toArray();
        return view('edit', compact('post'));
    }

    public function postEdit(PostUpdateRequest $req, $id)
    {
        $updateData = $this->getPostData($req);

        if ($req->hasFile('postImg')) {
            $post = Post::find($id);
            Storage::delete($post->postImg);
            $fileName = uniqid() . $req->file('postImg')->getClientOriginalName();
            $req->file('postImg')->storeAs('public/uploads', $fileName);
            $updateData['postImg'] = $fileName;
        }

        Post::where('id', $id)->update($updateData);
        return redirect()->route('post#list');
    }

    private function getPostData($data)
    {
        return [
            'title' => $data->title
        ];
    }
}
