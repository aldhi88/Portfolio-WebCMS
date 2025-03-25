<div class="vertical-menu">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
                <li class="menu-title">Menu Utama</li>
    
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-dashboard-line"></i>
                        <span>Dashboard</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('dashboard.index')}}">Index</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-film-line"></i>
                        <span>Media</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('media.index')}}">Pustaka</a></li>
                        <li><a href="{{route('media.create')}}">Media Baru</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-article-line"></i>
                        <span>Berita</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('post-categories.index')}}">Kategori</a></li>
                        <li><a href="{{route('posts.index')}}">Data Berita</a></li>
                        <li><a href="{{route('posts.create')}}">Berita Baru</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-file-paper-2-line"></i>
                        <span>Halaman</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('pages.index')}}">Data Halaman</a></li>
                        <li><a href="{{route('pages.create')}}">Halaman Baru</a></li>
                    </ul>
                </li>

                <li>
                    <a href="{{route('links.index')}}" class=" waves-effect">
                        <i class="ri-menu-add-line"></i>
                        <span>Link Navigasi</span>
                    </a>
                </li>
                
                <li>
                    <a href="{{route('comments.index')}}" class=" waves-effect">
                        <i class="ri-chat-3-line"></i>
                        <span>Komentar</span>
                    </a>
                </li>


                <li class="menu-title">Menu Konten</li>

                <li>
                    <a href="{{route('attributes.index')}}" class=" waves-effect">
                        <i class="ri-list-check"></i>
                        <span>Atribute Web</span>
                    </a>
                </li>
                
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-slideshow-3-line"></i>
                        <span>Slideshow</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('slideshows.index')}}">Data Slideshow</a></li>
                        <li><a href="{{route('slideshows.create')}}">Slideshow Baru</a></li>
                    </ul>
                </li>
                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-links-line"></i>
                        <span>Link Spesial</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('widgets.index')}}">Data Link Spesial</a></li>
                        <li><a href="{{route('widgets.create')}}">Link Spesial Baru</a></li>
                    </ul>
                </li>

                <li class="menu-title">Menu Custom</li>

                <li>
                    <a href="{{route('leaders.index')}}" class=" waves-effect">
                        <i class="ri-user-2-line"></i>
                        <span>Pimpinan</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-team-line"></i>
                        <span>Asisten</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('teams.index')}}">Data Asisten</a></li>
                        <li><a href="{{route('teams.create')}}">Asisten Baru</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-gallery-line"></i>
                        <span>Album Photo</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('galleries.index')}}">Data Album</a></li>
                        <li><a href="{{route('galleries.create')}}">Album Baru</a></li>
                    </ul>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-shield-user-line"></i>
                        <span>DPO</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('dpos.index')}}">Data DPO</a></li>
                        <li><a href="{{route('dpos.create')}}">DPO Baru</a></li>
                    </ul>
                </li>

                <li>
                    <a href="{{route('contacts.index')}}" class=" waves-effect">
                        <i class="ri-message-2-line"></i>
                        <span>Pesan Masuk</span>
                    </a>
                </li>

                <li>
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-file-paper-2-line"></i>
                        <span>Produk Hukum</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                        <li><a href="{{route('produk-hukum.index')}}">Kategori</a></li>
                        <li><a href="{{route('produk-hukum-isi.index')}}">Isi Produk Hukum</a></li>
                    </ul>
                </li>



            </ul>

        </div>
        <!-- Sidebar -->
    </div>
</div>