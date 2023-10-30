<!-- Sidebar
					============================================= -->
<aside class="col-md-4">
    <div class="sidebar-widget clearfix">
        <div class="card-user-profile-container" style="border-radius: 15px;">
            <div class="card-user-profile-inner" style="padding-top: 15px;">
                @if(Auth::check())
                @if(Auth::user()->role == 3)
                <center>
                    <a href="{{ url('dashboard') }}" class="btn btn-info">Dashboard</a>
                    <a href="{{ url('konsultasi/baru') }}" class="btn btn-primary">Buat Pertanyaan</a>
                </center>
                <br>
                @else
                @endif
                @else
                @endif
                <h3 class="text-center light" data-aos="flip-left" data-aos-duration="1500">Featured <span>Doctor</span></h3>
                <br>
                <div class="row">
                    @foreach($randoc as $rd)
                    <div class="col-md-6 col-xs-6 col-sm-6">
                        <center>
                            <a class="hvr-hang" data-aos="fade-left" data-aos-duration="1500" href="{{ url('user/'.$rd->id) }}">
                                <img src="{{asset($rd->profilepic)}}" class="img-responsive img-circle" style="width: 50px; height: 50px !important;">
                                <b>{{$rd->name}}</b>
                            </a>
                        </center>
                    </div>
                    @endforeach
                </div>
                <br>
                <a data-aos="fade-left" data-aos-duration="1500" class="hvr-underline-reveal" href="{{ url('dokter') }}" style="float: right">See All</a>

            </div>
        </div>
    </div>
    <div class="sidebar-widget clearfix">
        <div class="card-user-profile-container" style="border-radius: 15px;">
            <div class="card-user-profile-inner" style="padding-top: 15px; text-align: justify;">

                <h3 class="light text-center" data-aos="flip-left" data-aos-duration="1500"><a class="hvr-hang" href="{{ url('artikel') }}">Artikel <span>Terbaru</span></a></h3>
                @foreach($randart as $ra)
                <article class="popular-post">

                    <a data-aos="fade-left" data-aos-duration="1500" class="hvr-hang" href="{{ url('artikel/'.$ra->artslug) }}"><img src="{{asset($ra->artthumbnail)}}" class="img-responsive img-fluid" style="height: 50px !important; width: 50px !important;" alt="">
                        <b>{{$ra->artjudul}}</b></a> {{--<i> oleh {{$ra->name}}</i>
                    <p class="popular-date">{{$ra->artdate}}</p>--}}
                </article>
                @endforeach
            </div>
        </div>
    </div>
    <div class="sidebar-widget clearfix">
        <div class="card-user-profile-container" style="border-radius: 15px;">
            <div class="card-user-profile-inner" style="padding-top: 15px;">

                <h3 class="light text-center" data-aos="flip-left" data-aos-duration="1500"><a class="hvr-hang" href="{{ url('penyakit') }}"><span>Penyakit Hewan</span></a></h3>

                <ul class="tags">
                    @foreach($randpen as $rp)
                    <li><a data-aos="fade-left" data-aos-duration="1500" class="hvr-hang" href="{{ url('penyakit/'.$rp->penslug) }}">{{$rp->pennama}}</a></li>
                    @endforeach
                </ul>
            </div>
            <div class="height40"></div>
            <div class="height20"></div>
        </div>
    </div>
    <div class="sidebar-widget clearfix">

        {!! $ad->universalsidebar !!}
    </div>
</aside>
