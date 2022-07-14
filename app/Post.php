<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $guarded = [];
    
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function getPostImageAttribute($value) {
        if (strpos($value, 'https://') !== false || strpos($value, 'http://') !== false)
        {
            return $value;
        }
        return asset('storage/' . $value);
    }
}
