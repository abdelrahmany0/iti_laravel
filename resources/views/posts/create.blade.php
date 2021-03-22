@extends('templates.app')
@section('title')
create post
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
<form method="POST" action="{{ route('posts.store') }}">
    @csrf
    <div class="form-group">
        <label>Title:</label>
        <input name="title" class="form-control">
    </div>
    <div class="form-group">
        <label>Description:</label>
        <textarea name="description" class="form-control" rows="3"></textarea>
    </div>
    <label>Post Creator:</label>
    <select name="user_id" class="form-control">
        <option selected disabled>Select a name:</option>
        @foreach ($users as $user)
        <option value="{{ $user['id'] }}">{{ $user['name'] }}</option>
        @endforeach
    </select>
    <button type="submit" class="btn btn-primary mt-2">Create</button>
</form>
@endsection