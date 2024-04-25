<?php

namespace App\Http\Controllers;
use Laravel\Socialite\Facades\Socialite;
use App\Models\Post; // Make sure to import the Post model
use Illuminate\Http\Request;

class AuthController extends Controller
{
    //


public function redirectToGitHub()
{
    return Socialite::driver('github')->redirect();
}

public function handleGitHubCallback()
{
    $githubUser = Socialite::driver('github')->user();

    $posts = Post::all();
    $posts=Post::simplePaginate(15);
    return view('posts.index', ['posts' => $posts]);
}
}