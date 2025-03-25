<?php

namespace App\Http\Controllers;

use App\Http\Requests\PageStoreReq;
use App\Http\Requests\PageUpdateReq;
use App\Models\Media;
use App\Models\MediaCategory;
use App\Models\Page;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class PageController extends Controller
{
    public function index()
    {
        $data['categories'] = Page::dtCategories();
        return view('modules.page.index',compact('data'));
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
        ;
        if($request->filter != 'x'){
            $data->where('category',$request->filter);
        }
        return DataTables::of($data)
            ->addColumn('action',function($data){
                $el = '<h6 class="my-0">'.$data->title.'</h6>';
                $el .= '<a class="text-primary fs-13" href="'.route("pages.edit",$data->id).'"> Edit</a>';
                $el .= ' -<a class="text-danger fs-13" href="#delModal" data-toggle="modal" data-target="#delModal" data-id="'.$data->id.'"> Delete</a>';
                return $el;
            })
            ->addColumn('created_at_format',function($data){
                return Carbon::parse($data->created_at)->format('d M Y');
            })
            
            ->rawColumns(['action'])
            ->smart(true)->toJson();
    }

    public function getData(Request $request)
    {
        $id = $request->id;
        $q = Page::select('title')->where('id',$id)->first()->toArray();
        $data['name'] = $q['title'];
        return response()->json($data);
    }

    public function create()
    {
        $data['maxSize'] = Setting::where('key','max_file_upload')->first()->getAttribute('value');
        return view('modules.page.create',compact('data'));
    }

    public function getOrder(Request $request)
    {
        $data['order'] = Page::where('category',$request->category)->get()->count();
        if($request->edit == 'false'){
            $data['order'] = $data['order'] + 1;
        }
        $data['edit'] = $request->edit;
        
        return view('modules.page.order',compact('data'));
    }

    public function getMedia(Request $request)
    {
        $data['categories'] = Media::dtCategories();
        return view('modules.page.modal_media_content',compact('data'));
    }

    public function dtMedia(Request $request)
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
                        <h5 class="mt-3 font-size-14">'.$data->name.'</h5>
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

    public function getMediaImage(Request $request)
    {
        return view('modules.page.modal_media_image_content');
    }

    public function dtMediaImage(Request $request)
    {
        $data = Media::query()
            ->select([
                'media.*',
            ])
            ->with([
                'users:id,first_name',
            ])
            ->where('category','Gambar');
        ;
        return DataTables::of($data)
            ->addColumn('action',function($data){
                $thumb = MediaCategory::getThumb($data->id);
                $el = '
                <div class="media my-1" >
                    <img class="avatar-sm align-self-start rounded mr-3" src="'.asset($data->thumbnail).'" alt="">
                    <div class="media-body">
                        <h5 class="mt-3 font-size-14">'.$data->name.'</h5>
                    </div>
                </div>
                ';
                return $el;
            })
            ->addColumn('created_at_format',function($data){
                return Carbon::parse($data->created_at)->format('d M Y');
            })
            ->addColumn('pick',function($data){
                $path = env('APP_URL').'/'.$data->path;
                $storage = $data->path;
                $el = '
                    <button class="btn btn-secondary btn-sm pick" path="'.$path.'" storage="'.$storage.'">Pilih</button>
                ';
                
                return $el;
            })
            ->rawColumns(['action','pick'])
            ->smart(true)->toJson();
    }

    public function store(PageStoreReq $request)
    {
        $data = $request->except('_token','image','image_media');
        $data['user_id'] = Auth::user()->id;
        if(is_null($request->image_media) && !$request->hasFile('image')){
            $data['image'] = 'assets/images/default/no_image.jpg';
        }else{
            if($request->hasFile('image')){
                // insert ke media

                $dir = 'public/media/'.date('Ym');
                Storage::makeDirectory($dir);
                $extension = $request->file('image')->extension();
                $oriName = $request->file('image')->getClientOriginalName();
                $filename = pathinfo($oriName, PATHINFO_FILENAME);
                $filename = str_replace(' ','_',$filename);
                $filename = str_replace('-','_',$filename);
                $filename = str_replace('.','_',$filename);
                $q = Media::where('name',$filename.'.'.$extension)->get()->count();
                $filename = ($q!=0?$filename.'_'.date('His'):$filename).'.'.$extension;
                $request->file('image')->storeAs($dir, $filename);
                $data['image'] = 'storage/media/'.date('Ym').'/'.$filename;

                // insert ke media
                $dtMedia['category'] = Media::getCategories($extension);
                $dtMedia['name'] = $filename;
                $dtMedia['path'] = 'storage/media/'.date('Ym').'/'.$filename;
                if($dtMedia['category'] == 'Gambar'){
                    $dtMedia['thumbnail'] = $dtMedia['path'];
                }else{
                    $dtMedia['thumbnail'] = Media::getThumbnail($dtMedia['category']);
                }
                $dtMedia['user_id'] = Auth::user()->id;
                Media::create($dtMedia);
            }else{
                $data['image'] = $request->image_media;
            }
        }

        if($request->category != 'master_page'){
            $order = $request->order;
            $cek = Page::where('category',$request->category)->where('order',$order)->get()->count();
            if($cek != 0){
                Page::where('order','>=',$order)->increment('order');
            }
            $data['order'] = $order;
        }

        Page::create($data);

        return notif(true,'success','Halaman baru sudah dibuat.');
    }

    public function edit($id)
    {
        $edit = Page::find($id)->toArray();
        $data['maxSize'] = Setting::where('key','max_file_upload')->first()->getAttribute('value');
        return view('modules.page.edit',compact('data','edit'));
    }

    public function update(PageUpdateReq $request)
    {
        $data = $request->except('_token','image','image_media','id');
        $data['user_id'] = Auth::user()->id;

        if( !is_null($request->image_media) || $request->hasFile('image')){
            if($request->hasFile('image')){
                $dir = 'public/media/'.date('Ym');
                Storage::makeDirectory($dir);
                $extension = $request->file('image')->extension();
                $oriName = $request->file('image')->getClientOriginalName();
                $filename = pathinfo($oriName, PATHINFO_FILENAME);
                $filename = str_replace(' ','_',$filename);
                $filename = str_replace('-','_',$filename);
                $filename = str_replace('.','_',$filename);
                $q = Media::where('name',$filename.'.'.$extension)->get()->count();
                $filename = ($q!=0?$filename.'_'.date('His'):$filename).'.'.$extension;
                $request->file('image')->storeAs($dir, $filename);
                $data['image'] = 'storage/media/'.date('Ym').'/'.$filename;
            }else{
                $data['image'] = $request->image_media;
            }
        }

        Page::find($request->id)->update($data);
        return notif(true,'success','Data halaman sudah diubah.');
        
    }

    public function destroy($id)
    {
        Page::find($id)->delete();
        return notif(true,'success','Data sudah dihapus.');
    }

}
