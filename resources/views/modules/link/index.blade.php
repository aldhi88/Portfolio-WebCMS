@extends('components.layout.main',['title' => 'Link Navigasi'])
@section('css')
@include('modules.link.include.index_css')
@endsection
@section('js')
    @include('modules.link.include.index_js')
@endsection

@section('content')

<div class="row">
    <div class="col">
        @include('components.content.page_title',['title' => 'Link Navigasi'])

        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Manajemen Link Navigasi</h4>
                <p class="card-title-desc">Data link navigasi terkait dengan desain dari website anda.</p>

                <div class="row">
                    <div class="col-md-3">
                        <div class="col">
                            <div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
                                @foreach ($data['categories'] as $key=>$item)
                                <a class="nav-link mb-2 {{$key==0?'active':null}}" data-toggle="pill" href="#{{$item['key']}}">{{$item['label']}}</a>
                                @endforeach
                            </div>
                        </div>
                    </div>

                    <div class="col-md-9" id="link-form">

                        <div class="tab-content text-muted mt-4 mt-md-0" id="v-pills-tabContent">
                            @foreach ($data['categories'] as $key => $item)
                                <div class="tab-pane fade {{$key==0?'show active':null}}" id="{{$item['key']}}" role="tabpanel">
                                    <form id="formIn">@csrf
                                        <input type="hidden" name="category" value="{{$item['key']}}">
                                        <div class="row bg-light py-2">
                                            <div class="col">
                                                <div class="form-group mb-0">
                                                    <div class="row">
                                                        <div class="col">
                                                            <label>Label Link</label>
                                                            <input name="name" class="form-control form-control-sm" type="text" autofocus>
                                                        </div>
                                                        <div class="col">
                                                            <label>Parent ke Link</label>
                                                            <select name="parent" class="form-control form-control-sm">
                                                                <option value="0">Tidak Ada</option>
                                                                @foreach ($data['links'] as $itemLink)
                                                                    @if ($itemLink['category']==$item['key'])
                                                                    @php
                                                                        $separated=null;
                                                                        for ($i=1; $i < $itemLink['level']; $i++) { 
                                                                            $separated .= '_ ';
                                                                        }
                                                                    @endphp
                                                                    <option value="{{$itemLink['id']}}">{{$separated.$itemLink['name']}}</option>
                                                                    @endif
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                        <div class="col">
                                                            <label>Posisi Link</label>
                                                            <select name="order" class="form-control form-control-sm">
                                                                <option value="0">Paling Atas</option>
                                                                @foreach ($data['links'] as $itemLink)
                                                                    @if ($itemLink['category']==$item['key'])
                                                                    @php
                                                                        $separated=null;
                                                                        for ($i=1; $i < $itemLink['level']; $i++) { 
                                                                            $separated .= '_ ';
                                                                        }
                                                                    @endphp
                                                                    <option value="{{$itemLink['order']}}">{{$separated.$itemLink['name']}}</option>
                                                                    @endif
                                                                @endforeach
                                                                <option value="-1">Paling Bawah</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row bg-light py-2">
                                            <div class="col">
                                                <div class="form-group mb-0">
                                                    <div class="input-group">
                                                        <span class="input-group-btn input-group-prepend">
                                                            <button data-key="{{$item['key']}}" type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#modalPage">Halaman</button>
                                                        </span>
                                                        <input id="link_{{$item['key']}}" name="link" class="form-control form-control-sm" type="text" autofocus placeholder="https://">
                                                        <span class="input-group-btn input-group-append">
                                                            <button data-key="{{$item['key']}}" type="button" class="btn btn-secondary btn-sm" data-toggle="modal" data-target="#modalPost">Berita</button>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">
                                                <div class="form-group">
                                                    {{-- <label>&nbsp;</label> --}}
                                                    <button type="submit" class="btn btn-primary btn-block btn-sm">Tambahkan</button>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="row border py-3">
                                        <div class="col">
                                            @foreach ($data['links'] as $key => $itemLink)
                                                @if ($itemLink['category']==$item['key'])
                                                @php
                                                    $separated=null;
                                                    for ($i=1; $i < $itemLink['level']; $i++) { 
                                                        $separated .= '_ ';
                                                    }
                                                @endphp
                                                <div class="btn-group btn-block btn-group-sm py-0">
                                                    
                                                    <button type="button" class="btn btn-sm py-0 border w-75 text-left">
                                                        <input data-edit="name" data-id="{{$itemLink['id']}}" type="text" class="form-control px-0 pb-0 pt-1 border-0 link-edit" value="{{$separated.$itemLink['name']}}">
                                                        <input data-edit="link" data-id="{{$itemLink['id']}}" type="text" class="text-danger form-control form-control-sm px-0 pb-0 pt-1 border-0 link-edit" value="{{$itemLink['link']}}">
                                                    </button>
                                                    <button {{$itemLink['up']==0?'disabled':null}} type="button" class="btn btn-secondary btn-sm py-0 up" data-id="{{$itemLink['id']}}"><i class="ri-arrow-up-line"></i></button>
                                                    <button {{$itemLink['down']==0?'disabled':null}} data-id="{{$itemLink['id']}}" type="button" class="btn btn-secondary btn-sm py-0 down"><i class="ri-arrow-down-line"></i></button>
                                                    <button {{$itemLink['count_child']>0?'disabled':null}} data-order="{{$itemLink['order']}}" type="button" class="btn btn-danger btn-sm py-0 delete" data-category="{{$itemLink['category']}}" data-id="{{$itemLink['id']}}"><i class="ri-delete-bin-line"></i></button>
                                                </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>
@include('modules.link.modal_page')
@include('modules.link.modal_post')
@endsection