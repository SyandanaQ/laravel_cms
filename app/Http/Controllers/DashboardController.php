<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class DashboardController extends Controller
{
    public function index()
    {
        $latestPosts = Post::latest()->paginate(6); // Misalnya tampilkan 6 berita terbaru
        return view('dashboard.index', compact('latestPosts'));
    }
}
