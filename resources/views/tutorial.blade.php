<!doctype html>
<html lang="en" class="no-js">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href='http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700' rel='stylesheet' type='text/css'>

    <link rel="stylesheet" href="{{ asset('css/tutorial.css')}}">

    <link rel="stylesheet" href="{{ asset('css/reset.css')}}"> <!-- Resource style -->
    <!-- Modernizr -->
    <title>Panduan Penggunaan Hallovet</title>
</head>

<body>
    <header>
        <h1>Panduan Penggunaan Hallovet</h1>
    </header>
    <section class="cd-faq">
        <!-- cd-faq-categories -->

        <ul class="cd-faq-categories">
            <li><a class="selected" href="#member">Member</a></li>
            <li><a href="#dokter">Dokter</a></li>
            <br>
            <li><a href="{{ url('/') }}">Kembali ke Home</a></li>
        </ul> <!-- cd-faq-categories -->


        <div class="cd-faq-items">

            <ul id="member" class="cd-faq-group">
                <li class="cd-faq-title">
                    <h2>Member</h2>
                </li>
                <li>
                    <a class="cd-faq-trigger" href="#0">Tata cara registrasi</a>
                    <div class="cd-faq-content">


                        <!-- popup and contents -->
                        <iframe src="https://drive.google.com/file/d/1oH0UMyizQATt9wiEzi7nfCImyet95B2n/preview" width="640" height="480"></iframe>
                        <!--                        <a href="javascript:;" onClick="toggleVideo('hide');">close</a>-->

                    </div> <!-- cd-faq-content -->
                </li>

                <li>
                    <a class="cd-faq-trigger" href="#0">Tata cara mendaftarkan hewan peliharaan</a>
                    <div class="cd-faq-content">
                        <iframe src="https://drive.google.com/file/d/1-zaA4dFU_LWqp3456vn381fNE36ZCJS3/preview" width="640" height="480"></iframe> </div> <!-- cd-faq-content -->
                </li>
                <li>
                    <a class="cd-faq-trigger" href="#0">Tata cara membuat pertanyaan</a>
                    <div class="cd-faq-content">
                        <iframe src="https://drive.google.com/file/d/1cs_EQIRFZQD-Btowd97Uq3dZIsRpp27_/preview" width="640" height="480"></iframe>
                    </div> <!-- cd-faq-content -->
                </li>
                <li>
                    <a class="cd-faq-trigger" href="#0">Tata cara mencari dokter hewan setempat</a>
                    <div class="cd-faq-content">
                        <iframe src="https://drive.google.com/file/d/19dAUNt0K13wCQMd317bsDhLmzeAZeOFn/preview" width="640" height="480"></iframe>
                    </div> <!-- cd-faq-content -->
                </li>
            </ul> <!-- cd-faq-group -->

            <ul id="dokter" class="cd-faq-group">
                <li class="cd-faq-title">
                    <h2>Dokter</h2>
                </li>
                <li>
                    <a class="cd-faq-trigger" href="#0">Tata cara registrasi</a>
                    <div class="cd-faq-content">
                        <iframe src="https://drive.google.com/file/d/126RzZnkTmAsrj70GKjUVOFGo1zcLVh1u/preview" width="640" height="480"></iframe>
                    </div> <!-- cd-faq-content -->
                </li>

                <li>
                    <a class="cd-faq-trigger" href="#0">Tata cara menjawab pertanyaan member</a>
                    <div class="cd-faq-content">
                        <iframe src="https://drive.google.com/file/d/1FnnWYs8zAaBqB79vhMA4sBPHsXTDhKAw/preview" width="640" height="480"></iframe>
                    </div> <!-- cd-faq-content -->
                </li>

                <li>
                    <a class="cd-faq-trigger" href="#0">Tata cara membuat artikel</a>
                    <div class="cd-faq-content">
                        <iframe src="https://drive.google.com/file/d/1lWpewDrMOWgp8RZ-fRnlldBWqMYGi2BS/preview" width="640" height="480"></iframe>
                    </div> <!-- cd-faq-content -->
                </li>
                <li>
                    <a class="cd-faq-trigger" href="#0">Tata cara mengisi ambulatoir</a>
                    <div class="cd-faq-content">
                        <iframe src="https://drive.google.com/file/d/1uje6bjgQ2U1WbrMWgItoCAM8DCLJBB0v/preview" width="640" height="480"></iframe>
                    </div> <!-- cd-faq-content -->
                </li>
            </ul> <!-- cd-faq-group -->
        </div> <!-- cd-faq-items -->
        <a href="#0" class="cd-close-panel">Close</a>
    </section> <!-- cd-faq -->

    <script src="{{ asset('js/jquery.js') }}"></script>
    <script src="{{ asset('js/jquery.mobile.custom.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>
    <script src="{{ asset('js/modernizr.js') }}"></script> <!-- Resource jQuery -->
    <!--
<script>
    function toggleVideo(state) {
        // if state == 'hide', hide. Else: show video
        var div = document.getElementById("popupVid");
        var iframe = div.getElementsByTagName("iframe")[0].contentWindow;
        if (div.state.display == '') {
            div.style.display = 'hide';
        } else {
            div.style.display = '';
        }
        func = state == 'hide' ? 'pauseVideo' : 'playVideo';
        iframe.postMessage('{"event":"command","func":"' + func + '","args":""}', '*');
    }
</script>
-->
</body>

</html>
