@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Blog</h2>

    <form action="{{ route('blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
        @csrf

        <input type="text" name="title" value="{{ $blog->title }}" class="form-control mb-2" required>

        <input type="text" name="category" value="{{ $blog->category }}" class="form-control mb-2" required>

        <textarea name="content" class="form-control mb-2" rows="5" required>{{ $blog->content }}</textarea>

        <label>Replace Image (optional)</label>
        <input type="file" name="image" class="form-control mb-2">

        <button class="btn btn-primary">Update</button>
    </form>
</div>
@endsection
