<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProdukHukumIsi extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $table = 'produk_hukum_isi';


    // relation
    public function users(){
        return $this->belongsTo(User::class,'user_id');
    }
    public function produk_hukum(){
        return $this->belongsTo(ProdukHukum::class,'produk_hukum_id');
    }
}
