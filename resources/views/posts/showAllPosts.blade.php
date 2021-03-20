@extends('templates.app')

@section('content')  
<a href="{{ route('posts.create') }}" class="btn btn-success mb-2">Create Post</a>
<table class="table table-dark rounded">
    <thead>
        <tr>
            <th scope="col">ID</th>
            <th scope="col">Title</th>
            <th scope="col">Posted By</th>
            <th scope="col">Created At</th>
            <th scope="col">Actions</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($posts as $post)
        <tr>
            <td>{{ $post['id'] }}</td>
            <td>{{ $post['title'] }}</td>
            <td>{{ $post['posted_by'] }}</td>
            <td>{{ $post['created_at'] }}</td>
            <td>
                <x-Button type="success" content="View" href="{{ $post['id'] }}"></x-Button>
                <x-Button type="secondary" content="Edit"></x-Button>
                <x-Button type="danger" content="Delete"></x-Button>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
@endsection