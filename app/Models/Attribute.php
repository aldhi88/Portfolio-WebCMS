<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attribute extends Model
{
    use HasFactory;
    protected $guarded = [];

    public static function getAttr($key){
        return Attribute::where('key',$key)->first()->getAttribute('value');
    }
}
