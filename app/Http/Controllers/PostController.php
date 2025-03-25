<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostStoreReq;
use App\Http\Requests\PostUpdateReq;
use App\Models\Media;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\PostRelatedCategory;
use App\Models\Setting;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Yajra\DataTables\DataTables;

class PostController extends Controller
{
    public function index()
    {
        $data['categories'] = PostCategory::all();
        return view('modules.post.index',compact('data'));
    }

    public function dtIndex(Request $request)
    {
        $data = Post::query()
            ->select([
                'posts.*',
            ])
            ->with([
                'users:id,first_name',
                'post_related_categories:post_id,post_category_id',
                'post_related_categories.post_categories:id,name',
            ])
        ;
        if($request->filter1 != 'x'){
            $data->whereHas('post_related_categories',function($q) use($request){
                $q->where('post_category_id',$request->filter1);
            });
        }
        if($request->filter2 != 'x'){
            $data->where('is_publish',$request->filter2);
        }
        return DataTables::of($data)
            ->addColumn('action',function($data){
                $el = '<h6 class="my-0">'.$data->title.'</h6>';
                $el .= '<a class="text-primary fs-13" href="'.route("posts.edit",$data->id).'"> Edit</a>';
                $el .= ' -<a class="text-danger fs-13" href="#delModal" data-toggle="modal" data-target="#delModal" data-id="'.$data->id.'"> Delete</a>';
                return $el;
            })
            ->addColumn('categories',function($data){
                $el = null;
                foreach ($data->post_related_categories as $key => $value) {
                    $el .= $key!=0?', ':null;
                    $el .= '<small><mark>'.$value->post_categories->name.'</mark></small>';
                }
                return $el;
            })
            ->addColumn('status',function($data){
                return $data->is_publish==0?
                    '<span class="badge badge-soft-dark d-block"><h7 class="mb-0 fs-13">Draf</h7></span>':   
                    '<span class="badge badge-soft-success d-block"><h7 class="mb-0 fs-13">Diterbitkan</h7></span>'   
                ;
            })
            ->addColumn('created_at_format',function($data){
                return Carbon::parse($data->created_at)->format('d M Y');
            })
            
            ->rawColumns(['action','categories','status'])
            ->smart(true)->toJson();
    }

    public function getData(Request $request)
    {
        $id = $request->id;
        $q = Post::select('title')->where('id',$id)->first()->toArray();
        $data['name'] = $q['title'];
        return response()->json($data);
    }

    public function create()
    {
        $data['categories'] = PostCategory::all();
        $data['maxSize'] = Setting::where('key','max_file_upload')->first()->getAttribute('value');
        return view('modules.post.create',compact('data'));
    }

    public function getMedia(Request $request)
    {
        $data['categories'] = Media::dtCategories();
        return view('modules.post.modal_media_content',compact('data'));
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
        return view('modules.post.modal_media_image_content');
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

    public function store(PostStoreReq $request)
    {
        $data = $request->except('_token','image','post_category_id','image_media');
        $data['user_id'] = Auth::user()->id;

        if(is_null($request->image_media) && !$request->hasFile('image')){
            $data['image'] = 'assets/images/default/no_image.jpg';
        }else{
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
                dump(0);
                dd($request->all());
                $data['image'] = $request->image_media;
            }
        }
        $q = Post::create($data);
        foreach ($request->post_category_id as $key => $value) {
            $dtCat[] = [
                'post_id' => $q->id,
                'post_category_id' => $value,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }
        PostRelatedCategory::insert($dtCat);

        if($request->is_publish==0){
            return notif(true,'success','Berita baru sudah disimpan sebagai draf.');
        }else{
            return notif(true,'success','Berita baru sudah diterbitkan.');
        }
        
    }

    public function edit($id)
    {
        $edit = Post::find($id)->toArray();
        $data['maxSize'] = Setting::where('key','max_file_upload')->first()->getAttribute('value');
        $data['categories'] = PostCategory::all()->toArray();
        $data['catagory_lists'] = array_column(PostRelatedCategory::select('post_category_id')->where('post_id',$id)->get()->toArray(), 'post_category_id');
        return view('modules.post.edit',compact('data','edit'));
    }

    public function update(PostUpdateReq $request)
    {
        $data = $request->except('_token','image','post_category_id','image_media','id');
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

        Post::find($request->id)->update($data);
        PostRelatedCategory::where('post_id',$request->id)->delete();
        foreach ($request->post_category_id as $key => $value) {
            $dtCat[] = [
                'post_id' => $request->id,
                'post_category_id' => $value,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        }
        PostRelatedCategory::insert($dtCat);

        if($request->is_publish==0){
            return notif(true,'success','Data berita sudah diubah dan disimpan sebagai draf.');
        }else{
            return notif(true,'success','Data berita sudah diubah dan diterbitkan.');
        }
        
    }

    public function destroy($id)
    {
        Post::find($id)->delete();
        PostRelatedCategory::where('post_id',$id)->delete();
        return notif(true,'success','Data sudah dihapus.');
    }

}
