<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PostCategory extends Model
{
    use HasFactory;
    protected $guarded = [];

    // relation
    public function post_related_categories(){
        return $this->hasMany(PostRelatedCategory::class,'post_category_id');
    }
}
