@extends('layouts.app-admin')

@section('content')
<div class="container">
    <h2>Edit Blog</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                   <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.blogs.update', $blog->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <!-- Title Field -->
        <div class="form-group">
            <label for="title">Title:</label>
            <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $blog->title) }}" required>
        </div>

        <!-- Content Field -->
        <div class="form-group">
            <label for="content">Content:</label>
            <textarea name="content" id="content" class="form-control" rows="5" required>{{ old('content', $blog->content) }}</textarea>
        </div>

        <!-- Existing Image Display -->
        <div class="form-group">
            <label>Current Image:</label>
            @if($blog->image)
                <br>
                <img src="{{ asset('storage/' . $blog->image) }}" alt="{{ $blog->title }}" class="img-fluid" style="max-width: 300px;">
            @else
                <p>No image uploaded.</p>
            @endif
        </div>

        <!-- Image Upload Field -->
        <div class="form-group">
            <label for="image">Change Image:</label>
            <input type="file" name="image" id="image" class="form-control-file">
        </div>

        <button type="submit" class="btn btn-primary">Update Blog</button>
    </form>

    <br>
    <a href="{{ route('admin.blogs') }}" class="btn btn-secondary">Back to Blog List</a>
</div>
@endsection
