<?php

namespace App\Http\Controllers;

use App\Http\Requests\LinkStoreReq;
use App\Models\Link;
use App\Models\Page;
use App\Models\Post;
use App\Models\PostCategory;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

class LinkController extends Controller
{
    public function index(Request $request)
    {
        $data['categories'] = Link::dtCategories();
        $data['links'] = Link::query()->select('id','name','category','link','parent','order','level','count_child')
            ->orderBy('order','asc')->get()->toArray();
        $dtCollect = collect(Link::all()->toArray());
        foreach ($data['links'] as $key => $value) {
            $data['links'][$key]['up'] = 0;
            $data['links'][$key]['down'] = 0;
            $level = $value['level'];
            $category = $value['category'];
            $parent = $value['parent'];

            $qCek = $dtCollect->where('level',$level)->where('category',$category)->where('parent',$parent);
            
            $qCekUp = ($qCek->sortBy('order')->values())[0];
            if($qCekUp['id'] != $value['id']){
                $data['links'][$key]['up'] = 1;
            }

            $qCekDown = ($qCek->sortByDesc('order')->values())[0];
            if($qCekDown['id'] != $value['id']){
                $data['links'][$key]['down'] = 1;
            }
        }
       
        return view('modules.link.index',compact('data'));
    }

    public function getData(Request $request)
    {
        $category = $request->category;
        $data['links'] = Link::where('category',$category)->get()->toArray();
    }

    public function getPage(Request $request)
    {
        $data['categories'] = Page::dtCategories();
        $data['activeKey'] = $request->category;
        return view('modules.link.modal_page_content',compact('data'));
    }

    public function dtGetPage(Request $request)
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
                return $el;
            })
            ->addColumn('created_at_format',function($data){
                return Carbon::parse($data->created_at)->format('d M Y');
            })
            ->addColumn('pick',function($data){
                $link = env('APP_URL').'/halaman'.'/'.$data->slug;
                $el = '
                    <button class="btn btn-block btn-success btn-sm pick" link="'.$link.'">Pilih</button>
                ';
                
                return $el;
            })
            ->rawColumns(['action','pick'])
            ->smart(true)->toJson();
    }

    public function getPost(Request $request)
    {
        $data['categories'] = PostCategory::all();
        $data['activeKey'] = $request->category;
        return view('modules.link.modal_post_content',compact('data'));
    }

    public function dtGetPost(Request $request)
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
            ->addColumn('pick',function($data){
                $link = env('APP_URL').'/berita'.'/'.$data->slug;
                $el = '
                    <button class="btn btn-block btn-success btn-sm pick" link="'.$link.'">Pilih</button>
                ';
                
                return $el;
            })
            ->rawColumns(['action','categories','status','pick'])
            ->smart(true)->toJson();
    }

    public function getLinkForm(Request $request)
    {
        $data['categories'] = Link::dtCategories();
        $data['links'] = Link::query()->orderBy('order','asc')->get()->toArray();
        $data['active'] = $request->active;
        $dtCollect = collect(Link::all()->toArray());
        foreach ($data['links'] as $key => $value) {
            $data['links'][$key]['up'] = 0;
            $data['links'][$key]['down'] = 0;
            $level = $value['level'];
            $category = $value['category'];
            $parent = $value['parent'];

            $qCek = $dtCollect->where('level',$level)->where('category',$category)->where('parent',$parent);
            
            $qCekUp = ($qCek->sortBy('order')->values())[0];
            if($qCekUp['id'] != $value['id']){
                $data['links'][$key]['up'] = 1;
            }

            $qCekDown = ($qCek->sortByDesc('order')->values())[0];
            if($qCekDown['id'] != $value['id']){
                $data['links'][$key]['down'] = 1;
            }
        }
        return view('modules.link.link_form', compact('data'));
    }

    public function store(LinkStoreReq $request)
    {
        $data = $request->except('_token');
        if($request->parent == 0){
            $data['level'] = 1;
            $cekInCategory = Link::query()->where('category',$request->category)->get()->count();
            if($cekInCategory==0){
                $cekAll = Link::all()->count();
                if($cekAll==0){
                    $order = 1;
                }else{
                    $order = $cekAll+1;
                }
            }else{
                $qOrder = Link::query()->where('category',$request->category);
                if($request->order == 0){
                    $order = $qOrder->where('parent',0)->orderBy('order','asc')->first()->getAttribute('order');
                }else if($request->order < 0){
                    $orderUp = $qOrder->where('parent',0)->orderBy('order','desc')->first();
                    $order = $orderUp->order + $orderUp->count_child + 1;
                }else{
                    $parent = Link::where('order',$request->order)->first()->getAttribute('parent');
                    if($parent != 0){
                        $order = ($qOrder->where('parent',0)->orderBy('order','desc')->first()->getAttribute('order')) + 1;
                    }else{
                        $order = $request->order;
                    }
                }
            }
        }else{
            $data['level'] = (Link::find($request->parent)->getAttribute('level'))+1;
            $qOrder = Link::query()->where('category',$request->category);
            if($request->order == 0){
                $cek = $qOrder->where('level',$data['level'])->orderBy('order','asc')->where('parent',$request->parent)->get();
                if(count($cek)==0){
                    $order = (Link::find($request->parent)->getAttribute('order'))+1;
                }else{
                    $order = $cek->first()->getAttribute('order');
                }
            }else if($request->order < 0){
                $cek = $qOrder->where('level',$data['level'])->orderBy('order','desc')->get();
                if(count($cek)==0){
                        $lvlUp = Link::find($request->parent)->getAttribute('level');
                        $order = (Link::query()->where('category',$request->category)->where('level',$lvlUp)
                            ->where('id',$request->parent)->first()->getAttribute('order'))+1;
                }else{
                    $order = ($cek->first()->getAttribute('order'))+1;
                }
            }else{
                $lvlParent = $data['level']-1;
                $lvlChild = Link::where('order',$request->order)->first()->getAttribute('level');

                if($lvlChild != ($lvlParent+1)){
                    $order = (Link::query()->where('category',$request->category)->where('level',$lvlParent)
                        ->where('id',$request->parent)->first()->getAttribute('order'))+1;
                }else{
                    $order = $request->order;
                }
            }

            $loopParent = $request->parent;
            while($loopParent > 0) {
                $q = Link::find($loopParent);
                $q->increment('count_child');
                $loopParent = $q->parent;
            }
            
        }

        $data['order'] = $order;
        Link::where('order','>=',$data['order'])->increment('order');
        Link::create($data);
        $other = ['active' => $request->category];
        return notifWithData(true,'success','Data baru sudah ditambahkan.',$other);
    }

    public function update(Request $request, $id)
    {
        if($request->edit=='name'){
            $index = Link::find($id)->getAttribute('level');
            $index = $index==1?$index-1:$index;
            $data['name'] = substr($request->value,$index);
        }else{
            $data['link'] = $request->value;
        }
        Link::find($id)->update($data);
        return notif(true,'success','Data baru sudah ditambahkan.');
    }

    public function upOrder(Request $request)
    {
        $qDtUp = Link::find($request->id)->toArray();
        $qDtDown = Link::where('order','<',$qDtUp['order'])->where('level',$qDtUp['level'])
            ->orderBy('order','desc')->first()->toArray();
        $newOrder = $qDtDown['order'];
        
        Link::where('order','<',$qDtUp['order'])->where('order','>=',$qDtDown['order'])->increment('order');
        Link::find($request->id)->update(['order'=>$newOrder]);
        $return = ['active' => $qDtUp['category']];
        return data(true,$return);
    }

    public function downOrder(Request $request)
    {
        $qDtDown = Link::find($request->id)->toArray();
        $qDtUp = Link::where('order','>',$qDtDown['order'])->where('level',$qDtDown['level'])
            ->orderBy('order','asc')->first()->toArray();
        $newOrder = $qDtUp['order']+$qDtUp['count_child'];
        
        Link::where('order','>',$qDtDown['order'])->where('order','<=',$newOrder)->decrement('order');
        Link::find($request->id)->update(['order'=>$newOrder]);
        $return = ['active' => $qDtDown['category']];
        return data(true,$return);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request,$id)
    {
        $loopParent = Link::find($id)->getAttribute('parent');
        while($loopParent > 0) {
            $q = Link::find($loopParent);
            $q->decrement('count_child');
            $loopParent = $q->parent;
        }
        Link::find($id)->delete();
        Link::where('order','>',$request->order)->decrement('order');
        $return = ['active' => $request->category];
        return data(true,$return);
    }
}
