<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


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


        // Validator::make($req->all(), [
        //     'title' => 'required',
        //     'postImg' => 'required|mimes:jpg,png'
        // ])->validate();

        $data = $this->getPostData($req);

        if ($req->hasFile('postImg')) {
            $fileName = uniqid() . $req->file('postImg')->getClientOriginalName();
            $req->file('postImg')->storeAs('public/uploads',$fileName);
            $data['postImg'] = $fileName;
            // $img = $req->file('postImg')->store('public/uploads'); // auto genetate UUID from laravel 
            // $data['postImg'] = $img;
        }

        Post::create($data);
        return redirect()->route('post#list');
    }

    public function postDelete($id)
    {
        $image = Post::find($id);
        unlink(storage_path('app/public/uploads/').$image->postImg);
        Post::where('id', $id)->delete();
        return redirect()->route('post#list');
    }

    public function edit($id)
    {
        $post = Post::where('id', $id)->first()->toArray();
        return view('edit', compact('post'));
    }

    public function postEdit(Request $req,$id)
    {
        Validator::make($req->all(), [
            'title' => 'required',
            'postImg' => 'nullable'
        ])->validate();

        
        $updateData = $this->getPostData($req); //[title,postimg]

        if ($req->hasFile('postImg')) {
            $post = Post::find($id);
            Storage::delete($post->postImg);

           $imagePath = $req->file('postImg')->store('public');
           $updateData['postImg'] = $imagePath; 
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
