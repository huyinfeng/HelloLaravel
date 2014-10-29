<?php

class Comment extends Eloquent
{

    protected $fillable = ['commenter', 'email', 'comment'];

    public function picture()
    {
        return $this->belongsTo('Picture');
    }


}
