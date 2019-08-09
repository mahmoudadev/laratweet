<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tweet extends Model
{

    protected $fillable = ['content'];

    /**
     * Get the user that owns the tweet.
     */
    public function owner()
    {
        return $this->belongsTo(User::class);
    }
}
