<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryRelatedItem extends Model
{
    use HasFactory;
    protected $guarded = [];

    // relation
    public function galleries(){
        return $this->belongsTo(Gallery::class,'gallery_id');
    }
}
