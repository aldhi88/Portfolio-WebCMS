<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    use HasFactory;
    protected $guarded = [];

    // relation
    public function users(){
        return $this->belongsTo(User::class,'user_id');
    }

    public static function dtCategories(){
        $ary = [
            [
                'key' => 'master_page',
                'label' => 'Halaman',
            ],
            [
                'key' => 'main_slider',
                'label' => 'Slider Utama',
            ],
            [
                'key' => 'special_link',
                'label' => 'Spesial Link',
            ],
            [
                'key' => 'team',
                'label' => 'Asisten',
            ],
            [
                'key' => 'leader',
                'label' => 'Sambutan',
            ],
            [
                'key' => 'dpo',
                'label' => 'DPO',
            ],
        ];
        return $ary;
    }
}
