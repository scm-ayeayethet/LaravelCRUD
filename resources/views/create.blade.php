@extends('master')

@section('content')

<div class="container w-50">
  <h2>Create Form</h2>
    <form action="{{ route('post.store') }}" method="post" enctype="multipart/form-data">
      @csrf
      <div class="form-group">
        <label for="title">Title</label>
        <input type="text" name="title" value="{{ old('title') }}" class="form-control" placeholder="Enter title">
        @error('title')
        <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>
      <div class="form-group mt-3">
        <label for="postImg">Post Image</label>
        <input type="file" name="postImg" class="form-control">
        @error('postImg')
        <small class="text-danger">{{ $message }}</small>
        @enderror
      </div>
      <button type="submit" class="btn btn-primary mt-3" name="create">Create</button>
    </form>
  </div>

@endsection