<?php

namespace App\Http\Controllers\Pelanggan;

use App\Http\Controllers\Controller;
use App\Models\Blog;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::latest()->paginate(9);
        return view('pelanggan.blog', compact('blogs'));
    }

    public function show($slug)
    {
        $blog = Blog::where('slug', $slug)->firstOrFail();

        $relatedBlogs = Blog::where('id', '!=', $blog->id)
            ->latest()
            ->take(3)
            ->get();

        return view('pelanggan.blog-detail', compact('blog', 'relatedBlogs'));
    }
}
