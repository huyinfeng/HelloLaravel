<?php

class Picture extends Eloquent
{

    protected $fillable = ['title', 'description', 'image'];

    public function comments()
    {
        return $this->hasMany('Comment');
    }
	
    public function user()
    {
    	return $this->belongsto('User');
    }
    public function delete()
    {
        foreach ($this->comments as $comment) {
            $comment->delete();
        }
        return parent::delete();
    }

}
