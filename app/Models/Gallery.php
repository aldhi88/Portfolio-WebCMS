<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;
    protected $guarded = [];

    // relation
    public function users(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function gallery_related_items(){
        return $this->hasMany(GalleryRelatedItem::class,'gallery_id');
    }
}
