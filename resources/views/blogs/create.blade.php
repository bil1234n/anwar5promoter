@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Create Blog</h2>

    <form action="{{ route('blogs.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="text" name="title" class="form-control mb-2" placeholder="Blog Title" required>

        <input type="text" name="category" class="form-control mb-2" placeholder="Category" required>

        <textarea name="content" class="form-control mb-2" rows="5" placeholder="Blog Content" required></textarea>

        <input type="file" name="image" class="form-control mb-2">

        <button class="btn btn-success">Publish</button>
    </form>
</div>
@endsection
