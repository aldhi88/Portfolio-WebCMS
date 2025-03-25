<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostRelatedCategory extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function posts(){
        return $this->belongsTo(Post::class,'post_id');
    }

    public function post_categories(){
        return $this->belongsTo(PostCategory::class,'post_category_id');
    }
}

