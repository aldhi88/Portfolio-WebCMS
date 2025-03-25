<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Link extends Model
{
    use HasFactory;
    protected $guarded = [];

    public static function dtCategories(){
        $ary = [
            [
                'key' => 'top_menu',
                'label' => 'Menu Utama',
            ],
            [
                'key' => 'footer_link',
                'label' => 'Situs Terkait',
            ],
            [
                'key' => 'copyright_link',
                'label' => 'Copyright Link',
            ],
        ];
        return $ary;
    }

}

