<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use App\Models\GalleryRelatedItem;
use App\Models\Media;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\Facades\DataTables;

class GalleryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('modules.gallery.index');
    }

    public function dtIndex()
    {
        $data = Gallery::query()
            ->select([
                'galleries.*'
            ])
            ->with([
                'users:id,first_name',
            ])
            ->withCount('gallery_related_items')
        ;
        // dd($data->get()->toArray());
        return DataTables::of($data)
            ->addColumn('action',function($data){
                $el = '<h6 class="my-0">'.$data->name.'</h6>';
                $el .= '<a class="text-primary fs-13" href="'.route("galleries.edit",$data->id).'"> Edit</a>';
                $el .= ' -<a class="text-danger fs-13" href="#delModal" data-toggle="modal" data-target="#delModal" data-id="'.$data->id.'"> Delete</a>';
                return $el;
            })
            ->addColumn('created_at_format',function($data){
                return Carbon::parse($data->created_at)->format('d M Y');
            })
            ->addIndexColumn()
            ->smart(false)->toJson();
    }

    public function getData(Request $request)
    {
        $id = $request->id;
        $data = Gallery::select('name')->where('id',$id)->first()->toArray();
        return response()->json($data);
    }
    
    public function create()
    {
        session(['gallery_album' => null]);
        $data['fileSize'] = Setting::where('key','max_file_upload')->first()->getAttribute('value');
        return view('modules.gallery.create',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
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
            
            if(is_null(session('gallery_album'))){
                $dtGallery['name'] = $request->name;
                $dtGallery['user_id'] = Auth::user()->id;
                $q = Gallery::create($dtGallery);
                $dtItem['gallery_id'] = $q->id;
                $cekGallery = Gallery::where('name',$request->name)->get();
                if(count($cekGallery)>0){
                    $dtItem['gallery_id'] = $cekGallery->first()->id;
                    Gallery::where('name',$request->name)->where('id','!=',$cekGallery->first()->id)->delete();
                }
                session(['gallery_album' => $dtItem['gallery_id']]);
            }else{
                $cekGallery = Gallery::where('name',$request->name)->orderBy('id','asc')->get();
                if(count($cekGallery)>0){
                    $dtItem['gallery_id'] = $cekGallery->first()->id;
                    Gallery::where('name',$request->name)->where('id','!=',$dtItem['gallery_id'])->delete();
                }else{
                    $dtItem['gallery_id'] = session('gallery_album');
                    Gallery::find($dtItem['gallery_id'])->update(['name' => $request->name]);
                }
                
                
            }
            
            $dtItem['path'] = $data['path'];
            GalleryRelatedItem::create($dtItem);
            $request->file('file')->storeAs('public/media/'.date('Ym'), $filename);
            Media::create($data);
        }else{
            return notif(false,'error','Tidak bisa membuat direktori baru pada server.'); 
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function show(Gallery $gallery)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function edit(Gallery $gallery)
    {
        $edit = Gallery::where('id',$gallery->id)
            ->with([
                'users:id,first_name',
                'gallery_related_items',
            ])
            ->first()->toArray();
        ;
        $data['fileSize'] = Setting::where('key','max_file_upload')->first()->getAttribute('value');
        return view('modules.gallery.edit',compact('data','edit'));
    }

    public function dtEdit(Request $request)
    {
        $data = GalleryRelatedItem::query()
            ->where('gallery_id',$request->id)
        ;
        // dd($data->get()->toArray());
        return DataTables::of($data)
            ->addColumn('action',function($data){
                $el = '
                <div class="media my-1" >
                    <img class="avatar-sm align-self-start rounded mr-3" src="'.asset($data->path).'" alt="">
                    <div class="media-body">
                        <a class="text-danger fs-13" href="#delModal" data-toggle="modal" data-target="#delModal" data-id="'.$data->id.'"> Delete</a>
                    </div>
                </div>
                ';
                return $el;
            })
            ->addIndexColumn()
            ->smart(false)->toJson();
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function upAlbumName(Request $request, $id)
    {
        $data = $request->except('_token','_method');
        Gallery::find($id)->update($data);
        return notif(true,'success','Data sudah diubah.');
    }
    public function update(Request $request, Gallery $gallery)
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
            $dtItem['gallery_id'] = $request->id;
            $dtItem['path'] = $data['path'];
            GalleryRelatedItem::create($dtItem);
            $request->file('file')->storeAs('public/media/'.date('Ym'), $filename);
            Media::create($data);
        }else{
            return notif(false,'error','Tidak bisa membuat direktori baru pada server.'); 
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Gallery  $gallery
     * @return \Illuminate\Http\Response
     */
    public function destroy(Gallery $gallery)
    {
        GalleryRelatedItem::where('gallery_id',$gallery->id)->delete();
        Gallery::find($gallery->id)->delete();
        return notif(true,'success','Data sudah dihapus.');
    }

    public function delItem($itemId)
    {
        GalleryRelatedItem::find($itemId)->delete();
        return notif(true,'success','Data sudah dihapus.');
    }
}
