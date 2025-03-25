<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukHukum extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'produk_hukum';

    // relation
    public function produk_hukum_isi(){
        return $this->hasMany(ProdukHukumIsi::class,'produk_hukum_id');
    }
}
