@extends('layouts.app')

@section('content')
    <div class="container my-5">
        <div class="row my-5">
            <div class="card">
                <div class="card-header">
                    <h3>{{ $post->title }}</h3>
                </div>
                <div class="card-body">
                    <h5 class="card-text">Post with ID: {{ $post->id }}</h5>
                    <h5 class="card-title">Post Body: {{ $post->body }}</h5>
                    <p class="card-text">Posted by: {{ $post->user->name }}</p>
                </div>
            </div>
        </div>

        <div class="row mt-4">
            <div class="card">
                <div class="card-header">
                    <h4>Comments</h4>
                </div>
                <div class="card-body">
                    @foreach ($comments as $comment)
                        <div class="mb-3">
                            <strong>{{ $comment->user->name }}:</strong> {{ $comment->body }}
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
@endsection