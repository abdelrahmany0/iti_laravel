@extends('layouts.app')
@section('title')
show post
@endsection
<link rel="stylesheet" type="text/css" href="{{ url('/css/showPost.css') }}">
<script type="text/javascript" src="{{ URL::asset('js/showPost.js') }}"></script>
@section('content')  
<div class="container mt-4">
    <div class="card">
        <div id="test" class="card-header bg-secondary">
            <h6>Post Info</h6>
            <h6 class="text-dark">ID: {{ $post['id'] }}</h6>
        </div>
        <div class="card-body">
            <div class="d-flex">
                <h5 class="card-title text-bold">Title:-</h5>
                <p class="inline">{{ $post['title'] }}</p>
            </div>
            <h4 class="card-title">Description:</h4>
            <p class="card-text">{{ $post['description'] }}</p>
            <div class="d-flex align-items-center">
                <h4 class="card-title m-0">Created At:-</h4>
                <p class="card-text">{{ $post['created_at']->format('l jS \\of F Y h:i:s A') }}</p>
            </div>
        </div>
    </div>
    @if ($post->user)
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
                <div class="d-flex align-items-center">
                    <h4 class="card-title m-0">Email:-</h4>
                    <p class="card-text"> {{ $post->user->email }}</p>
                </div>
            </div>
    </div>
    @else
    <div class="card mt-2">
        <div class="card-header bg-secondary">
                <h6>Post Creator Info</h6>
            </div>
            <div class="card-body">
                <h5 class="card-title text-bold">Unknown</h5>
            </div>
    </div>
    @endif

</div>
@endsection