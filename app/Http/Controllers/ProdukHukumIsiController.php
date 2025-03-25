<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProdukHukumIsiStoreReq;
use App\Http\Requests\ProdukHukumIsiUpdateReq;
use App\Models\ProdukHukum;
use App\Models\ProdukHukumIsi;
use App\Models\Setting;
use DataTables;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ProdukHukumIsiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $data['filter'] = null;
        if($request->filter){
            $data['filter'] = $request->filter;
        }
        $data['categories'] = ProdukHukum::select('id','name')->get()->toArray();
        return view('modules.produk_hukum_isi.index',compact('data'));
    }

    public function dtIndex(Request $request)
    {
        $data = ProdukHukumIsi::query()
            ->select([
                'produk_hukum_isi.*',
            ])
            ->with([
                'users:id,first_name',
                'produk_hukum:id,name',
            ])
        ;
        if($request->filter != 0){
            $data->where('produk_hukum_id',$request->filter);
        }
        return DataTables::of($data)
            ->addColumn('action',function($data){
                $el = '<h6 class="my-0">'.$data->name.'</h6>';
                $el .= '<a class="text-primary fs-13" href="'.route("produk-hukum-isi.edit",$data->id).'"> Edit</a>';
                $el .= ' -<a class="text-danger fs-13" href="#delModal" data-toggle="modal" data-target="#delModal" data-id="'.$data->id.'"> Delete</a>';
                return $el;
            })
            ->rawColumns(['action'])
            ->smart(true)->toJson();
    }

    public function getData(Request $request)
    {
        $id = $request->id;
        $data = ProdukHukumIsi::select('name')->where('id',$id)->first()->toArray();
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $data['fileSize'] = Setting::where('key','max_file_upload')->first()->getAttribute('value');
        $data['produkHukum'] = ProdukHukum::select('id','name')->where('id',$id)->first()->toArray();
        return view('modules.produk_hukum_isi.create',compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProdukHukumIsiStoreReq $request)
    {
        $data['user_id'] = Auth::user()->id;
        $data['produk_hukum_id'] = $request->produk_hukum_id;
        $extension = $request->file('file')->extension();
        $oriName = $request->file('file')->getClientOriginalName();
        $filename = pathinfo($oriName, PATHINFO_FILENAME);
        $filename = str_replace('_',' ',$filename);
        $filename = str_replace('-',' ',$filename);
        $pathFilename = md5($filename.date('His')).'.'.$extension;
        $data['name'] = $filename;
        $data['tahun'] = date('Y');
        $data['tentang'] = $filename;
        $data['path'] = 'storage/produk_hukum/'.date('Ym').'/'.$pathFilename;
        $data['user_id'] = Auth::user()->id;
        
        $makeDir = Storage::makeDirectory('public/produk_hukum/'.date('Ym'));
        if($makeDir){
            $request->file('file')->storeAs('public/produk_hukum/'.date('Ym'), $pathFilename);
            ProdukHukumIsi::create($data);
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
        $edit = ProdukHukumIsi::find($id)->toArray();
        return view('modules.produk_hukum_isi.edit',compact('edit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ProdukHukumIsiUpdateReq $request, $id)
    {
        $data = $request->except('_method','_token');
        ProdukHukumIsi::find($id)->update($data);
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
        $q = ProdukHukumIsi::find($id);
        $path = str_replace('storage','public',$q->path);
        Storage::delete($path);
        $q->delete();
        return notif(true,'success','Data sudah dihapus.');
    }
}
