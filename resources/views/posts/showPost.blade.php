@extends('layouts.app')
@section('title')
show post
@endsection
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
    <!-- USER INFO SECTION -->
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

    <!-- COMMENTS SECTION -->

<div class="card mt-2">
<div class="card-header bg-secondary">
    <h6>Comments</h6>
</div>

@foreach ($post->comments as $comment)
<li class="list-group-item">
{{ $comment->description}}
</li>
<p class="px-4">Commented by: {{$comment->user->name}}</p>
@endforeach

</div>
@if ($errors->any())
    <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
    </div>
@endif

    <form method="POST" action="{{ route('comments.store',[$post->id]) }}">
    @csrf
        <div class="form-group">
            <label>Comment:</label>
            <textarea name="comment" class="form-control w-50" rows="3"></textarea>
        </div>
        <div class="w-100">
            <label>Comment Creator:</label>
            <select name="user_id" class="form-control">
                <option selected value="null">Select a name:</option>
                @foreach ($users as $user)
                <option value="{{ $user['id'] }}">{{ $user['name'] }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-primary mt-2">Add comment</button>
    </form>
</div>
@endsection