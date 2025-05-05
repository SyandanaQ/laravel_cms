@extends('layouts.app')

@section('content')
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <h1 class="text-3xl font-semibold mb-6">Dashboard</h1>

        <h2 class="text-xl mb-4 text-gray-700">Latest Posts</h2>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($latestPosts as $post)
                <div class="bg-white rounded-lg shadow-md overflow-hidden">
                    @if ($post->image)
                        <img src="{{ asset('storage/' . $post->image) }}" alt="Image" class="w-full h-48 object-cover">
                    @endif
                    <div class="p-4">
                        <h3 class="text-xl font-semibold mb-2 text-gray-800">{{ $post->title }}</h3>
                        <p class="text-gray-600 text-sm mb-4">
                            {{ \Illuminate\Support\Str::limit(strip_tags(html_entity_decode($post->description)), 100) }}
                        </p>
                        <a href="{{ route('posts.show', $post->slug) }}" class="text-blue-500 hover:text-blue-700">Read More</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
