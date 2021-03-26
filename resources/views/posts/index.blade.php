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
            <th scope="col">Image</th>
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
            @if ($post->trashed())
            <td>
                <p>no image found</p>
            </td>
            @else
            <td>
                @if ($post->image)
                <img src="{{ asset('storage/posts/'.$post->image) }}" alt="" width="80px" height="80px">
                @else
                <p>no image found</p>
                @endif
            </td>
            @endif
            <td>{{ $post->created_at->format("Y-m-d") }}</td>
            <td>
                @if ($post->trashed())
                <form class="d-inline" method="POST" action="{{ route('posts.restore',[$post->id]) }}">
                    @csrf
                    <button class="btn btn-success" type="submit">Restore</button>
                </form>
                @else
                <x-Button type="info" href="{{ route('posts.show',[$post->id]) }}">View</x-Button>
                <x-Button type="secondary" href="{{ route('posts.edit',[$post->id]) }}">Edit</x-Button>
                <x-delete action="{{ route('posts.destroy',[$post['id']]) }}" id="{{ $post->id }}"></x-delete>

                <!-- Button trigger modal -->
                <button onclick="get_post(event)" id="{{ $post->id }}" type="button" class="btn btn-light" data-toggle="modal" data-target="#view-{{ $post->id }}">
                    View AJAX
                </button>
                <!-- Modal -->
                <div class="modal fade" id="view-{{ $post->id }}" tabindex="-1" aria-labelledby="view-ajax" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="view-ajax">Modal title</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body" id="ajax_post{{ $post->id }}">
                                
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <x-Button type="primary" href="{{ route('posts.show',[$post->id]) }}">View details</x-Button>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
{{ $posts->onEachSide(1)->links() }}
@endsection
@section('scripts')
<script>
    async function get_post(e) {
        let id = e.target.id;
        console.log('test');
        let res = await fetch("/api/posts/"+id);
        let resJson = await res.json();
        if (resJson ) {
            show_post(resJson);
        } else {
            console.log("No Data To Display");
        }
    }

    function show_post(resJson){
        // console.log(resJson);
        let output = `
    <div class="card">
        <div id="test" class="card-header bg-secondary">
            <h6>Post Info</h6>
            <h6 class="text-dark">ID: ${resJson.data.id} </h6>
        </div>
        <div class="card-body">
            <div class="d-flex">
                <h5 class="card-title text-bold text-dark">Title:-</h5>
                <p class="inline  text-dark"> ${resJson.data.title} </p>
            </div>
            <h4 class="card-title  text-dark">Description:</h4>
            <p class="card-text  text-dark"> ${resJson.data.description} </p>
        </div>
    </div>
    `;
    document.getElementById(`ajax_post${resJson.data.id}`).innerHTML = output;
    }
</script>
@endsection