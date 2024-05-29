<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\User;


class DashboardController extends Controller
{
    public function index()
{
    $users = User::withCount('posts')->get();
    $totalPosts = Post::count();
    $latestPost = Post::latest()->first();
    
    return view('dashboard', compact('users', 'totalPosts', 'latestPost'));
}

    
}
