@extends('layouts.app')
@section('title')
edit post
@endsection
@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form method="POST" action="{{ route('posts.update',[$post->id]) }}">
    <input type="hidden" name="_method" value="PUT" />
    @csrf
    <div class="form-group">
        <label>Title:</label>
        <input name="title" class="form-control" value="{{ $post->title }}">
    </div>
    <div class="form-group">
        <label>Description:</label>
        <textarea name="description" class="form-control" rows="3">{{ $post->description }}</textarea>
    </div>
    <label>Post Creator:</label>
    <select name="user_id" class="form-control">
    @if ($post->user)
        @foreach ($users as $user)
            @if ($user->name === $post->user->name)
            <option selected value="{{ $user->id }}">{{ $user->name }}</option>
            @else
            <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endif
        @endforeach
    @else
    <option selected value="">--none</option>
    @foreach ($users as $user)
            <option value="{{ $user->id }}">{{ $user->name }}</option>
        @endforeach
    @endif
    </select>
    <button type="submit" class="btn btn-primary mt-2">Update</button>
</form>
@endsection