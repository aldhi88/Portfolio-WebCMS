<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DataTables;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('modules.comment.index');
    }

    public function dtIndex(Request $request)
    {
        $data = Comment::query()
            ->select([
                'comments.*',
            ])
            ->with([
                'users:id,first_name',
                'posts:id,title',
            ])
        ;
        if($request->filter != 'x'){
            $data->where('status',$request->filter);
        }
        return DataTables::of($data)
            ->addColumn('created_at_action',function($data){
                $el = '<h6 class="my-0">'.Carbon::parse($data->created_at)->format('d M Y').'</h6>';
                $el .= '<a class="text-primary fs-13" href="#approve" data-toggle="modal" data-target="#approve" data-id="'.$data->id.'"> Proses</a>';
                return $el;
            })
            ->addColumn('status_format',function($data){
                $return = '<span class="badge badge-soft-secondary">Belum Diproses</span>';
                if($data->approve == 1){
                    $return = '<span class="badge badge-soft-success">Disetujui</span>';
                }else if($data->approve == 2){
                    $return = '<span class="badge badge-soft-danger">Ditolak</span>';
                }
                return $return;
            })
            ->addColumn('user_format',function($data){
                return is_null($data->users)?'-':$data->users->first_name;
            })
            ->rawColumns(['status_format','created_at_action'])
            ->smart(true)->toJson();
    }

    public function getData(Request $request)
    {
        $id = $request->id;
        $data = Comment::where('id',$id)
            ->with([
                'posts:id,title',
            ])
            ->first()->toArray();
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Comment $comment)
    {
        $data['user_id'] = Auth::user()->id;
        if($request->action == 'approve'){
            $data['approve'] = 1;
        }else{
            $data['approve'] = 2;
        }
        Comment::where('id',$request->id)->update($data);
        return notif(true,'success','Data sudah diubah.');
    }

}
