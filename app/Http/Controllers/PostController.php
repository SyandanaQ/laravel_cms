<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $posts = Post::latest()->paginate(10);  // Ambil semua data post
            return view('posts.index', compact('posts'));  // Kirim data ke view 'posts.index'
        } catch (\Exception $e) {
            // Menampilkan error untuk debugging
            dd($e->getMessage());  // Ini akan berhenti dan menampilkan pesan error
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('posts.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);
    
        // Simpan gambar jika ada
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
            $validated['image'] = $imagePath;
        }
    
        Post::create($validated);
    
        return redirect()->route('posts.index')->with('success', 'Berita berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show($slug)
    {
        $post = Post::where('slug', $slug)->firstOrFail();
    return view('posts.show', compact('post'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Cari post berdasarkan ID
    $post = Post::findOrFail($id);

    // Kembalikan view dengan data post untuk di-edit
    return view('posts.edit', compact('post'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi data yang diterima
    $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);

    // Cari post berdasarkan ID
    $post = Post::findOrFail($id);

    // Update data post
    $post->title = $request->title;
    $post->description = $request->description;

    // Cek apakah ada gambar yang di-upload
    if ($request->hasFile('image')) {
        // Hapus gambar lama
        if ($post->image) {
            Storage::delete('public/' . $post->image);
        }

        // Simpan gambar baru
        $path = $request->file('image')->store('posts', 'public');
        $post->image = $path;
    }

    // Update slug (jika judul diubah)
    $post->slug = Str::slug($post->title);

    // Simpan perubahan
    $post->save();

    // Kembalikan ke halaman index dengan pesan sukses
    return redirect()->route('posts.index')->with('success', 'Post updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
         // Cari post berdasarkan ID
    $post = Post::findOrFail($id);

    // Hapus gambar jika ada
    if ($post->image) {
        Storage::delete('public/' . $post->image);
    }

    // Hapus post dari database
    $post->delete();

    // Kembalikan ke halaman index dengan pesan sukses
    return redirect()->route('posts.index')->with('success', 'Post deleted successfully');
    }
}
