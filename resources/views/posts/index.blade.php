@extends('layouts.app')
@section('title')
all posts
@endsection

@section('content')  
<a href="{{ route('posts.create') }}" class="btn btn-success mb-2">Create Post</a>

<table class="table table-dark rounded">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Title</th>
            <th scope="col">Slug</th>
            <th scope="col">Posted By</th>
            <th scope="col">Created At</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($posts as $post)
        <tr>
            <td>{{ $post->id }}</td>
            <td>{{ $post->title }}</td>
            <td>{{ $post->slug }}</td>
            <td>{{ $post->user ? $post->user->name : 'user not found' }}</td>
            <td>{{ $post->created_at->format("Y-m-d") }}</td>
            <td>
                @if ($post->trashed())
                <form class="d-inline" method="POST" action="{{ route('posts.restore',[$post->id]) }}">
                    @csrf
                    <button class="btn btn-success" type="submit">Restore</button>
                </form>
                @else
                <x-Button type="info"       href="{{ route('posts.show',[$post->id]) }}">View</x-Button>
                <x-Button type="secondary"  href="{{ route('posts.edit',[$post->id]) }}">Edit</x-Button>
                <x-delete action="{{ route('posts.destroy',[$post['id']]) }}"  id="{{ $post->id }}"></x-delete>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $posts->onEachSide(1)->links() }}
@endsection