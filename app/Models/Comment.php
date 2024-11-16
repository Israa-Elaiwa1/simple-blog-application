<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['content', 'user_id', 'post_id'];

    /* Comment belongs to this user */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /* Comment belongs to this post */
    public function post()
    {
        return $this->belongsTo(Post::class);
    }

}
