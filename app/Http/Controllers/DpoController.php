<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class DpoController extends Controller
{
    public function index()
    {
        $data['categories'] = Page::dtCategories();
        return view('modules.dpo.index',compact('data'));
    }

    public function dtIndex(Request $request)
    {
        $data = Page::query()
            ->select([
                'pages.*',
            ])
            ->with([
                'users:id,first_name',
            ])
            ->where('category','dpo')
        ;
        return DataTables::of($data)
            ->addColumn('action',function($data){
                $el = '
                <div class="media my-1" >
                    <img class="avatar-sm align-self-start rounded mr-3" src="'.asset($data->image).'" alt="">
                    <div class="media-body">
                        <h5 class="mt-1 font-size-14">'.$data->title.'</h5>
                        <a class="text-danger fs-13" href="#delModal" data-toggle="modal" data-target="#delModal" data-id="'.$data->id.'"> Delete</a>
                        -<a class="text-primary fs-13" href="'.route("dpos.edit",$data->id).'" data-id="'.$data->id.'"> Edit</a>
                    </div>
                </div>
                ';
                return $el;
            })
            ->addColumn('created_at_format',function($data){
                return Carbon::parse($data->created_at)->format('d M Y');
            })
            
            ->rawColumns(['action'])
            ->smart(true)->toJson();
    }

    public function create()
    {
        $data['maxSize'] = Setting::where('key','max_file_upload')->first()->getAttribute('value');
        return view('modules.dpo.create',compact('data'));
    }

    public function edit($id)
    {
        $edit = Page::find($id)->toArray();
        $data['maxSize'] = Setting::where('key','max_file_upload')->first()->getAttribute('value');
        return view('modules.dpo.edit',compact('data','edit'));
    }


}
