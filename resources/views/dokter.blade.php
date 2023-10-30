@extends('layouts.web')
@section('title','Direktori Dokter Hewan - ')
@section('content')
<script type="text/javascript" src="{{asset('jquery.gmap.js')}}"></script>

<!-- Sub Page Content
			============================================= -->
<div id="sub-page-content" class="clearfix">

    <div class="container">

        <div class="row">
            <aside class="col-md-12 blog-wrapper clearfix">

                <!-- Categories Widget
							============================================= -->
                <div class="sidebar-widget clearfix">

                    <h2 class="text-center light">Cari Berdasar <span>Kota</span></h2>
                    <center>
                        <form method="get" action="{{ url('dokter') }}">
                            <div class="form-group">
                                <div class="col-md-4 col-md-offset-4">
                                   <select id="provinsi" class="form-control">
                                        
                                    </select>
                                    <select id="kabupaten" name="kota" class="form-control">
                                        
                                    </select>
                                  
                                    <div class="col-md-6 col-md-offset-3">
                                        <button type="submit" class="btn btn-primary btn-sm">Cari</button>
                                    </div>
                                </div>

                            </div>

                        </form>
                    </center>
                </div>



                <!-- Archives
							============================================= -->

            </aside>
        </div>
        <div class="row">
            <div class="col-md-12 blog-wrapper clearfix">

                <h2 class="text-center light"><span>Dokter Hewan</span></h2>
                <div class="height40"></div>
                @if(count($alldok) == 0)
                <center>
                    <p>Maaf, tidak ada dokter hewan yang terdaftar di kota tersebut</p>
                </center>
                @else

                <div class="row">
                    @foreach($alldok as $a)
                    <div class="col-md-6">
                        <div class="col-md-2">
                            <center>
                                <img src="{{$a->profilepic}}" style="width: 100px; height: 100px;" class="img-responsive img-circle">
                            </center>
                        </div>
                        <div class="col-md-10">
                            <a href="{{ url('user/'.$a->id) }}"><b>{{$a->name}}</b></a>
                            @if($a->verifadmin == 1)
                            <label class="label label-success">Verified</label>
                            @else
                            <label class="label label-warning">Unverified</label><br>

                            @endif
                            <p><b>Alamat Praktek / Klinik</b> : {{$a->klinik}}
                                @if(!is_null($a->kotname))
                                {{$a->kotname}}
                                @else
                                @endif
                                <br>
                                <b>Almamater</b> : {{$a->lulusan}} ({{$a->tahunlulus}})
                                @if(Auth::check())
                                <br>
                                <b>Telp</b> : {{$a->nohp}}</p>
                            @else
                            <br>
                            <p><b>Telp</b> : Silahkan login untuk lihat No Telepon</p>
                            @endif
                            <p><b>Bio</b> : {{$a->bio}}<br>
                                <p>
                        </div>
                    </div>
                    @endforeach
                </div>

                <center>
                    {{ $alldok->links() }}
                </center>

                @endif

            </div>
        </div>
    </div>
</div>


<!--end sub-page-content-->

<script>
    $(function(){
        namaprovinsi();
    });
    
    $("#provinsi").change(function () {
//        $('#kabupaten').html("<option value='none'>--Kabupaten/Kota--</option>");
//        $('#kecamatan').html("<option value='none'>--Kecamatan--</option>");

        str = $('#provinsi').val();
        if (str != "none") {
            id = $('#provinsi').val();
            nama = $('select[name=provinsi]').find('option[value="' + id + '"]').text();
            $('#namaprov').val(nama);
            namakota(id);
        }
    });
    
    function namaprovinsi() {
        $.get("{{route('cariprovinsi')}}", function (data) {
            $.each(data, function (index, value) {
                $('#provinsi').append("<option value='" + value.id + "'>" + value.provname + "</option>");
            });
        });
    }

    function namakota(id_prov) {
    $.get("{{route('carikota')}}?id=" + id_prov, function (data) {
        $.each(data, function (index, value) {
            $('#kabupaten').append("<option value='" + value.kotid + "'>" + value.kotname + "</option>");
        });
    });
} 
</script>


@endsection
