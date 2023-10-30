@extends('layouts.web')
@section('title','Pemeriksaan Baru - ')
@section('content')
@section('js')
<script src="{{asset('js/jquery.autocomplete.min.js')}}"></script>
@endsection


<!-- Sub Page Content
			============================================= -->
<div id="sub-page-content" class="clearfix">

    <div class="container">

        <div class="row">

            <div class="col-md-12 clearfix">

                <h2 class="bordered light">Pemeriksaan Baru</h2>

                <div class="panel panel-white">

                    <div class="panel-body">
                        <form  method="post" action="{{ url('dashboard/pemeriksaan/new/save') }}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <fieldset>

                                <div class="row">
                                    <!-- Text input-->
                                    <div class="form-group">
                                        <label class="col-md-2 control-label" for="textinput">No / Kode Hewan</label>
                                        <div class="col-md-10 col-sm-12">
                                        <input type="text" name="country" id="autocompletex"/>
                                            <small>Kode Hewan Yang Terdaftar di Hallovet, jika tidak ada kosongkan</small>
                                        </div>
                                    </div>

                                    <div class="form-group mt-5">
                                        <label class="col-md-2 control-label" for="textinput">Anamnesa</label>
                                        <div class="col-md-10 col-sm-12 ">
                                            <textarea name="peranamnesa"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label" for="textinput">Pemeriksaan Umum</label>
                                        <div class="col-md-10 col-sm-12 ">
                                            <textarea name="perumum"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label" for="textinput">Pemeriksaan Khusus</label>
                                        <div class="col-md-10 col-sm-12 ">
                                            <textarea name="perkhusus"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="col-md-2 control-label" for="textinput">Pengobatan / Tindakan</label>
                                        <div class="col-md-10 col-sm-12 ">
                                            <textarea name="pengobatan"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <div class="col-md-4">
                                            <button id="singlebutton" name="submit" class="btn btn-lg btn-primary">Buat</button>
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
</div>
<!--end sub-page-content-->
<script>
$('#autocompletex').autocomplete({
    serviceUrl: 'allpetapi',
    onSelect: function (suggestion) {
        alert('You selected: ' + suggestion.value + ', ' + suggestion.data);
    }
});


</script>

@endsection
