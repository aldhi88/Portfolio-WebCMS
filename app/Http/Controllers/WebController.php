<?php

namespace App\Http\Controllers;

use App\Http\Requests\KirimPengaduanReq;
use App\Http\Requests\kirimPesanReq;
use App\Http\Requests\KirimWbsReq;
use App\Mail\PengaduanMail;
use App\Mail\WbsMail;
use App\Models\Attribute;
use App\Models\Comment;
use App\Models\Contact;
use App\Models\Gallery;
use App\Models\Page;
use App\Models\Post;
use App\Models\PostCategory;
use App\Models\ProdukHukum;
use App\Models\ProdukHukumIsi;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use DataTables;
use Illuminate\Database\Eloquent\Builder;

class WebController extends Controller
{
    public function index()
    {
        // mainSlider =============================================================================
        $data['mainSlider'] = Page::where('category','main_slider')->get()->toArray();

        // spesialLink =============================================================================
        $data['spesialLink'] = Page::where('category','special_link')->orderBy('order','asc')->get()->toArray();

        // ketua =============================================================================
        $q = Page::where('category','leader')->get();
        if(count($q)==0){
            $data['ketua'] = null;
        }else{
            $data['ketua'] = $q->first()->toArray();
        }

        // teams =============================================================================
        $data['teams'] = Page::where('category','team')->orderBy('order','asc')->get()->toArray();

        // news =============================================================================
        $data['newsUpdate'] = Post::query()
            ->with([
                'users:id,first_name',
                'post_related_categories:post_id,post_category_id',
                'post_related_categories.post_categories:id,name',
            ])
            ->orderBy('created_at','desc')
            ->where('is_publish',1)
            ->limit(3)->get()->toArray();

        // news favorit =============================================================================
        $data['newsFavorite'] = Post::query()
            ->with([
                'users:id,first_name',
                'post_related_categories:post_id,post_category_id',
                'post_related_categories.post_categories:id,name',
            ])
            ->orderBy('count_visitor','desc')
            ->where('is_publish',1)
            ->limit(4)->get()->toArray();
        // video =============================================================================
        $data['video'] = Attribute::where('key','video')->first()->getAttribute('value');
        
        // dpos =============================================================================
        $data['dpos'] = Page::where('category','dpo')
            ->orderBy('order','asc')
            ->orderBy('created_at','desc')
            ->get()->toArray();

        // album =============================================================================
        $q = Gallery::select('*')->orderBy('created_at','desc')
            ->with([
                'gallery_related_items'
            ])
            ->get();
        ;

        


        if(count($q)==0){
            $data['album'] = null;
        }else{
            $data['album'] = $q->first()->toArray();
        }
        

        return view('web.mod.beranda',compact('data'));
    }

    public function berita()
    {
        // kategori =============================================================================
        $data['kategori'] = PostCategory::query()
            ->withCount('post_related_categories')
            ->get()->toArray();
        ;

        // news =============================================================================
        $data['news'] = Post::query()
            ->with([
                'users:id,first_name',
                'post_related_categories:post_id,post_category_id',
                'post_related_categories.post_categories:id,name',
                'comments' => function($q){
                    $q->where('approve',1)->orderBy('created_at','asc');
                },
            ])
            ->where('is_publish',1)
            ->orderBy('created_at','desc')
            ->paginate(5);
        // news sidebar =============================================================================
        $data['newsUpdate'] = Post::query()
            ->with([
                'users:id,first_name',
                'post_related_categories:post_id,post_category_id',
                'post_related_categories.post_categories:id,name',
            ])
            ->orderBy('created_at','desc')
            ->where('is_publish',1)
            ->limit(3)->get()->toArray();
        // arsip berita=========================================================
        $data['arsip'] = Post::whereYear('created_at','=',date('Y'))
            ->get()->groupBy(function($d) {
                return Carbon::parse($d->created_at)->translatedFormat('F');
            })
            ->toArray();
        ;


        // dd($data['arsip']);

        // galeri====================================
        $q = Gallery::select('*')->orderBy('created_at','desc')
            ->with([
                'gallery_related_items'
            ])
            ->limit(1)->get();
        ;

        if(count($q)==0){
            $data['album'] = null;
        }else{
            $data['album'] = $q->first()->toArray();
        }

        return view('web.mod.berita_list',compact('data'));
    }

    public function bacaBerita(Request $request, $slug)
    {
        Post::where('slug',$slug)->increment('count_visitor');
        $data['news'] = Post::where('slug',$slug)
            ->with([
                'users:id,first_name',
                'post_related_categories:post_id,post_category_id',
                'post_related_categories.post_categories:id,name',
                'comments' => function($q){
                    $q->where('approve',1)->orderBy('created_at','asc');
                },
            ])
            ->where('is_publish',1)
            ->first()->toArray();
        $data['next'] = null;
        $data['prev'] = null;
        $q = Post::select('slug')->where('is_publish',1)
            ->where('id','>',$data['news']['id'])
            ->orderBy('created_at','asc')
            ->get();
        if(count($q)!=0){
            $data['next'] = $q[0]->slug;
        }
        $q = Post::select('slug')->where('is_publish',1)
            ->where('id','<',$data['news']['id'])
            ->orderBy('created_at','desc')
            ->get();
            if(count($q)!=0){
            $data['prev'] = $q[0]->slug;
        }
        // kategori =============================================================================
        $data['kategori'] = PostCategory::query()
            ->withCount('post_related_categories')
            ->get()->toArray();
        ;

        // news =============================================================================
        $data['newsUpdate'] = Post::query()
            ->with([
                'users:id,first_name',
                'post_related_categories:post_id,post_category_id',
                'post_related_categories.post_categories:id,name',
            ])
            ->orderBy('created_at','desc')
            ->where('is_publish',1)
            ->limit(3)->get()->toArray();

        // arsip berita=========================================================
        $data['arsip'] = Post::whereYear('created_at','=',date('Y'))
            ->get()->groupBy(function($d) {
                return Carbon::parse($d->created_at)->translatedFormat('F');
            })
            ->toArray();
        ;

        // galeri====================================
        $q = Gallery::select('*')->orderBy('created_at','desc')
            ->with([
                'gallery_related_items'
            ])
            ->limit(1)->get();
        ;

        if(count($q)==0){
            $data['album'] = null;
        }else{
            $data['album'] = $q->first()->toArray();
        }
        return view('web.mod.berita',compact('data'));
    }

    public function pencarianBerita(Request $request)
    {
        $data['news']=Post::where('title','like','%'.$request->keyword.'%')
            ->with([
                'users:id,first_name',
                'post_related_categories:post_id,post_category_id',
                'post_related_categories.post_categories:id,name',
                'comments' => function($q){
                    $q->where('approve',1)->orderBy('created_at','asc');
                },
            ])
            ->where('is_publish',1)
            ->orderBy('created_at','desc')
            ->paginate(5);
        // news sidebar =============================================================================
        $data['newsUpdate'] = Post::query()
            ->with([
                'users:id,first_name',
                'post_related_categories:post_id,post_category_id',
                'post_related_categories.post_categories:id,name',
            ])
            ->orderBy('created_at','desc')
            ->where('is_publish',1)
            ->limit(3)->get()->toArray();
        $data['keyword'] = $request->keyword;
        // kategori =============================================================================
        $data['kategori'] = PostCategory::query()
            ->withCount('post_related_categories')
            ->get()->toArray();
        ;
        // arsip berita=========================================================
        $data['arsip'] = Post::whereYear('created_at','=',date('Y'))->get()->groupBy(function($d) {
            return Carbon::parse($d->created_at)->translatedFormat('F');
        });

        // galeri====================================
        $q = Gallery::select('*')->orderBy('created_at','desc')
            ->with([
                'gallery_related_items'
            ])
            ->limit(1)->get();
        ;

        if(count($q)==0){
            $data['album'] = null;
        }else{
            $data['album'] = $q->first()->toArray();
        }
        return view('web.mod.berita_search',compact('data'));
    }

    public function arsipBerita($filter)
    {
        $date = $filter.'-01';
        $my_date = date('m/d/y', strtotime($date));
        $data['keyword'] = Carbon::parse($my_date)->translatedFormat('F Y');
        $data['news']=Post::query()
            ->where('created_at','like','%'.$filter.'%')
            ->with([
                'users:id,first_name',
                'post_related_categories:post_id,post_category_id',
                'post_related_categories.post_categories:id,name',
                'comments' => function($q){
                    $q->where('approve',1)->orderBy('created_at','asc');
                },
            ])
            ->where('is_publish',1)
            ->orderBy('created_at','desc')
            ->paginate(5);
        // news sidebar =============================================================================
        $data['newsUpdate'] = Post::query()
            ->with([
                'users:id,first_name',
                'post_related_categories:post_id,post_category_id',
                'post_related_categories.post_categories:id,name',
            ])
            ->orderBy('created_at','desc')
            ->where('is_publish',1)
            ->limit(3)->get()->toArray();
        // kategori =============================================================================
        $data['kategori'] = PostCategory::query()
            ->withCount('post_related_categories')
            ->get()->toArray();
        ;
        // arsip berita=========================================================
        $data['arsip'] = Post::whereYear('created_at','=',date('Y'))->get()->groupBy(function($d) {
            return Carbon::parse($d->created_at)->translatedFormat('F');
        });

        // galeri====================================
        $q = Gallery::select('*')->orderBy('created_at','desc')
            ->with([
                'gallery_related_items'
            ])
            ->limit(1)->get();
        ;

        if(count($q)==0){
            $data['album'] = null;
        }else{
            $data['album'] = $q->first()->toArray();
        }
        return view('web.mod.berita_arsip',compact('data'));
    }

    public function kategoriBerita($id,$name)
    {
        $data['keyword'] = PostCategory::where('id',$id)->first()->getAttribute('name');
        
        $data['news']=Post::query()
            ->whereHas('post_related_categories',function(Builder $query) use($id){
                $query->where('post_category_id',$id);
            })
            ->with([
                'users:id,first_name',
                'post_related_categories:post_id,post_category_id',
                'post_related_categories.post_categories:id,name',
                'comments' => function($q){
                    $q->where('approve',1)->orderBy('created_at','asc');
                },
            ])
            ->where('is_publish',1)
            ->orderBy('created_at','desc')
            ->paginate(5);
        // news sidebar =============================================================================
        $data['newsUpdate'] = Post::query()
            ->with([
                'users:id,first_name',
                'post_related_categories:post_id,post_category_id',
                'post_related_categories.post_categories:id,name',
            ])
            ->orderBy('created_at','desc')
            ->where('is_publish',1)
            ->limit(3)->get()->toArray();
        // kategori =============================================================================
        $data['kategori'] = PostCategory::query()
            ->withCount('post_related_categories')
            ->get()->toArray();
        ;
        // arsip berita=========================================================
        $data['arsip'] = Post::whereYear('created_at','=',date('Y'))->get()->groupBy(function($d) {
            return Carbon::parse($d->created_at)->translatedFormat('F');
        });

        // galeri====================================
        $q = Gallery::select('*')->orderBy('created_at','desc')
            ->with([
                'gallery_related_items'
            ])
            ->limit(1)->get();
        ;

        if(count($q)==0){
            $data['album'] = null;
        }else{
            $data['album'] = $q->first()->toArray();
        }
        return view('web.mod.berita_kategori',compact('data'));
    }

    public function bacaHalaman(Request $request, $slug)
    {
        $data['page'] = Page::where('slug',$slug)
            ->with([
                'users:id,first_name',
            ])
            ->first()->toArray();
        return view('web.mod.halaman',compact('data'));
    }

    public function hubungi()
    {
        return view('web.mod.hubungi');
    }

    public function kirimPesan(kirimPesanReq $request)
    {
        if(!is_null($_POST['g-recaptcha-response'])){
            $data = $request->except('_token','g-recaptcha-response');
    
            Contact::create($data);
            return response()->json([
                'status' => true,
                'data' => [
                    'alert' => 'success',
                    'msg' => 'Berhasil, data pesan anda sudah terkirim.',
                ],
            ]);
        }
    }

    public function kirimKomentar(Request $request)
    {
        if(!is_null($_POST['g-recaptcha-response'])){
            $data = $request->except('_token','g-recaptcha-response');
            Comment::create($data);
            return response()->json([
                'status' => true,
                'data' => [
                    'alert' => 'success',
                    'msg' => 'Berhasil, komentar anda sudah terkirim, akan tampil setelah disetujui admin.',
                ],
            ]);
        }
    }

    public function dpo()
    {
        $data['dpos'] = Page::where('category','dpo')
            ->orderBy('order','asc')
            ->orderBy('created_at','desc')
            ->get()->toArray();
        return view('web.mod.dpo',compact('data'));
    }

    public function wbs()
    {
        return view('web.mod.wbs');
    }

    public function kirimWbs(KirimWbsReq $request)
    {
        
        if(!is_null($_POST['g-recaptcha-response'])){
            $data = $request->except('_token','g-recaptcha-response');

            $dir = 'public/wbs_ktp/'.date('Ym');
            Storage::makeDirectory($dir);
            $extension = $request->file('ktp')->extension();
            $oriName = $request->file('ktp')->getClientOriginalName();
            $filename = pathinfo($oriName, PATHINFO_FILENAME);
            $filename = md5($filename.date('His')).'.'.$extension;
            $request->file('ktp')->storeAs($dir, $filename);
            $data['path'] = public_path('storage/wbs_ktp/'.date('Ym').'/'.$filename);

            Mail::to(Attribute::getAttr('mail1'))->send(new WbsMail($data));

            return response()->json([
                'status' => true,
                'data' => [
                    'alert' => 'success',
                    'msg' => 'Berhasil, laporan anda sudah kami terima.',
                ],
            ]);
        }
    }

    public function pengaduan()
    {
        return view('web.mod.pengaduan');
    }

    public function kirimPengaduan(KirimPengaduanReq $request)
    {
        
        if(!is_null($_POST['g-recaptcha-response'])){
            $data = $request->except('_token','g-recaptcha-response');

            $dir = 'public/pengaduan_ktp_bukti/'.date('Ym');
            Storage::makeDirectory($dir);

            $extension = $request->file('ktp')->extension();
            $oriName = $request->file('ktp')->getClientOriginalName();
            $filename = pathinfo($oriName, PATHINFO_FILENAME);
            $filename = md5($filename.date('His')).'.'.$extension;
            $request->file('ktp')->storeAs($dir, $filename);
            $data['path'][] = public_path('storage/pengaduan_ktp_bukti/'.date('Ym').'/'.$filename);

            

            $extension = $request->file('bukti')->extension();
            $oriName = $request->file('bukti')->getClientOriginalName();
            $filename = pathinfo($oriName, PATHINFO_FILENAME);
            $filename = md5($filename.date('His')).'.'.$extension;
            $request->file('bukti')->storeAs($dir, $filename);
            $data['path'][] = public_path('storage/pengaduan_ktp_bukti/'.date('Ym').'/'.$filename);

            Mail::to(Attribute::getAttr('mail2'))->send(new PengaduanMail($data));

            return response()->json([
                'status' => true,
                'data' => [
                    'alert' => 'success',
                    'msg' => 'Berhasil, laporan anda sudah kami terima.',
                ],
            ]);
        }
    }
    
    public function undangUndang()
    {
        $data['produkHukum'] = ProdukHukum::select('id','name')
            ->withCount('produk_hukum_isi as isi_count')
            ->get()->toArray()
        ;
        $data['isi'] = ProdukHukumIsi::all()->count();
        return view('web.mod.undang', compact('data'));
    }

    public function dtUndangUndang(Request $request)
    {
        $data = ProdukHukumIsi::query()
            ->with([
                'produk_hukum:id,name'
            ])
        ;
        if($request->filter != 0){
            $data->where('produk_hukum_id',$request->filter);
        }
        return DataTables::of($data)
            ->addIndexColumn()
            ->toJson();
    }

}
