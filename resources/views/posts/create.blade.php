@extends('templates.app')

@section('content') 
    <form method="POST" action="{{ route('posts.store') }}">
        @csrf
        <div class="form-group">
            <label for="exampleFormControlInput1">Title</label>
            <input class="form-control">
        </div>
        <div class="form-group">
            <label for="exampleFormControlTextarea1">Descirption</label>
            <textarea class="form-control" rows="3"></textarea>
        </div>
        <select class="form-control">
            <option selected disabled>Select a name:</option>
            <option>name1</option>
            <option>name2</option>
            <option>name3</option>
        </select>
        <button type="submit" class="btn btn-primary mt-2">Create</button>
    </form>
@endsection