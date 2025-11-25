<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage; // Import Storage
use App\Models\User;

class BlogController extends Controller
{
    // ... index and adminIndex remain the same ...
    public function index(Request $request)
    {
        $categories = Blog::select('category')->distinct()->pluck('category');
        $query = Blog::query();
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }
        $blogs = $query->latest()->get();
        return view('blogs.index', compact('blogs', 'categories'));
    }

    public function adminIndex(Request $request)
    {
        $categories = Blog::select('category')->distinct()->pluck('category');
        $query = Blog::query();
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }
        $blogs = $query->latest()->get();
        return view('admin.blogs.index', compact('blogs', 'categories'));
    }

    public function create()
    {
        return view('blogs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'category' => 'required',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            // FIX: Use Cloudinary instead of local 'move'
            $imagePath = $request->file('image')->store('blog_images', 'cloudinary');
        }

        Blog::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'category' => $request->category,
            'content' => $request->content,
            'image' => $imagePath // This saves the Cloudinary path
        ]);

        if(Auth::user()->role === 'admin') {
            return redirect()->route('admin.blogs.index')->with('success', 'Blog created successfully!');
        }

        return redirect()->route('blogs.index')->with('success', 'Blog created!');
    }

    public function edit(Blog $blog)
    {
        return view('blogs.edit', compact('blog'));
    }

    public function update(Request $request, Blog $blog)
    {
        $request->validate([
            'title' => 'required',
            'category' => 'required',
            'content' => 'required',
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048',
        ]);

        $imagePath = $blog->image;

        if ($request->hasFile('image')) {
             // Delete old image from Cloudinary
             if ($blog->image) {
                Storage::disk('cloudinary')->delete($blog->image);
            }
            // Upload new
            $imagePath = $request->file('image')->store('blog_images', 'cloudinary');
        }

        $blog->update([
            'title' => $request->title,
            'category' => $request->category,
            'content' => $request->content,
            'image' => $imagePath
        ]);

        if(Auth::user()->role === 'admin') {
            return redirect()->route('admin.blogs.index')->with('success', 'Blog updated successfully!');
        }

        return redirect()->route('blogs.index')->with('success', 'Blog updated!');
    }

    public function destroy(Blog $blog)
    {
        // Delete image from Cloudinary
        if ($blog->image) {
            Storage::disk('cloudinary')->delete($blog->image);
        }
        $blog->delete();
        
        return back()->with('success', 'Blog deleted!');
    }
}
