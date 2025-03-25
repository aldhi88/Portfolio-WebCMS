<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;

class ContactController extends Controller
{
    public function index()
    {
        return view('modules.contact.index');
    }

    public function dtIndex(Request $request)
    {
        $data = Contact::query()
            ->select([
                'contacts.*',
            ])
            ->with([
                'users:id,first_name',
            ])
        ;
        if($request->filter != 'x'){
            $data->where('status',$request->filter);
        }
        return DataTables::of($data)
            ->addColumn('created_at_action',function($data){
                $el = '<h6 class="my-0">'.Carbon::parse($data->created_at)->format('d M Y').'</h6>';
                if($data->status==0){
                    $el .= '<a class="text-primary fs-13" href="'.route("contacts.edit",$data->id).'"> Proses</a>';
                }
                if($data->status==1){
                    $el .= ' <a class="text-primary fs-13" href="'.route("contacts.show",$data->id).'"> Lihat</a>';
                }
                return $el;
            })
            ->addColumn('status_format',function($data){
                $return = '<span class="badge badge-soft-secondary">Belum Diproses</span>';
                if($data->status == 1){
                    $return = '<span class="badge badge-soft-success">Sudah Diproses</span>';
                }
                return $return;
            })
            ->addColumn('user_format',function($data){
                return is_null($data->users)?'-':$data->users->first_name;
            })
            ->rawColumns(['status_format','created_at_action'])
            ->smart(true)->toJson();
    }

    public function edit($id)
    {
        $data = Contact::find($id)->toArray();
        return view('modules.contact.edit',compact('data'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->except('_token', '_method');
        $data['user_id'] = Auth::user()->id;
        $data['status'] = 1;
        Contact::find($id)->update($data);
        return notif(true,'success','Data sudah diubah.');
    }

    public function show($id)
    {
        $data = Contact::find($id)->toArray();
        return view('modules.contact.show',compact('data'));
    }
}
