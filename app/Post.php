<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use Sluggable;
    use \Spatie\Tags\HasTags;
    
    protected $fillable = [
        'title',
        'description',
        'photo',
        'user_id'
    ];
    public function user()
    {
        //User::class == 'App\User'
        return $this->belongsTo(User::class);
    }


    /**
     * Get all of the owning commentable models.
     */
    public function comments()
    {
        return $this->morphMany('App\Comment', 'commentable');
    }




/**
 * Get the post's created_at .
 *
 * @return string
 */
    public function getDateAttribute()
    {
        return "{$this->created_at->todatestring()}";
    }

    public function setPhotoAttribute($value)
    {
        if($value == "")
          $this->attributes['photo'] = "";
        else
          $this->attributes['photo'] = "/storage".str_replace("public", "", $value);
    }

    use Sluggable;

    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}





// ay field tani msh haie2balou eni ada5alou data fi el database