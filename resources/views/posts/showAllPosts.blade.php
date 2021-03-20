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
            <tr>
                <th scope="row">1</th>
                <td>Mark</td>
                <td>Otto</td>
                <td>test</td>
                <td>
                    <button type="button" class="btn btn-success">View</button>
                    <button type="button" class="btn btn-secondary">Edit</button>
                    <button type="button" class="btn btn-danger">Delete</button>
                </td>
            </tr>
        </tbody>
    </table>
</div>
@endsection