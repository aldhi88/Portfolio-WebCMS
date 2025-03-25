<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $guarded = [];

    // relation
    public function comments(){
        return $this->hasMany(Comment::class,'post_id');
    }
    public function users(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function post_related_categories(){
        return $this->hasMany(PostRelatedCategory::class,'post_id');
    }
}
