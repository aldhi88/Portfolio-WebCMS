<div class="sidebar col-md-4">
    <aside>

        <!-- Start Sidebar Item -->
        {{-- <div class="sidebar-item search">
            <div class="title">
                <h4>Cari Berita</h4>
            </div>
            <div class="sidebar-info">
                <form>
                    <input type="text" class="form-control">
                    <input type="submit" value="Cari">
                </form>
            </div>
        </div> --}}
        <!-- End Sidebar Item -->

        <!-- Start Sidebar Item -->
        <div class="sidebar-item category">
            <div class="title">
                <h4>Kategori</h4>
            </div>
            <div class="sidebar-info">
                <ul>
                    @foreach ($data['kategori'] as $item)
                        <li><a href="{{ env('APP_URL') }}/berita/kategori/{{$item['id']}}/{{Str::slug($item['name'])}}">
                            {{$item['name']}} <span>{{$item['post_related_categories_count']}}</span></a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <!-- End Sidebar Item -->

        <!-- Start Sidebar Item -->
        <div class="sidebar-item recent-post">
            <div class="title">
                <h4>Berita Terbaru</h4>
            </div>
            
            @foreach ($data['newsUpdate'] as $item)
            <div class="item">
                <div class="content">
                    <div class="thumb">
                        <a href="{{env('APP_URL')}}/berita/{{$item['slug']}}">
                            <img src="{{asset($item['image'])}}" alt="Thumb">
                        </a>
                    </div>
                    <div class="info">
                        <h5>
                            <a href="{{env('APP_URL')}}/berita/{{$item['slug']}}">{{$item['title']}}</a>
                        </h5>
                        <div class="meta">
                            <i class="fas fa-user"></i><a href="#">{{$item['users']['first_name']}}</a> 
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            

        </div>
        <!-- End Sidebar Item -->

        <!-- Start Sidebar Item -->
        <div class="sidebar-item category">
            <div class="title">
                <h4>Arsip Berita</h4>
            </div>
            <div class="sidebar-info">
                <ul>
                    @foreach ($data['arsip'] as $key=>$item)
                    <li>
                        <a href="{{ env('APP_URL') }}/arsip-berita/{{ \Carbon\Carbon::parse($item[0]['created_at'])->format('Y-m') }}">
                            {{$key}} {{date('Y')}} <span>{{count($item)}}</span>
                        </a>
                    </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <!-- End Sidebar Item -->

        <!-- Start Sidebar Item -->
        <div class="sidebar-item gallery">
            <div class="title">
                <h4>Galeri Photo</h4>
            </div>
            <div class="sidebar-info">
                <ul>
                    @if (!is_null($data['album']))
                    @foreach ($data['album']['gallery_related_items'] as $key=>$item)
                        @if ($key<6)
                            <li>
                                <a href="{{ env('APP_URL') }}#portfolio">
                                    <img src="{{asset($item['path'])}}" alt="thumb">
                                </a>
                            </li>
                        @endif
                    @endforeach
                    @endif
                </ul>
            </div>
        </div>
        <!-- End Sidebar Item -->

    </aside>
</div>
