<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    use HasFactory;
    protected $guarded = [];

    // relation
    public function users(){
        return $this->belongsTo(User::class,'user_id');
    }

    public static function dtCategories(){
        $dt = [
            1 => 'Gambar',
            2 => 'Video',
            3 => 'Audio',
            4 => 'Dokumen',
            5 => 'Lainnya',
        ];
        return $dt;
    }
    public static function getCategories($extension){
        $dt = Media::dtCategories();
        $ext = [
            'jpeg' => 1,'jpg' => 1,'png' => 1,'gif' => 1,
            'mp4' =>2,'mov' =>2,'mpeg' =>2,'3gp' =>2,'mkv' =>2,'avi' =>2,
            'mp2' => 3,'wav' => 3,
            'pdf' => 4,'doc' => 4,'docx' => 4,'xls' => 4,'xlsx' => 4,'ppt' => 4,'pptx' => 4,
        ];
        if(array_key_exists($extension,$ext)){
            return $dt[$ext[$extension]];
        }else{
            return $dt[5];
        }
    }

    public static function getThumbnail($category){
        if($category == 'Video'){
            $path = 'assets/images/default/thumb_video.png';
        }else if($category == 'Audio'){
            $path = 'assets/images/default/thumb_audio.png';
        }else if($category == 'Dokumen'){
            $path = 'assets/images/default/thumb_doc.png';
        }else{
            $path = 'assets/images/default/thumb_file.png';
        }
        return $path;
    }

}
