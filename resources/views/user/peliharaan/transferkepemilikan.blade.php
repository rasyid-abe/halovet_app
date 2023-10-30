@extends('layouts.web')
@section('title','Daftarkan Hewan Peliharaan - ')
@section('content')
@include('mceImageUpload::upload_form')
@section('js')

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.7.9/jquery.tinymce.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.7.9/tinymce.min.js"></script>


<link rel="stylesheet" type="text/css" href="{{asset('css/bootstrap-datepicker.min.css')}}">
<script type="text/javascript" src="{{asset('bootstrap-datepicker.min.js')}}"></script>
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
                                    <img src="{{asset(Auth::user()->profilepic)}}" class="img-responsive img-circle marbot" style="width: 70% !important; height: 70% !important; ">
                                </div>
                                <div class="card-user-profile name">
                                    <b>{{Auth::user()->name}}</b>
                                </div>
                                @if(Auth::user()->role == 2)
                                @if(Auth::user()->verifadmin == 0)
                                <label style="font-weight: normal; font-size: 80%;" class="label label-warning">Unverified</label>
                                <div class="alert alert-dismissible alert-warning">
                                    <button type="button" class="close pull-right" style="min-width: 10px;" data-dismiss="alert">&times;</button>
                                    <h4 class="text-center">Peringatan</h4>
                                    <p>Anda belum terverifikasi. Mohon lengkapi persyaratan agar akun anda dapat diverifikasi. Silahkan klik <a href="{{ url('setting/dokter') }}" class="alert-link">di sini</a> untuk melengkapi persyaratan. Banyak benefit yang anda dapatkan jika sudah terverifikasi. Silahkan baca keuntungan menjadi verified doctor lebih lanjut <a href="{{ url('page/keuntungan-menjadi-verified-account') }}" class="alert-link">di sini</a>.</p>
                                </div>
                                @else
                                <label class="label label-success">Verified</label>
                                @endif
                                <br>
                                @endif

                                <div class="title">Bio</div>
                                <div class="card-user-profile biography">{{Auth::user()->bio}}</div>
                                <div class="title">Email</div>
                                <div class="card-user-profile email">{{Auth::user()->email}}</div>
                                <div class="title">No. HP</div>
                                <div class="card-user-profile nohp">{{Auth::user()->nohp}}</div>
                                <div class="title">Alamat</div>
                                <div class="card-user-profile alamat">{{Auth::user()->alamat}}</div>
                                
                                <div class="col-md-12" data-aos="fade-up" data-aos-duration="1500">
                                    <a href="{{ url('setting#target') }}" target="_blank" class="btn btn-lg btn-primary rounded-border" style="text-transform:none;">Ubah Profil</a>
                                    <div class="height20"></div>
                                    @if(Auth::user()->role == 2)
                                     @if(Auth::user()->verifadmin == 1)
                                    <a href="{{ url('/taglokasi') }}" target="_blank" class="btn btn-lg btn-warning rounded-border" style="text-transform:none;">Input Lokasi Klinik</a>
                                    @endif
                                    @endif
                                </div>
                            </center>
                        </div>
                    </div>
                </div>
            </div>
            <div id="target" class="col-md-8 clearfix">
                <ul class="nav nav-tabs">
                    <li><a href="{{ url('dashboard/peliharaan#target')}}">Peliharaan Saya</a></li>
                    <li class="active"><a href="{{ url('#')}}">Tambah Peliharaan</a></li>
                </ul>
                <div class="height20"></div>

                <h2 class="blog-wtapper text-center light"><span>Daftarkan Hewan Peliharaan</span></h2>
                <div class="height20"></div>

                <div class="dropshadow well">
                    <form class="form-horizontal" method="post" action="{{ url('dashboard/peliharaan/new/save') }}" enctype="multipart/form-data" style="max-width: none;">
                        {{ csrf_field() }}
                        <fieldset>

                            <div class="row">
                                <!-- Text input-->
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Nama Hewan Peliharaan</label>
                                    <div class="col-md-10 col-sm-12">
                                        <input id="petname" name="petname" placeholder="Nama Hewan" class="form-control" type="text">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label">Kelas Hewan</label>
                                    <div class="col-md-10 col-sm-12">
                                        <select id="pettype" name="pettype" class="form-control">
                                        <option value="0">-- Pilih Kelas --</option>
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
                                        <input id="petbreed" name="petbreed" placeholder="Warna Dominan Hewan" class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Tanggal Lahir Hewan</label>
                                    <div class="col-md-10 col-sm-12">
                                        <input id="tanggallahir" name="petage" placeholder="Tanggal Lahir Hewan" class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Kode Orang Tua Peliharaan</label>
                                    <div class="col-md-10 col-sm-12">
                                        <input id="petparent" name="petparent" placeholder="Kode Orang Tua Hewan" class="form-control" type="text">
                                        <small>Kode orang tua hewan jika orang tua hewan pernah di daftarkan di Hallovet</small>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Warna Hewan</label>
                                    <div class="col-md-10 col-sm-12">
                                        <input id="petcolor" name="petcolor" placeholder="Warna Dominan Hewan" class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Berat Hewan (dalam Kg)</label>
                                    <div class="col-md-10 col-sm-12">
                                        <input id="petweight" name="petweight" placeholder="Berat Hewan" class="form-control" type="text">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="col-md-2 control-label">Jenis Kelamin Hewan</label>
                                    <div class="col-md-10 col-sm-12">
                                        <select id="petsex" name="petsex" class="form-control">
                                            <option value="1">Jantan</option>
                                            <option value="2">Betina</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label">Status Vaksin</label>
                                    <div class="col-md-10 col-sm-12">
                                        <select id="selectbasic" name="petvaksin" class="form-control">
                                            <option value="1">Belum Vaksin</option>
                                            <option value="2">Sudah Vaksin</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label class="col-md-2 control-label">Ciri Hewan Peliharaan</label>
                                    <div class="col-md-10 col-sm-12 ">
                                        <textarea name="petciri"></textarea>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-2" for="profile">Foto Hewan </label>
                                    <div class="col-md-10">
                                        <img src="" id="blah" style="max-width:700px;max-height:300px;" />

                                        <input type="file" id="inputprofilepic" name="petphoto" class="validate">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-md-4 col-md-offset-4">
                                        <button id="singlebutton" name="submit" class="btn btn-lg btn-primary">Daftarkan</button>
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

<script>
    $('#tanggallahir').datepicker({
    });
$(document).ready(function() {

$("#pettype").change(function() {
    var val = $(this).val();
    if (val == "1") {
    $("#petdetail").html("<option value='Kucing'>Kucing</option><option value='Anjing'>Anjing</option><option value='kelinci'>Kelinci</option><option value='Marmut'>Marmut</option><option value='Hamster'>Hamster</option><option value='Sapi'>Sapi</option><option value='Kambing'>Kambing</option><option value='Domba'>Domba</option><option value='kuda'>Kuda</option><option value='Babi'>Babi</option><option value='Monyet/kera'>Monyet / Kera</option><option value='Musang'>Musang</option><option value='Berang Berang'>Berang Berang</option>");
    } else if (val == "2") {
        $("#petdetail").html("<option value='ular'>Ular</option><option value='Biawak'>Biawak</option><option value='Iguana'>Babi</option><option value='Savanah Monitor'>Savanah Monitor</option><option value='Penyu'>Penyu</option><option value='Kura Kura'>Kura Kura</option><option value='Buaya'>Buaya</option>");

    } else if (val == "3") {
        $("#petdetail").html("<option value='Ayam'>Ayam</option><option value='Burung'>Burung</option>");

    }else if (val == "4") {
        $("#petdetail").html("<option value='Katak'>Katak</option><option value='Kodok'>Kodok</option>");

    }else if (val == "5") {
        $("#petdetail").html("<option value='Insekta'>Insekta</option>");

    }
});


});
</script>
@endsection
