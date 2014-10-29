<?php

class CommentController extends BaseController
{

    /* get functions */
    public function listComment()
    {
        $comments = Comment::orderBy('id', 'desc')->paginate(20);
        $this->layout->title = 'Comment Listings';
        $this->layout->main = View::make('dash')->nest('content', 'comments.list', compact('comments'));
    }

    public function newComment(Picture $picture)
    {
        $comment = [
            'commenter' => Input::get('commenter'),
            'email' => Input::get('email'),
            'comment' => Input::get('comment'),
        ];
        $rules = [
            'commenter' => 'required',
            'email' => 'required | email',
            'comment' => 'required',
        ];
        $valid = Validator::make($comment, $rules);
        if ($valid->passes()) {
            $comment = new Comment($comment);
            $picture->comments()->save($comment);
            $picture->increment('comment_count');
            /* redirect back to the form portion of the page */
            return Redirect::to(URL::previous() . '#reply')
                ->with('success', 'Comment has been submitted!');
        } else {
            return Redirect::to(URL::previous() . '#reply')->withErrors($valid)->withInput();
        }
    }

    public function showComment(Comment $comment)
    {
        if (Request::ajax())
            return View::make('comments.show', compact('comment'));
        // handle non-ajax calls here
        //else{}
    }

    public function deleteComment(Comment $comment)
    {
        $picture = $comment->picture;
        $comment->delete();
        $picture->decrement('comment_count');
        return Redirect::back()->with('success', 'Comment deleted!');
    }

    /* picture functions */

    public function updateComment(Comment $comment)
    {
        $comment->save();
        $comment->picture->comment_count = Comment::where('picture_id', '=', $comment->picture->id)->count();
        $comment->picture->save();
        return Redirect::back();
    }

}