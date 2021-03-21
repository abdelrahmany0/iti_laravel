@extends('templates.app')
@section('title')
edit post
@endsection
@section('content')
<form method="POST" action="{{ route('posts.update',[$post['id']]) }}">
    <input type="hidden" name="_method" value="PUT" />
    @csrf
    <div class="form-group">
        <label>Title:</label>
        <input name="title" class="form-control" value="{{ $post['title'] }}">
    </div>
    <div class="form-group">
        <label>Description:</label>
        <textarea name="description" class="form-control" rows="3">{{ $post['description'] }}</textarea>
    </div>
    <label>Post Creator:</label>
    <select name="user_id" class="form-control">
        @foreach ($users as $user)
        <option value="{{ $user['id'] }}">{{ $user['name'] }}</option>
        @endforeach
    </select>
    <button type="submit" class="btn btn-primary mt-2">Update</button>
</form>
@endsection