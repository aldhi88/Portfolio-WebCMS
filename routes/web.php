<?php

use App\Http\Controllers\AttributeController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DpoController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\LeaderController;
use App\Http\Controllers\LinkController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\PostCategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\ProdukHukumController;
use App\Http\Controllers\ProdukHukumIsiController;
use App\Http\Controllers\SlideshowController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\WebController;
use App\Http\Controllers\WidgetController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('login', function () {
    return redirect()->route('dashboard.index');
});

Route::get('/', function () {
    return redirect()->route('web.beranda');
});

Route::name('web.')->group(function () {
    //============ index
    Route::get('beranda', [WebController::class, 'index'])->name('beranda');
    Route::get('berita', [WebController::class, 'berita'])->name('berita');
    Route::get('berita/{slug}', [WebController::class, 'bacaBerita'])->name('bacaBerita');
    Route::get('berita/kategori/{id}/{name}', [WebController::class, 'kategoriBerita'])->name('kategoriBerita');
    Route::get('pencarian-berita', [WebController::class, 'pencarianBerita'])->name('pencarianBerita');
    Route::get('arsip-berita/{filter}', [WebController::class, 'arsipBerita'])->name('arsipBerita');
    Route::get('halaman/{slug}', [WebController::class, 'bacaHalaman'])->name('bacaHalaman');
    Route::get('hubungi', [WebController::class, 'hubungi'])->name('hubungi');
    Route::post('kirim-pesan', [WebController::class, 'kirimPesan'])->name('kirimPesan');
    Route::post('kirim-komentar', [WebController::class, 'kirimKomentar'])->name('kirimKomentar');
    Route::get('dpo', [WebController::class, 'dpo'])->name('dpo');
    Route::get('wbs', [WebController::class, 'wbs'])->name('wbs');
    Route::post('kirim-wbs', [WebController::class, 'kirimWbs'])->name('kirimWbs');
    Route::get('pengaduan', [WebController::class, 'pengaduan'])->name('pengaduan');
    Route::post('kirim-pengaduan', [WebController::class, 'kirimPengaduan'])->name('kirimPengaduan');
    Route::get('undang-undang', [WebController::class, 'undangUndang'])->name('undangUndang');
    Route::get('dtUndangUndang', [WebController::class, 'dtUndangUndang'])->name('dtUndangUndang');

});


// ==================================== CMS

Route::prefix('bo')->group(function(){


    Route::middleware('guest')->group(function(){
        // auth
        Route::name('auth.')->group(function () {
            Route::prefix('auth')->group(function(){
                Route::get('login', [AuthController::class,'loginForm'])->name('loginForm');
                Route::get('register', [AuthController::class,'registerForm'])->name('registerForm');
                Route::post('login', [AuthController::class,'login'])->name('login');
                Route::post('register', [AuthController::class,'register'])->name('register');
            });
        });
    });

    Route::middleware('auth:web')->group(function(){

        Route::name('auth.')->group(function () {
            Route::prefix('auth')->group(function(){
                Route::get('logout', [AuthController::class, 'logout'])->name('logout');
            });
        });

        //============ dashboard
        Route::name('dashboard.')->group(function () {
            Route::prefix('dashboard')->group(function(){
                Route::get('index', [DashboardController::class, 'index'])->name('index');
            });
        });
        
        //============ media
        Route::name('media.')->group(function () {
            Route::prefix('media')->group(function(){
                Route::get('dtIndex', [MediaController::class, 'dtIndex'])->name('dtIndex');
                Route::get('getData', [MediaController::class, 'getData'])->name('getData');
            });
        });
        Route::resource('media', MediaController::class)->except(['show']);

        //============ post-categories
        Route::name('post-categories.')->group(function () {
            Route::prefix('post-categories')->group(function(){
                Route::get('dtIndex', [PostCategoryController::class, 'dtIndex'])->name('dtIndex');
                Route::get('getData', [PostCategoryController::class, 'getData'])->name('getData');
                Route::put('upDefault/{id}', [PostCategoryController::class, 'upDefault'])->name('upDefault');
            });
        });
        Route::resource('post-categories', PostCategoryController::class)->except(['create','show']);

        //============ posts
        Route::name('posts.')->group(function () {
            Route::prefix('posts')->group(function(){
                Route::get('dtIndex', [PostController::class, 'dtIndex'])->name('dtIndex');
                Route::get('getData', [PostController::class, 'getData'])->name('getData');
                Route::get('getMedia', [PostController::class, 'getMedia'])->name('getMedia');
                Route::get('dtMedia', [PostController::class, 'dtMedia'])->name('dtMedia');
                Route::get('getMediaImage', [PostController::class, 'getMediaImage'])->name('getMediaImage');
                Route::get('dtMediaImage', [PostController::class, 'dtMediaImage'])->name('dtMediaImage');
            });
        });
        Route::resource('posts', PostController::class)->except(['show']);

        //============ pages
        Route::name('pages.')->group(function () {
            Route::prefix('pages')->group(function(){
                Route::get('dtIndex', [PageController::class, 'dtIndex'])->name('dtIndex');
                Route::get('getData', [PageController::class, 'getData'])->name('getData');
                Route::get('getMedia', [PageController::class, 'getMedia'])->name('getMedia');
                Route::get('dtMedia', [PageController::class, 'dtMedia'])->name('dtMedia');
                Route::get('getMediaImage', [PageController::class, 'getMediaImage'])->name('getMediaImage');
                Route::get('dtMediaImage', [PageController::class, 'dtMediaImage'])->name('dtMediaImage');
                Route::get('getOrder', [PageController::class, 'getOrder'])->name('getOrder');
            });
        });
        Route::resource('pages', PageController::class)->except(['show']);

        //============ links
        Route::name('links.')->group(function () {
            Route::prefix('links')->group(function(){
                Route::get('getPage', [LinkController::class, 'getPage'])->name('getPage');
                Route::get('dtGetPage', [LinkController::class, 'dtGetPage'])->name('dtGetPage');
                Route::get('getPost', [LinkController::class, 'getPost'])->name('getPost');
                Route::get('dtGetPost', [LinkController::class, 'dtGetPost'])->name('dtGetPost');
                Route::get('getLinkForm', [LinkController::class, 'getLinkForm'])->name('getLinkForm');
                Route::post('upOrder', [LinkController::class, 'upOrder'])->name('upOrder');
                Route::post('downOrder', [LinkController::class, 'downOrder'])->name('downOrder');
            });
        });
        Route::resource('links', LinkController::class)->except(['create','show','edit']);

        //============ attributes
        Route::name('attributes.')->group(function () {
            Route::prefix('attributes')->group(function(){
            });
        });
        Route::resource('attributes', AttributeController::class)->except(['create']);

        //============ slideshows
        Route::name('slideshows.')->group(function () {
            Route::prefix('slideshows')->group(function(){
                Route::get('dtIndex', [SlideshowController::class, 'dtIndex'])->name('dtIndex');
            });
        });
        Route::resource('slideshows', SlideshowController::class)->except(['show','store','update','destroy']);

        //============ widgets
        Route::name('widgets.')->group(function () {
            Route::prefix('widgets')->group(function(){
                Route::get('dtIndex', [WidgetController::class, 'dtIndex'])->name('dtIndex');
            });
        });
        Route::resource('widgets', WidgetController::class)->except(['show','store','update','destroy']);

        //============ teams
        Route::name('teams.')->group(function () {
            Route::prefix('teams')->group(function(){
                Route::get('dtIndex', [TeamController::class, 'dtIndex'])->name('dtIndex');
            });
        });
        Route::resource('teams', TeamController::class)->except(['show','store','update','destroy']);
        
        //============ leaders
        Route::name('leaders.')->group(function () {
            Route::prefix('leaders')->group(function(){

            });
        });
        Route::resource('leaders', LeaderController::class)->except(['show','store','update','destroy','create','edit']);

        //============ galleries
        Route::name('galleries.')->group(function () {
            Route::prefix('galleries')->group(function(){
                Route::get('dtIndex', [GalleryController::class, 'dtIndex'])->name('dtIndex');
                Route::get('getData', [GalleryController::class, 'getData'])->name('getData');
                Route::get('dtEdit', [GalleryController::class, 'dtEdit'])->name('dtEdit');
                Route::put('upAlbumName/{id}', [GalleryController::class, 'upAlbumName'])->name('upAlbumName');
                Route::delete('delItem/{itemId}', [GalleryController::class, 'delItem'])->name('delItem');
            });
        });
        Route::resource('galleries', GalleryController::class)->except([]);

         //============ contacts
        Route::name('contacts.')->group(function () {
            Route::prefix('contacts')->group(function(){
                Route::get('dtIndex', [ContactController::class, 'dtIndex'])->name('dtIndex');
                Route::get('getData', [ContactController::class, 'getData'])->name('getData');
            });
        });
        Route::resource('contacts', ContactController::class)->except(['destroy','create','store']);

        //============ comments
        Route::name('comments.')->group(function () {
            Route::prefix('comments')->group(function(){
                Route::get('dtIndex', [CommentController::class, 'dtIndex'])->name('dtIndex');
                Route::get('getData', [CommentController::class, 'getData'])->name('getData');
            });
        });
        Route::resource('comments', CommentController::class)->except(['destroy','create','store','edit','show']);
        
        //============ dpos
        Route::name('dpos.')->group(function () {
            Route::prefix('dpos')->group(function(){
                Route::get('dtIndex', [DpoController::class, 'dtIndex'])->name('dtIndex');
            });
        });
        Route::resource('dpos', DpoController::class)->except(['show','update','destroy']);

        //============ produk-hukum
        Route::name('produk-hukum.')->group(function () {
            Route::prefix('produk-hukum')->group(function(){
                Route::get('dtIndex', [ProdukHukumController::class, 'dtIndex'])->name('dtIndex');
                Route::get('getData', [ProdukHukumController::class, 'getData'])->name('getData');
            });
        });
        Route::resource('produk-hukum', ProdukHukumController::class)->except(['create','show']);
        
        //============ produk-hukum-isi
        Route::name('produk-hukum-isi.')->group(function () {
            Route::prefix('produk-hukum-isi')->group(function(){
                Route::get('dtIndex', [ProdukHukumIsiController::class, 'dtIndex'])->name('dtIndex');
                Route::get('getData', [ProdukHukumIsiController::class, 'getData'])->name('getData');
                Route::get('create/{id}', [ProdukHukumIsiController::class, 'create'])->name('create');
            });
        });
        Route::resource('produk-hukum-isi', ProdukHukumIsiController::class)->except(['show','create']);
        
    });

});



