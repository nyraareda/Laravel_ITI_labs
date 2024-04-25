<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\PostStoreRequest;
use App\Models\Comment;
use Illuminate\Support\Facades\File;
use App\Http\Resources\PostResource;
class PostController extends Controller
{
    // function index(){
    //     $posts=Post::all();
    //     $posts=Post::simplePaginate(15);
    //     return PostResource::collection($posts);
    //  }

    //for enhancement
     function index()
    {
        $posts = Post::with('user')->simplePaginate(15);
        return PostResource::collection($posts);
    }
     function store(PostStoreRequest $request)
     {
         $post = new Post;
         $post->title = $request->title;
         $post->body = $request->body;
         $post->posted_by = $request->posted_by;
     
         if ($request->hasFile('image')) {
             $originalFilename = $request->image->getClientOriginalName();
     
             $request->image->move(public_path('images'), $originalFilename);
     
             $post->image = $originalFilename;
         } else {
             $post->image = 'default.jpg';
         }
     
         $post->save();
     
         return ("added");
     }
     public function show($id)
    {
        $post = Post::findOrFail($id);
        $comments = Comment::where('post_id', $post->id)->get();
        return new PostResource($post);;
    }
    function update($id , PostStoreRequest $request){
        $post = Post::find($id);
        
        // Check if the post exists
        if (!$post) {
            return redirect("/posts")->with('error', 'Post not found.');
        }
        
        $post->title = $request->title;
        $post->body = $request->body;
        
        // Update the user who posted the content
        $post->posted_by = $request->posted_by;
        
        $post->save();
        
        return ("updated");
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
        
        return ("deleted");
    }
    
    
}
