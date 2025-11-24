<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class BlogController extends Controller
{
    // ==========================================
    // 1. PUBLIC VIEW (For normal users)
    // ==========================================
    public function index(Request $request)
    {
        $categories = Blog::select('category')->distinct()->pluck('category');
        
        $query = Blog::query();
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }
        $blogs = $query->latest()->get();

        // Returns the PUBLIC view: resources/views/blogs/index.blade.php
        return view('blogs.index', compact('blogs', 'categories'));
    }

    // ==========================================
    // 2. ADMIN VIEW (For Dashboard)
    // ==========================================
    public function adminIndex(Request $request)
    {
        $categories = Blog::select('category')->distinct()->pluck('category');

        $query = Blog::query();
        if ($request->filled('category')) {
            $query->where('category', $request->category);
        }
        
        // You might want to see specific stats here too, or just the list
        $blogs = $query->latest()->get();

        // Returns the ADMIN view: resources/views/admin/blogs/index.blade.php
        return view('admin.blogs.index', compact('blogs', 'categories'));
    }

    // ==========================================
    // 3. CRUD OPERATIONS
    // ==========================================
    
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

        $imageName = null;
        if ($request->image) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('blog_images'), $imageName);
        }

        Blog::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'category' => $request->category,
            'content' => $request->content,
            'image' => $imageName
        ]);

        // Send Notifications logic...
        /* 
        $users = User::all();
        foreach ($users as $user) {
             if (function_exists('sendNotification')) {
                 sendNotification($user->id, 'blog', "New blog: {$request->title}");
             }
        }
        */

        // Redirect based on who created it
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
            'image' => 'nullable|image|mimes:jpg,png,jpeg|max:2048', // Added nullable logic
        ]);

        $imageName = $blog->image;

        // Only upload if a new file is present
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('blog_images'), $imageName);
        }

        $blog->update([
            'title' => $request->title,
            'category' => $request->category,
            'content' => $request->content,
            'image' => $imageName
        ]);

        if(Auth::user()->role === 'admin') {
            return redirect()->route('admin.blogs.index')->with('success', 'Blog updated successfully!');
        }

        return redirect()->route('blogs.index')->with('success', 'Blog updated!');
    }
    public function destroy(Blog $blog)
    {
        $blog->delete();
        
        // "Back" will return them to whichever page they clicked delete on (Admin or Public)
        return back()->with('success', 'Blog deleted!');
    }
}