@extends('layouts.app')
@section('title',"Add post")
@section('content')
    <div class="container my-5">
        <h1>Create New Post</h1>
 
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
        <form action="/posts" method="post" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" value="{{ old('title') }}">
            </div>
            <div class="mb-3">
                <label for="body" class="form-label">Body</label>
                <input class="form-control" id="body" name="body" rows="3" value="{{ old('body') }}">
            </div>
            <div class="mb-3">
                <label for="user_id" class="form-label">Posted By </label>
                <input type="text" class="form-control" id="user_id" name="user_id" value="{{ old('user_id') }}">
            </div>
            <div class="mb-3">
        <label for="image" class="form-label">Image</label>
        <input type="file" class="form-control" id="image" name="image" value="{{ old('title') }}">
    </div>
            <button type="submit" class="btn btn-primary">Add Post</button>
        </form>
    </div>
    

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    @endsection