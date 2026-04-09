<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $blogs = Blog::latest()->get();
        return view('admin.blogs.index', compact('blogs'));
    }

    public function create()
    {
        return view('admin.blogs.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|min:5|max:255',
            'content' => 'required|min:10',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        $image = null;

        if ($request->file('image')) {
            $image = $request->file('image')->store('blogs', 'public');
        }

        Blog::create([
            'title' => $request->title,
            'content' => $request->content,
            'image' => $image
        ]);

        return redirect()->route('admin.blogs.index')
            ->with('success', 'Blog berhasil ditambahkan');
    }

    public function edit($id)
    {
        $blog = Blog::findOrFail($id);
        return view('admin.blogs.edit', compact('blog'));
    }

    public function update(Request $request, $id)
    {
        $blog = Blog::findOrFail($id);

        $request->validate([
            'title' => 'required|min:5|max:255',
            'content' => 'required|min:10',
            'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048'
        ]);

        if ($request->file('image')) {
            $image = $request->file('image')->store('blogs', 'public');
            $blog->image = $image;
        }

        $blog->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('admin.blogs.index')
            ->with('success', 'Blog berhasil diupdate');
    }

    public function destroy($id)
    {
        $blog = Blog::findOrFail($id);
        $blog->delete();

        return back()->with('success', 'Blog berhasil dihapus');
    }
}
