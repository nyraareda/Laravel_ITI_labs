<?php
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        // Validate the request data
        $request->validate([
            'post_id' => 'required|exists:posts,id',
            'body' => 'required|string',
        ]);

        // Create a new comment instance
        $comment = new Comment();
        $comment->user_id = auth()->id(); // Assuming you're using Laravel's authentication
        $comment->post_id = $request->post_id;
        $comment->body = $request->body;
        $comment->save();

        // Redirect back to the post or wherever you want
        return redirect()->back()->with('success', 'Comment added successfully.');
    }
}
