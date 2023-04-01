<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BlogController extends Controller
{
    public function index(){
        return view('index');
    }

    public function create(){
        return view('create-post');
    }

    public function store(Request $request){
        $validated = $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'required|unique:posts|max:255',
            'description' => 'required',
        ]);

        $image = $request->file('image');
        $image->storeAs('public/posts', $image->hashName());

        Post::create([
            'image' => $image->hashName(),
            'title' => $request->title,
            'description' => $request->description,
        ]);

        return redirect('/post')->with('success','Berhasil Menambah Post');
    }

    Public function edit(Request $request, $id){
        $post = Post::whereId($id)->first();
        return view('edit-post')->with('post', $post);
    }

    public function update(Request $request, $id){
        $validated = $request->validate([
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'max:255',
            'description' => 'required',
        ]);

    
        $image = $request->file('image');
        $image->storeAs('public/posts', $image->hashName());


        $post = Post::find($id);
        if ($request->file('image') == "") {
            $post->update([
                'title' => $request->title,
                'description' => $request->description
            ]);
        } else {
            Storage::disk('local')->delete('public/posts/'.$post->image);
            $image = $request->file('image');
            $image->storeAs('public/posts', $image->hashName());

            $post->update([
                'image' => $image->hashName(),
                'title' => $request->title,
                'description' => $request->description
            ]);
        }
        $post->save();

        return redirect('/post')->with(['success' => 'Data Berhasil Diubah!']);
    }

    public function destroy($id){
        $post = Post::find($id);
        $post->delete();
        return redirect('/post')->with(['success' => 'Data Berhasil Dihapus!']);
    }
}
