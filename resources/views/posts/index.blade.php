<!-- resources/views/posts/index.blade.php -->
@extends('layouts.app')

@section('content')
<div class="max-w-3xl mx-auto mt-10">
    <h2 class="text-2xl font-bold mb-4">Daftar Berita</h2>

    @if(session('success'))
        <div class="bg-green-500 text-white p-3 rounded mb-4">
            {{ session('success') }}
        </div>
    @endif

    <a href="{{ route('posts.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded mb-4 inline-block">Tambah Berita</a>

    <table class="min-w-full table-auto">
        <thead>
            <tr>
                <th class="px-4 py-2 border">No</th>
                <th class="px-4 py-2 border">Judul</th>
                <th class="px-4 py-2 border">Gambar</th>
                <th class="px-4 py-2 border">Tanggal</th>
                <th class="px-4 py-2 border">Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach($posts as $post)
    <tr>
        <td class="px-4 py-2 border">{{ $loop->iteration }}</td>
        <td class="px-4 py-2 border">{{ $post->title }}</td>
        <td class="px-4 py-2 border">
            @if($post->image)
                <img src="{{ asset('storage/'.$post->image) }}" alt="Image" width="100">
            @endif
        </td>
        <td class="px-4 py-2 border">{{ $post->created_at->format('d-m-Y') }}</td>
        <td class="px-4 py-2 border">
            <a href="{{ route('posts.show', $post->slug) }}" class="text-blue-500">Lihat</a>  <!-- Tombol Show -->
            <a href="{{ route('posts.edit', $post->id) }}" class="text-blue-500">Edit</a>
            <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display:inline-block;">
                @csrf
                @method('DELETE')
                <button type="submit" class="text-red-500">Hapus</button>
            </form>
        </td>
    </tr>
@endforeach

        </tbody>
    </table>
</div>
@endsection
