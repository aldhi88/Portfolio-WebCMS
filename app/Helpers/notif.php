<?php

use App\Models\Link;

function footerLink(){
    // topMenu =======================================================================
    $q = Link::where('category','footer_link')->where('level',1)
        ->orderBy('order','asc')->get()->toArray();
    return $q;
}

function topMenu(){
    // topMenu =======================================================================
    $q = Link::where('category','top_menu')->where('level','<=',2)
        ->orderBy('order','asc')->get()->toArray();
    $links = null;$levelBefore=1;
    $length = count($q);
    foreach ($q as $key => $value) {
        if($value['count_child']==0 && $value['level'] == 1){
            if($levelBefore!=1){
                $links .= '</ul></li>';
            }
            $links .= '<li><a href="'.$value['link'].'">'.$value['name'].'</a></li>';
        }
        else{
            if($levelBefore!=1 && $value['level'] == 1){
                $links .= '</ul></li>';
            }
            if($value['level']==1){
                $links .= '
                    <li class="dropdown">
                    <a href="#" class="dropdown-toggle active" data-toggle="dropdown">'.$value['name'].'</a>
                    <ul class="dropdown-menu">
                ';
            }else{
                $links .= '<li><a href="'.$value['link'].'">'.$value['name'].'</a></li>';
            }
        }
        if($key == $length-1 && $value['level']!=1){
            $links .= '</ul></li>';
        }
        $levelBefore=$value['level'];
    }
    return $links;
}



function notif($status,$type,$msg){
    $return = [
        'status' => $status,
        'data' => ['type' => $type,'msg' => $msg],
    ];
    return response()->json($return);
}

function data($status,$data){
    $return = [
        'status' => $status,
        'data' => $data,
    ];
    return response()->json($return);
}

function notifWithData($status,$type,$msg,$other){
    $return = [
        'status' => $status,
        'data' => ['type' => $type,'msg' => $msg],
        'other' => $other,
    ];
    return response()->json($return);
}

