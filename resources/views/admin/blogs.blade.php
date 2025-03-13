@extends('layouts.app-admin')

@section('content')
<div class="container">
    <h2>All Blog Posts</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('admin.create-blog') }}" class="btn btn-primary mb-3">Create New Blog</a>

    @if($blogs->isEmpty())
        <p class="text-center">No blogs available.</p>
    @else
        <table class="table mt-3">
            <thead>
                <tr>
                    <th>Title</th>
                    <th>Created At</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($blogs as $blog)
                    <tr>
                        <td>{{ $blog->title }}</td>
                        <td>{{ $blog->created_at->format('M d, Y') }}</td>
                        <td>
                            <a href="{{ route('admin.blogs.show', $blog->id) }}" class="btn btn-info">View</a>
                            <a href="{{ route('admin.blog-edit', $blog->id) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('admin.blogs.destroy', $blog->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"
                                    onclick="return confirm('Are you sure you want to delete this post?')">Delete</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $blogs->links() }}
    @endif
</div>
@endsection