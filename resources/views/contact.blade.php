@extends('layouts.web')
@section('title','Contact - ')
@section('content')


<!-- Sub Page Content
			============================================= -->
<div id="sub-page-content" class="clearfix">

    <div class="container">

        <div class="row">

            <div class="col-md-8 col-md-offset-2 clearfix">

                <h1 class="light text-center" data-aos="flip-left" data-aos-duration="1500"><span>Hubungi Kami</span></h1>
                <br>

                <!-- Contact Form
							============================================= -->
                <div class="contact-form2" data-aos="fade-up" data-aos-duration="1500">
                    <form name="contact_form" id="contact_form" action="{{ url('contact/send') }}" method="post">
                        {{csrf_field()}}
                        <input type="text" name="contname" id="fname" placeholder="Nama">
                        <input type="text" name="contemail" id="email_address" placeholder="Alamat Email">
                        <input type="text" name="contjudul" id="subject" placeholder="Subjek" class="last">
                        <textarea placeholder="Message" name="contisi" id="msg"></textarea>
                        {{--<label>Tuliskan Hallovet di kotak di samping (verifikasi manusia) lalu klik Send</label>--}}
                        <input type="text" name="captcha" id="manualcaptcha" placeholder="tulis 'Hallovet' tanpa tanda petik">
                        <input type="submit" class="btn btn-default hvr-grow-shadow" value="Send" onClick="validateContact();">
                    </form>

                </div>



            </div>

        </div>
        <br>
        <br>
        <div class="row">
            <div class="col-md-8 col-md-offset-2">

                <h1 class="light text-center " data-aos="flip-left" data-aos-duration="1500"><span>Kontak Kami</span></h1>
                <br>

                <!-- Get in Touch Widget
							============================================= -->
                <div class="get-in-touch-widget boxed" data-aos="fade-up" data-aos-duration="1500">

                    <ul class="footer-nav list-unstyled clearfix">
                        <li><i class="fab fa-whatsapp fa-3x"></i><a href="https://wa.me/628734458436">W.A : 087-344-584-36</a></li>
                        <li><i class="far fa-envelope fa-3x"></i><a href="mailto:admin@hallovet.com">Email : admin@hallovet.com</a></li>
                        <li><i class="fab fa-facebook fa-3x"></i><a href="#">Facebook : Hallovet</a></li>
                        <li><i class="fab fa-instagram"></i><a href="https://www.instagram.com/hallovet/">Instagram : @hallovet</a></li>
                        <li><i class="fas fa-map-marker-alt fa-3x"></i>Sinduadi, Sleman, Yogyakarta
                        </li>
                    </ul>
                    <div class="google-maps text-center">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d7906.519593910268!2d110.363767!3d-7.762249000000001!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0xea853b29f1b3f94f!2sHallovet.com!5e0!3m2!1sid!2sid!4v1548166017675" width="600" height="450" frameborder="0" style="border:0" allowfullscreen></iframe>
                    </div>

                </div>

            </div>
        </div>

    </div>

</div>
<!--end sub-page-content-->



@endsection
