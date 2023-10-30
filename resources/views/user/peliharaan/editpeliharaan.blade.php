@extends('layouts.web')
@section('title','Ubah Informasi Peliharaan - ')
@section('content')
@include('mceImageUpload::upload_form')
@section('js')

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.7.9/jquery.tinymce.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.7.9/tinymce.min.js"></script>

<script type="text/javascript">
    tinymce.init({
        selector: '#editor',
        menubar: false,
        autoresize_overflow_padding: 50,
        theme_advanced_resizing: true,
        width: '100%',
        height: 300,
        autoresize_min_height: 300,
        autoresize_max_height: 600,

        plugins: [
            'advlist autolink link lists charmap preview hr anchor pagebreak',
            'searchreplace wordcount visualblocks visualchars fullscreen insertdatetime nonbreaking',
            'save table contextmenu paste textcolor image imagetools autoresize'
        ],
        toolbar: 'styleselect bold italic | alignleft aligncenter | bullist link image',
        relative_urls: false,
        file_browser_callback: function(field_name, url, type, win) {
            // trigger file upload form
            if (type == 'image') $('#formUpload input').click();
        }
    });
    $(window).resize(function() {
        setTimeout(function() {
            $j('.mceEditor').css('width', '100%').css('minHeight', '240px');
            $j('.mceLayout').css('width', '100%').css('minHeight', '240px');
            $j('.mceIframeContainer').css('width', '100%').css('minHeight', '240px');
            $j('#' + ['editor'] + '_ifr').css('width', '100%').css('minHeight', '240px');
        }, 500)
    });

</script>




@endsection


<!-- Sub Page Content
			============================================= -->
<div id="sub-page-content" class="clearfix">

    <div class="container">

        <div class="row">
            <div class="col-md-4">

                <!-- Categories Widget
							============================================= -->
                <div class="sidebar-widget clearfix ">
                    <div class="card-user-profile-container ">
                        <div class="card-user-profile-inner dropshadow">
                            <center>
                                <div class="card-user-profile-photo">
                                    <img src="{{ asset($ep->petphoto) }}" class="img-responsive img-circle marbot" style="width: 70% !important; height: 70% !important; ">
                                </div>
                                <div class="card-user-profile name">
                                    <b>{{$ep->petname}}
                                        @if($ep->petsex == 1)
                                        <img src="{{ url('icon/male.png') }}" width="24" height="24">
                                        @else
                                        <img src="{{ url('icon/female.png') }}" width="24" height="24">
                                        @endif</b>
                                </div>
                                <label class="label label-primary">Pet Code : {{$ep->petcode}}</label>
                                <br>
                                <br>

                                <div class="title">Warna Hewan</div>
                                <div class="card-user-profile warna">{{$ep->petcolor}}</div>
                                <div class="title">Jenis Hewan</div>
                                <div class="card-user-profile tipe">@if($ep->pettype == 1)
                                    Mamalia
                                    @elseif($ep->pettype == 2)
                                    Reptil
                                    @elseif($ep->pettype == 3)
                                    Unggas
                                    @elseif($ep->pettype == 4)
                                    Amfibi
                                    @else
                                    Tidak terklasifikasi
                                    @endif
                                </div>
                                <div class="title">Status</div>
                                <div class="card-user-profile vaksin">@if($ep->petvaksin == 1)
                                    @else
                                    Belum / Tidak Vaksin
                                    @endif
                                    Sudah Vaksin
                                </div>
                                <div class="title">Ciri Hewan</div>
                                <div class="card-user-profile ciri">{{$ep->petciri}}</div>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
            <div id="target" class="col-md-8 blog-wrapper clearfix">

                <ul class="nav nav-tabs">
                    <li><a href="{{ url('dashboard/peliharaan#target')}}">Peliharaan Saya</a></li>
                    <li class="active"><a href="{{ url('#')}}">Ubah Info Peliharaan</a></li>
                </ul>

                

                <h3 class="light blog-wrapper text-center"><span>Ubah Informasi Peliharaan</span></h3>
                <div class="height20"></div>


                <div class="dropshadow well">
                    <form class="form-horizontal" method="post" action="{{ url('dashboard/peliharaan/update') }}" enctype="multipart/form-data">
                        {{ csrf_field() }}

                        <fieldset>

                            <input type="hidden" name="petcode" value="{{$ep->petcode}}">
                            <div class="row">
                                <!-- Text input-->
                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="textinput">Nama Hewan Peliharaan</label>
                                    <div class="col-md-10 col-sm-12">
                                        <input name="petname" value="{{$ep->petname}}" class="form-control" type="text">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="textinput">Jenis Hewan</label>
                                    <div class="col-md-10 col-sm-12">
                                        <select id="pettype" name="pettype" class="form-control">

                                            <option value="{{$ep->pettype}}" selected>@if($ep->pettype == 1)
                                                --> Mamalia
                                                @elseif($ep->pettype == 2)
                                                --> Reptil
                                                @elseif($ep->pettype == 3)
                                                --> Unggas
                                                @elseif($ep->pettype == 4)
                                                --> Amfibi
                                                @else
                                                --> Lain lain
                                                @endif</option>

                                            <option value="1">Mamalia</option>
                                            <option value="2">Reptil</option>
                                            <option value="3">Unggas</option>
                                            <option value="4">Amfibi</option>
                                            <option value="5">Lain Lain</option>
                                        </select>
                                    </div>
                                    <label class="col-md-2 control-label">Jenis Hewan</label>
                                    <div class="col-md-10 col-sm-12">
                                        <select id="petdetail" name="petdetail" class="form-control">
                                            <option value="">-- Pilih Jenis -- </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Breed Hewan</label>
                                    <div class="col-md-10 col-sm-12">
                                        <input id="petbreed" name="petbreed" value="{{$ep->petbreed}}" class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Tanggal Lahir Hewan</label>
                                    <div class="col-md-10 col-sm-12">
                                        <input id="tanggallahir" name="petage" value="{{$ep->petage}}" class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Kode Orang Tua Peliharaan</label>
                                    <div class="col-md-10 col-sm-12">
                                        <input id="petparent" name="petparent" value="{{$ep->petparent}}" class="form-control" type="text">
                                        <small>Kode orang tua hewan jika orang tua hewan pernah di daftarkan di Hallovet</small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="textinput">Warna Hewan</label>
                                    <div class="col-md-10 col-sm-12">
                                        <input id="textinput" name="petcolor" value="{{$ep->petcolor}}" class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Berat Hewan (dalam Kg)</label>
                                    <div class="col-md-10 col-sm-12">
                                        <input id="petweight" name="petweight" value="{{$ep->petweight}}" class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="textinput">Jenis Kelamin Hewan</label>
                                    <div class="col-md-10 col-sm-12">
                                        <select id="petsex" name="petsex" class="form-control">

                                            <option value="{{$ep->petsex}}" selected>
                                                @if($ep->petsex == 1)
                                                --> Jantan
                                                @else
                                                --> Betina
                                                @endif</option>
                                            <option value="1">Jantan</option>
                                            <option value="2">Betina</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="textinput">Status Vaksin</label>
                                    <div class="col-md-10 col-sm-12">
                                        <select id="selectbasic" name="petvaksin" class="form-control">
                                            <option value="{{$ep->petvaksin}}" selected>
                                                @if($ep->petvaksin == 1)
                                                --> Belum / Tidak Vaksin
                                                @else
                                                --> Sudah Vaksin
                                                @endif
                                            </option>
                                            <option value="1">Belum Vaksin</option>
                                            <option value="2">Sudah Vaksin</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label" for="textinput">Ciri Hewan Peliharaan</label>
                                    <div class="col-md-10 col-sm-12 ">
                                        <textarea name="petciri">{{$ep->petciri}}</textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="profile">Gambar Thumbnail </label>
                                    <div class="col-md-10">
                                        <img src="{{ asset($ep->petphoto) }}" id="blah" width="150" height="150" class="img-circle img-responsive" />

                                        <input type="file" id="inputprofilepic" name="petphoto" class="validate">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-4 col-md-offset-4">
                                        <button id="singlebutton" name="submit" class="btn btn-lg btn-primary">Ubah</button>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>






            </div>




        </div>

    </div>



</div>
<!--end sub-page-content-->


@endsection
