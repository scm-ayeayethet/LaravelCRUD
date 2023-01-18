@extends('master')

@section('content')
<div class="wrapper mt-5 ms-3 me-2 py-3  ">
  <a href="{{ route('post#create') }}" class="create" data-toggle="modal">
    <button type="button" class="btn btn-primary mb-3">Create</button>
  </a>
  <table class="table table-striped table-bordered">
    <thead>
      <tr>
        <th scope="col">ID</th>
        <th scope="col">Tilte</th>
        <th scope="col">Photo</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
          @foreach ($posts as $post)
          <tr>
          <td>{{ $post['id'] }}</td>
          <td>{{ $post['title'] }}</td>
          <td><img src="{{ Storage::url('uploads/'.$post['postImg']) }}" width='100' height="100"></td>
          <td>
          <a href='{{ url('post/edit/'.$post['id']) }}' class='edit' data-toggle='modal'>
             <button type='button' class='btn btn-success'>Edit</button>
           </a>
           <a href='{{ url('post/delete/'.$post['id']) }}' class='delete' data-toggle='modal'>
             <button type='button' class='btn btn-danger'>Delete</button>
           </a>
         </td>
        </tr>
          @endforeach 
    </tbody>
  </table>
</div>
@endsection