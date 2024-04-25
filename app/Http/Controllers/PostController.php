<?php

namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\PostStoreRequest;
use Illuminate\Support\Facades\File;
use App\Models\Comment;

class PostController extends Controller
{
    function index(){
       $posts=Post::all();
       $posts=Post::simplePaginate(15);
       return view('posts.index',["posts" => $posts]);
    }

    function create(){
       return view("posts.create");
    }

    // function store(PostStoreRequest $request)
    // {
    //     $post = new Post;
    //     $post->title = $request->title;
    //     $post->body = $request->body;
    //     $post->posted_by = Auth::id();
    //     $request->image->extension();
    //     $newImage = time() . '-' . $request->name . '.' . $request->image->extension();
    //     $request->image->move(public_path('images'), $newImage);
    //     $post->image = $newImage;
    //     $post->save();
        
    //     return redirect("/posts");
    // }

    function store(PostStoreRequest $request)
    {
        $post = new Post;
        $post->title = $request->title;
        $post->body = $request->body;
        $post->posted_by = Auth::id();
    
        if ($request->hasFile('image')) {
            $originalFilename = $request->image->getClientOriginalName();
    
            $request->image->move(public_path('images'), $originalFilename);
    
            $post->image = $originalFilename;
        } else {
            $post->image = 'default.jpg';
        }
    
        $post->save();
    
        return redirect("/posts");
    }



    public function show($id)
    {
        $post = Post::findOrFail($id);
        $comments = Comment::where('post_id', $post->id)->get();
        return view('posts.show', compact('post', 'comments'));
    }

    function edit($id){
        $post=Post::find($id); 
        return view("posts.edit", ["post"=>$post]);
    }
    // function update($id, PostStoreRequest $request){
    //     $post = Post::find($id);
        
    //     if (!$post) {
    //         return redirect("/posts")->with('error', 'Post not found.');
    //     }
        
    //     if ($post->posted_by === Auth::id()) {
    //         $post->title = $request->title;
    //         $post->body = $request->body;
    
    //         if ($request->has('user_id')) {
    //             $user = User::find($request->user_id);
    //             if (!$user) {
    //                 return redirect("/posts")->with('error', 'User not found.');
    //             }
    
    //             $post->posted_by = $request->user_id;
    //         }
    
    //         $post->save();

    //         return redirect("/posts")->with('success', 'Post updated successfully.');
    //     } else {
    //         return redirect("/posts")->with('error', 'You are not authorized to edit this post.');
    //     }
    // }
        
    function update($id , PostStoreRequest $request){
        $post = Post::find($id);
        
        // Check if the post exists
        if (!$post) {
            return redirect("/posts")->with('error', 'Post not found.');
        }
        
        $post->title = $request->title;
        $post->body = $request->body;
        
        // Update the user who posted the content
        $post->posted_by = Auth::id();
        
        $post->save();
        
        return redirect("/posts")->with('success', 'Post updated successfully.');
    }
    
        

    function destroy(Request $request, $id){
        $post = Post::find($id);
        
        if (!$post) {
            return redirect("/posts")->with('error', 'Post not found.');
        }
        
        $imageName = $post->image;
        
        $imagePath = public_path('images') . '/' . $imageName;
        if (File::exists($imagePath)) {
            File::delete($imagePath);
        }

        $post->delete();
        
        return redirect("/posts")->with('success', 'Post deleted successfully.');
    }
    

// function destroy(Request $request, $id){
//     $post = Post::find($id);
    
//     if (!$post) {
//         return redirect("/posts")->with('error', 'Post not found.');
//     }
    
//     $imageName = $post->image;
//     $extension = pathinfo($imageName, PATHINFO_EXTENSION);
    
//     $newImage = time() . '-' . $request->name . '.' . $extension;
//     $imagePath = 'public/images/' . $imageName;
//     if ($post->image && $newImage === $post->image && Storage::exists($imagePath)) {
//         Storage::delete($imagePath);
    
//     $post->delete();
//     return redirect("/posts");
// }

    
// } 
}
