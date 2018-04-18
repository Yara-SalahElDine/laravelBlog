<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon;

class Comment extends Model
{
    protected $fillable = [
        'comment',
        'user_id',
        'commentable_type',
        'commentable_id',
    ];
    public function user()
    {
        //User::class == 'App\User'
        return $this->belongsTo(User::class);
    }
    
     /**
     * Get all of the owning commentable models.
     */
    public function commentable()
    {
        return $this->morphTo();
    }

    public function getDateAttribute()
    {
        $createdAt = new Carbon ($this->created_at);
        //dd($createdAt->format('jS \o\f F, Y g:i:s a'));
      return "{$createdAt->format('l jS \\of F Y h:i:s A')}";
    }
}
