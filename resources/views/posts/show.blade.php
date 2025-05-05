<!-- resources/views/posts/show.blade.php -->
@extends('layouts.app')

@section('content')
    <div class="bg-white p-6 rounded-lg shadow-lg max-w-7xl mx-auto mt-10 px-4">
        <!-- Title Section -->
        <h1 class="text-4xl font-extrabold text-gray-800 mb-6">{{ $post->title }}</h1>

        <!-- Image Section -->
        @if ($post->image)
            <img src="{{ asset('storage/' . $post->image) }}" alt="Image"
                class="rounded-lg shadow-lg mb-6 w-full object-cover h-96">
        @endif

        <!-- Description Section -->
        <div class="text-gray-700 text-lg leading-relaxed">
            {!! $post->description !!}
        </div>

        <!-- Back Button Section -->
        <div class="mt-8">
            <a href="{{ route('posts.index') }}" class="text-blue-500 hover:text-blue-700 font-semibold">
                ← Kembali ke Daftar Berita
            </a>
        </div>
    </div>
@endsection
