@extends('templates.app')
@section('content')  
<div class="container">
    <table class="table table-dark mt-4 brounded">
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
                {{-- @dd($postq); --}}
                <td>{{ $post['id'] }}</td>
                <td>{{ $post['title'] }}</td>
                <td>{{ $post['posted_by'] }}</td>
                <td>{{ $post['created_at'] }}</td>
                <td>
                    <a href="/posts{{ $post['id'] }}" class="btn btn-success">View</a>
                    <a class="btn btn-secondary">Edit</a>
                    <a class="btn btn-danger">Delete</a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection