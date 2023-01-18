@extends('master')

@section('content')

<div class="container w-50">
  <h2>Edit Form</h2>
    <form action="{{ route('post.update',['id'=>$post->id]) }}" method="post" enctype="multipart/form-data">
      @csrf
      <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title" class="form-control" value="{{ $post->title }}" placeholder="Enter title">
        @error('title')
        <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>
      <div class="form-group mt-3">
        <label for="postImg">Post Image</label>
        <input type="file" name="postImg" class="form-control">
        <img src="{{ Storage::url('uploads/'.$post->postImg) }}" class="d-block mt-2 mb-3" width='100' height="100">
        @error('postImg')
        <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>
      <button type="submit" class="btn btn-primary mt-3" name="edit">Update</button>
    </form>
  </div>

@endsection