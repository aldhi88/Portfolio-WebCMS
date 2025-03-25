<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostCategoryStoreReq;
use App\Http\Requests\PostCategoryUpdateReq;
use App\Models\PostCategory;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;

class PostCategoryController extends Controller
{
    public function index()
    {
        return view('modules.post_category.index');
    }

    public function dtIndex()
    {
        $data = PostCategory::query();
        return DataTables::of($data)
            ->addColumn('action',function($data){
                $el = '<h6 class="my-0">'.$data->name.'</h6>';
                $el .= '<a class="text-primary fs-13" href="'.route("post-categories.edit",$data->id).'"> Edit</a>';
                $el .= ' -<a class="text-danger fs-13" href="#delModal" data-toggle="modal" data-target="#delModal" data-id="'.$data->id.'"> Delete</a>';
                // $el .= ' -<a class="text-primary fs-13" href="#modalDefault" data-toggle="modal" data-target="#modalDefault" data-id="'.$data->id.'"> Default</a>';
                return $el;
            })
            // ->addColumn('default',function($data){
            //     return $data->is_default==0?null:'Ya';
            // })
            ->addIndexColumn()
            ->smart(false)->toJson();
    }

    public function getData(Request $request)
    {
        $id = $request->id;
        $data = PostCategory::select('name')->where('id',$id)->first()->toArray();
        return response()->json($data);
    }

    public function store(PostCategoryStoreReq $request)
    {
        $data = $request->except('_token');
        $count = PostCategory::get()->count();
        if($count==0){
            $data['is_default'] = 1;
        }else{
            if($request->is_default == 1){
                PostCategory::query()->update(['is_default'=>0]);
            }
        }

        PostCategory::create($data);
        return notif(true,'success','Data baru sudah ditambahkan.');
    }

    public function edit($id)
    {
        $edit = PostCategory::find($id)->toArray();
        return view('modules.post_category.edit', compact('edit'));
    }

    public function update(PostCategoryUpdateReq $request, $id)
    {
        $data = $request->except('_token', '_method','id');
        PostCategory::find($id)->update($data);
        return notif(true,'success','Data sudah diubah.');
    }

    public function upDefault(Request $request, $id)
    {
        $data = $request->except('_token', '_method','id');
        PostCategory::query()->update(['is_default'=>0]);
        PostCategory::find($id)->update($data);
        return notif(true,'success','Data sudah diubah.');
    }

    public function destroy($id)
    {
        PostCategory::find($id)->delete();
        return notif(true,'success','Data sudah dihapus.');
    }
}
