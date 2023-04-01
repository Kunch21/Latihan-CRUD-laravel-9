<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class ShowController extends Controller
{
    public function index(){
        $shows = Post::oldest()->get();
        return view('create-post', compact('shows'));
    }
}
