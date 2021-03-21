@extends('templates.app')
@section('title')
show post
@endsection
@section('content')  
<div class="container mt-4">
    <div class="card">
        <div class="card-header bg-secondary">
            <h6>Post Info</h6>
            <h6 class="text-dark">ID: {{ $post['id'] }}</h6>
        </div>
        <div class="card-body">
            <div class="d-flex">
                <h5 class="card-title text-bold">Title:-</h5>
                <p class="inline">{{ $post['title'] }}</p>
            </div>
            $carbon = new Carbon();  
            <h4 class="card-title">Description:</h4>
            <p class="card-text">{{ $post['description'] }}</p>
            <div class="d-flex align-items-center">
                <h4 class="card-title">Created At:-</h4>
                <p class="card-text">{{ $post['created_at'] }}</p>
            </div>
        </div>
    </div>
    <div class="card mt-2">
        <div class="card-header bg-secondary">
                <h6>Post Creator Info</h6>
                <h6 class="text-dark">ID: {{ $post->user->id }}</h6>
            </div>
            <div class="card-body">
                <div class="d-flex">
                    <h5 class="card-title text-bold">Name:-</h5>
                    <p class="inline">{{ $post->user->name }}</p>
                </div>
                <div class="d-flex">
                    <h4 class="card-title">Email:-</h4>
                    <p class="card-text">{{ $post->user->email }}</p>
                </div>
            </div>
    </div>
</div>
@endsection