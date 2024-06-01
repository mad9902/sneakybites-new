<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        // Ambil semua post dari database
        $posts = Post::all();
        
        // Tampilkan view forum dengan data posts
        return view('forum', compact('posts'));
    }

    public function create()
    {
        // Tampilkan form untuk membuat post baru
        return view('forum.create');
    }

    public function store(Request $request)
    {
        // Validasi data yang dikirim dari form
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        // Simpan post baru ke dalam database
        Post::create([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        // Redirect kembali ke halaman forum dengan pesan sukses
        return redirect()->route('forum.index')->with('success', 'Post berhasil dibuat!');
    }
}
