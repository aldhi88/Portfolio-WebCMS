<?php

namespace App\Http\Controllers;

use App\Models\Page;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class WidgetController extends Controller
{
    public function index()
    {
        $data['categories'] = Page::dtCategories();
        return view('modules.widget.index',compact('data'));
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
            ->where('category','special_link');
        ;
        return DataTables::of($data)
            ->addColumn('action',function($data){
                $el = '<h6 class="my-0">'.$data->title.'</h6>';
                $el .= '<a class="text-primary fs-13" href="'.route("widgets.edit",$data->id).'"> Edit</a>';
                $el .= ' -<a class="text-danger fs-13" href="#delModal" data-toggle="modal" data-target="#delModal" data-id="'.$data->id.'"> Delete</a>';
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
        return view('modules.widget.create',compact('data'));
    }

    public function edit($id)
    {
        $edit = Page::find($id)->toArray();
        $data['maxSize'] = Setting::where('key','max_file_upload')->first()->getAttribute('value');
        return view('modules.widget.edit',compact('data','edit'));
    }

}
