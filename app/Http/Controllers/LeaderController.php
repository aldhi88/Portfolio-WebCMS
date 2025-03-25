<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Setting;
use Illuminate\Http\Request;

class LeaderController extends Controller
{
    public function index()
    {
        $cek = Page::where('category','leader')->get();
        $data['maxSize'] = Setting::where('key','max_file_upload')->first()->getAttribute('value');
        if(count($cek)==0){
            return view('modules.leader.create',compact('data'));
        }else{
            $edit = $cek->first()->toArray();
            return view('modules.leader.edit',compact('data','edit'));
        }
    }


}
