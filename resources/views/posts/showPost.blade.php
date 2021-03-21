@extends('templates.app')
@section('content')  
<div class="container mt-4">
    <div class="card">
        <div class="card-header">
            <h6>Post Info</h6>
            <h6 style="color: forestgreen;">ID: {{ $post['id'] }}</h6>
        </div>
        <div class="card-body">
            <h5 class="card-title text-bold">Title:</h5>
            <p class="inline">{{ $post['title'] }}</p>
            <h4 class="card-title">Description:</h4>
            <p class="card-text">{{ $post['description'] }}</p>
            <h4 class="card-title">Created At:</h4>
            <p class="card-text">{{ $post['created_at'] }}</p>
        </div>
        </div>
</div>
@endsection