<?php

namespace App\Http\Controllers;

use App\Http\Requests\MediaStoreReq;
use App\Http\Requests\MediaUpdateReq;
use App\Models\Media;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class MediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['categories'] = Media::dtCategories();
        return view('modules.media.index',compact('data'));
    }

    public function dtIndex(Request $request)
    {
        $data = Media::query()
            ->select([
                'media.*',
            ])
            ->with([
                'users:id,first_name',
            ])
        ;
        if($request->filter != 0){
            $data->where('category',$request->filter);
        }
        return DataTables::of($data)
            ->addColumn('action',function($data){
                $el = '
                <div class="media my-1" >
                    <img class="avatar-sm align-self-start rounded mr-3" src="'.asset($data->thumbnail).'" alt="">
                    <div class="media-body">
                        <h5 class="mt-1 font-size-14">'.$data->name.'</h5>
                        <a class="text-danger fs-13" href="#delModal" data-toggle="modal" data-target="#delModal" data-id="'.$data->id.'"> Delete</a>
                        -<a class="text-primary fs-13" href="'.route("media.edit",$data->id).'" data-id="'.$data->id.'"> Edit Nama</a>
                    </div>
                </div>
                ';
                return $el;
            })
            ->addColumn('created_at_format',function($data){
                return Carbon::parse($data->created_at)->format('d M Y');
            })
            ->addColumn('url',function($data){
                $path = env('APP_URL').'/'.$data->path;
                $el = '
                <div class="input-group">
                    <input type="text" id="copy-'.$data->id.'" name="copy" value="'.$path.'" class="form-control">
                    <div class="input-group-append">
                            <span class="input-group-text hover-click clipboard" data-id="'.$data->id.'">
                                Salin
                            </span>
                    </div>
                </div>
                ';
                
                return $el;
            })
            ->rawColumns(['action','url'])
            ->smart(true)->toJson();
    }

    public function getData(Request $request)
    {
        $id = $request->id;
        $data = Media::select('name')->where('id',$id)->first()->toArray();
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['fileSize'] = Setting::where('key','max_file_upload')->first()->getAttribute('value');
        return view('modules.media.create',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MediaStoreReq $request)
    {
        $extension = $request->file('file')->extension();
        $data['category'] = Media::getCategories($extension);
        $oriName = $request->file('file')->getClientOriginalName();
        $filename = pathinfo($oriName, PATHINFO_FILENAME);
        $filename = str_replace(' ','_',$filename);
        $filename = str_replace('-','_',$filename);
        $filename = str_replace('.','_',$filename);
        $q = Media::where('name',$filename.'.'.$extension)->get()->count();
        $filename = ($q!=0?$filename.'_'.date('His'):$filename).'.'.$extension;
        $data['name'] = $filename;
        $data['path'] = 'storage/media/'.date('Ym').'/'.$filename;
        if($data['category'] == 'Gambar'){
            $data['thumbnail'] = $data['path'];
        }else{
            $data['thumbnail'] = Media::getThumbnail($data['category']);
        }
        $data['user_id'] = Auth::user()->id;
        
        
        $makeDir = Storage::makeDirectory('public/media/'.date('Ym'));
        if($makeDir){
            $request->file('file')->storeAs('public/media/'.date('Ym'), $filename);
            Media::create($data);
            return notif(true,'success','File sudah berhasil diunggah.');
        }else{
            return notif(false,'error','Tidak bisa membuat direktori baru pada server.'); 
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $edit = Media::find($id)->toArray();
        return view('modules.media.edit',compact('edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MediaUpdateReq $request, $id)
    {
        $q = Media::find($id);
        $oldName = 'public/library/'.$q->dir.'/'.$q->name.'.'.$q->extension;
        $newName = 'public/library/'.$q->dir.'/'.$request->name.'.'.$q->extension;
        $dir = str_replace('storage','public',str_replace($q->name,'',$q->path));
        $oldName = $q->name;

        $newName = $request->name;
        $newName = str_replace(' ','_',$newName);
        $newName = str_replace('-','_',$newName);
        $newName = str_replace('.','_',$newName);
        $newName = $newName.$request->extension;
        Storage::move($dir.$oldName,$dir.$newName);

        $data['path'] = str_replace('public','storage',$dir).$newName;
        if($q->category=='Gambar'){
            $data['thumbnail'] = $data['path'];
        }
        $data['name'] = $newName;
        Media::find($id)->update($data);
        return notif(true,'success','Data sudah diubah.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $q = Media::find($id);
        $path = str_replace('storage','public',$q->path);
        Storage::delete($path);
        $q->delete();
        return notif(true,'success','Data sudah dihapus.');
    }
}
