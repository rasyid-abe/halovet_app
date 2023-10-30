<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="description" content="Responsive Admin Dashboard Template">
        <meta name="keywords" content="admin,dashboard">
        <meta name="author" content="stacks">
        <!-- The above 6 meta tags *must* come first in the head; any other head content must come *after* these tags -->
        
        <!-- Title -->
        <title>@yield('title') Hallovet Admin X</title>

        <!-- Styles -->
        <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
        <link href="{{asset('dash/plugins/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
        <link href="{{asset('dash/plugins/font-awesome/css/font-awesome.min.css')}}" rel="stylesheet">
        <link href="{{asset('dash/plugins/icomoon/style.css')}}" rel="stylesheet">
        <link href="{{asset('dash/plugins/uniform/css/default.css')}}" rel="stylesheet"/>
        <link href="{{asset('dash/plugins/switchery/switchery.min.css')}}" rel="stylesheet"/>
      
        <!-- Theme Styles -->
        <link href="{{asset('dash/css/space.min.css')}}" rel="stylesheet">
        <link href="{{asset('dash/css/custom.css')}}" rel="stylesheet">
        <script src="{{asset('dash/plugins/jquery/jquery-3.1.0.min.js')}}"></script>
        <script src="{{asset('dash/plugins/bootstrap/js/bootstrap.min.js')}}"></script>
        <script src="{{asset('dash/plugins/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
        <script src="{{asset('dash/plugins/uniform/js/jquery.uniform.standalone.js')}}"></script>
        <script src="{{asset('dash/plugins/switchery/switchery.min.js')}}"></script>
        <script src="{{asset('dash/js/space.min.js')}}"></script>
                <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" />

        <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
        <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
        <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="page-header-fixed">
        
        <!-- Page Container -->
        <div class="page-container">
            <!-- Page Sidebar -->
            <div class="page-sidebar">
                <a class="logo-box" href="{{url('/')}}">
                    <span>HalloVet</span>
                    <i class="icon-radio_button_unchecked" id="fixed-sidebar-toggle-button"></i>
                    <i class="icon-close" id="sidebar-toggle-button-close"></i>
                </a>
                <div class="page-sidebar-inner">
                    <div class="page-sidebar-menu">
                        <ul class="accordion-menu">
                            <li class="active-page">
                                <a href="{{ url('adminix') }}">
                                    <i class="menu-icon icon-home4"></i><span>Dashboard</span>
                                </a>
                            </li>
                            <li>
                                <a href="javascript:void(0);">
                                    <i class="menu-icon icon-user"></i><span>User</span><i class="accordion-icon fa fa-angle-left"></i>
                                </a>
                                <ul class="sub-menu">
                                    <li><a href="{{ url('adminix/user') }}">Semua Pengguna</a></li>
                                    <li><a href="{{ url('adminix/user/dokter') }}">Semua Dokter</a></li>
                                    <li><a href="{{ url('adminix/user/dokter/unverified') }}">Dokter Unverified</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0);">
                                    <i class="menu-icon icon-chat"></i><span>Thread Diskusi</span><i class="accordion-icon fa fa-angle-left"></i>
                                </a>
                                <ul class="sub-menu">
                                    <li><a href="{{ url('adminix/konsultasi') }}">Semua Diskusi</a></li>
                                    <li><a href="{{ url('adminix/jawabandiskusi') }}">Semua Jawaban Diskusi</a></li>
                                    <li><a href="{{ url('adminix/konsultasi/category') }}">Semua Kategori Diskusi</a></li>
                                    <li><a href="{{ url('adminix/konsultasi/category/new') }}">Buat Kategori Diskusi</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0);">
                                    <i class="menu-icon icon-book"></i><span>Artikel</span><i class="accordion-icon fa fa-angle-left"></i>
                                </a>
                                <ul class="sub-menu">
                                    <li><a href="{{ url('adminix/artikel') }}">Semua Artikel</a></li>
                                    <li><a href="{{ url('adminix/artikel/new') }}">Buat Artikel</a></li>
                                     <li><a href="{{ url('adminix/artikel/kategori') }}">Semua Kategori Artikel</a></li>
                                    <li><a href="{{ url('adminix/artikel/kategori/new') }}">Buat Kategori Artikel</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0);">
                                  <i class="fa fa-asterisk"></i><span style="margin-left: 8px;">Penyakit</span><i class="accordion-icon fa fa-angle-left"></i>
                                </a>
                                <ul class="sub-menu">
                                    <li><a href="{{ url('adminix/penyakit') }}">Semua Penyakit</a></li>
                                    <li><a href="{{ url('adminix/penyakit/new') }}">Tambah Penyakit</a></li>
                                </ul>
                            </li>
                                <li>
                                <a href="javascript:void(0);">
                                    <i class="menu-icon icon-format_list_bulleted"></i><span>Slider</span><i class="accordion-icon fa fa-angle-left"></i>
                                </a>
                                <ul class="sub-menu">
                                    <li><a href="{{ url('adminix/slider') }}">Semua Slider</a></li>
                                    <li><a href="{{ url('adminix/slider/new') }}">Tambah Slider</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0);">
                                    <i class="fa fa-paw"></i><span style="margin-left: 8px;">Hewan Peliharaan</span><i class="accordion-icon fa fa-angle-left"></i>
                                </a>
                                <ul class="sub-menu">
                                    <li><a href="{{ url('adminix/peliharaan') }}">Semua Peliharaan</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0);">
                                   <i class="fa fa-sticky-note"></i><span style="margin-left: 8px;">Riwayat Pemeriksaan</span><i class="accordion-icon fa fa-angle-left"></i>
                                </a>
                                <ul class="sub-menu">
                                    <li><a href="{{ url('adminix/pemeriksaan') }}">Semua Pemeriksaan</a></li>
                                </ul>
                            </li>
                             <li>
                                <a href="javascript:void(0);">
                                     <i class="fa fa-buysellads"></i><span style="margin-left: 8px;">Iklan</span><i class="accordion-icon fa fa-angle-left"></i>
                                </a>
                                <ul class="sub-menu">
                                    <li><a href="{{ url('adminix/ads') }}">Semua Iklan</a></li>
                                </ul>
                            </li>
                               <li>
                                <a href="javascript:void(0);">
                                      <i class="fa fa-user-md"></i><span style="margin-left: 8px;">Pekerjaan</span><i class="accordion-icon fa fa-angle-left"></i>
                                </a>
                                <ul class="sub-menu">
                                    <li><a href="{{ url('adminix/loker') }}">Semua Lowongan</a></li>
                                </ul>
                            </li>
                            <li>
                                <a href="javascript:void(0);">
                                    <i class="fa fa-envelope"></i><span style="margin-left: 8px;"> Contact</span><i class="accordion-icon fa fa-angle-left"></i>
                                </a>
                                <ul class="sub-menu">
                                    <li><a href="{{ url('adminix/contact') }}">Kotak Masuk</a></li>
                                </ul>
                            </li>
                            <li class="menu-divider"></li>
                            <li>
                                <a href="#">
                                    <i class="menu-icon icon-help_outline"></i><span>Panduan &amp; Dokumentasi</span>
                                </a>
                            </li>
                            <li>
                                <a href="#">
                                    <i class="menu-icon icon-public"></i><span>CMS Versi</span><span class="label label-danger">1.0</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div><!-- /Page Sidebar -->
            
            <!-- Page Content -->
            <div class="page-content">            
                <!-- Page Header -->
                <div class="page-header">
                    
                    <nav class="navbar navbar-default">
                        <div class="container-fluid">
                            <!-- Brand and toggle get grouped for better mobile display -->
                            <div class="navbar-header">
                                <div class="logo-sm">
                                    <a href="javascript:void(0)" id="sidebar-toggle-button"><i class="fa fa-bars"></i></a>
                                    <a class="logo-box" href="index.html"><span>Hallovet</span></a>
                                </div>
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
                                    <i class="fa fa-angle-down"></i>
                                </button>
                            </div>
                        
                            <!-- Collect the nav links, forms, and other content for toggling -->
                        
                            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                                <ul class="nav navbar-nav">
                                    <li><a href="javascript:void(0)" id="collapsed-sidebar-toggle-button"><i class="fa fa-bars"></i></a></li>
                                    <li><a href="javascript:void(0)" id="toggle-fullscreen"><i class="fa fa-expand"></i></a></li>
                                </ul>
                                <ul class="nav navbar-nav navbar-right">

                                    <li class="dropdown user-dropdown">
                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><img src="{{ asset(Auth::user()->profilepic) }}" alt="" class="img-circle"> {{Auth::user()->name}} </a>
                                        <ul class="dropdown-menu">
                                           
                                            <li role="separator" class="divider"></li>
                                            <li><a href="{{ url('logout') }}">Log Out</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div><!-- /.navbar-collapse -->
                        </div><!-- /.container-fluid -->
                    </nav>
                </div><!-- /Page Header -->
                @if (notify()->ready())
 <script type="text/javascript">
swal({
            title: "{!! notify()->message() !!}",
            text: "{!! notify()->option('text') !!}",
            icon: "{{ notify()->type() }}",
            @if (notify()->option('timer'))
                timer: {{ notify()->option('timer') }},
                showConfirmButton: false
            @endif
        });
 </script>
 @endif
                @yield('js')
                @yield('content')
               
              
            </div><!-- /Page Content -->
        </div><!-- /Page Container -->
        
        
        <!-- Javascripts -->

    </body>
</html>