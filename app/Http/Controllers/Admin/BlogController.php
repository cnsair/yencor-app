<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Blog;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    // Show all blogs in Admin
    public function adminIndex()
    {
        $blogs = Blog::latest()->paginate(10);
        return view('admin.blogs', compact('blogs'));
    }

    // Show blog creation form
    public function create()
    {
        return view('admin.create-blog');
    }

    // Store new blog post
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('blog_images', 'public');
        }

        Blog::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $imagePath,
        ]);

        return redirect()->route('admin.blogs')->with('success', 'Blog post created successfully.');
    }
    // Show single blog for Admin
    public function showAdmin($id)
    {
        $blog = Blog::findOrFail($id);
        return view('admin.admin-blog-detail', compact('blog'));
    }

    // Show all blogs on Homepage
    public function index()
    {
        $blogs = Blog::latest()->paginate(6);
        return view('home.blog', compact('blogs'));
    }

    // Show single blog post on Homepage
    public function show($id)
    {
        $blog = Blog::findOrFail($id);
        return view('home.blog-detail', compact('blog'));
    }

    // Show Edit bog page
    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('admin.blog-edit', compact('blog'));
    }

    // Update existing blog post
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $blog = Blog::findOrFail($id);

        if ($request->hasFile('image')) {
            if ($blog->image) {
                Storage::disk('public')->delete($blog->image);
            }
            $blog->image = $request->file('image')->store('blog_images', 'public');
        }

        $blog->update([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $blog->image,
        ]);

        return redirect()->route('admin.blogs')->with('success', 'Blog post updated successfully.');
    }
    
    // Delete blog post
    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        if ($blog->image) {
            Storage::disk('public')->delete($blog->image);
        }
        $blog->delete();

        return redirect()->route('admin.blogs')->with('success', 'Blog post deleted successfully.');
    }
}
