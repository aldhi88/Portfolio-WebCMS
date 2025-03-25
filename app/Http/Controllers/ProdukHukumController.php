<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProdukHukumStoreReq;
use App\Http\Requests\ProdukHukumUpdateReq;
use App\Models\ProdukHukum;
use Illuminate\Http\Request;
use DataTables;

class ProdukHukumController extends Controller
{
    public function index()
    {
        return view('modules.produk_hukum.index');
    }

    public function dtIndex()
    {
        $data = ProdukHukum::query()
            ->withCount('produk_hukum_isi as isi_count')
        ;
        return DataTables::of($data)
            ->addColumn('action',function($data){
                $el = '<h6 class="my-0">'.$data->name.'</h6>';
                $el .= '<a class="text-primary fs-13" href="'.route("produk-hukum.edit",$data->id).'"> Edit</a>';
                if($data->isi_count==0){
                    $el .= ' -<a class="text-danger fs-13" href="#delModal" data-toggle="modal" data-target="#delModal" data-id="'.$data->id.'"> Delete</a>';
                }
                $el .= ' -<a class="text-primary fs-13" href="'.route("produk-hukum-isi.create",$data->id).'"> Isi Data</a>';
                $el .= ' -<a class="text-primary fs-13" href="'.route("produk-hukum-isi.index").'?filter='.$data->id.'"> Lihat Data</a>';
                return $el;
            })
            ->addIndexColumn()
            ->smart(false)->toJson();
    }

    public function getData(Request $request)
    {
        $id = $request->id;
        $data = ProdukHukum::select('name')->where('id',$id)->first()->toArray();
        return response()->json($data);
    }

    public function store(ProdukHukumStoreReq $request)
    {
        $data = $request->except('_token');
        ProdukHukum::create($data);
        return notif(true,'success','Data baru sudah ditambahkan.');
    }

    public function edit($id)
    {
        $edit = ProdukHukum::find($id)->toArray();
        return view('modules.produk_hukum.edit', compact('edit'));
    }

    public function update(ProdukHukumUpdateReq $request, $id)
    {
        $data = $request->except('_token', '_method','id');
        ProdukHukum::find($id)->update($data);
        return notif(true,'success','Data sudah diubah.');
    }

    public function destroy($id)
    {
        ProdukHukum::find($id)->delete();
        return notif(true,'success','Data sudah dihapus.');
    }
}
