@extends('layouts.admin')
@section('title','Dashboard')
@section('content')
 <!-- Page Inner -->
                <div class="page-inner">
                    <div class="page-title">
                        <h3 class="breadcrumb-header">Dashboard</h3>
                    </div>
                    <div id="main-wrapper">
                        <div class="row">
                            <div class="col-lg-3 col-md-6">
                                <div class="panel panel-white stats-widget">
                                    <div class="panel-body">
                                        <div class="pull-left">
                                            <span class="stats-number">$781,876</span>
                                            <p class="stats-info">Total Income</p>
                                        </div>
                                        <div class="pull-right">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="panel panel-white stats-widget">
                                    <div class="panel-body">
                                        <div class="pull-left">
                                            <span class="stats-number">578,100</span>
                                            <p class="stats-info">Downloads</p>
                                        </div>
                                        <div class="pull-right">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="panel panel-white stats-widget">
                                    <div class="panel-body">
                                        <div class="pull-left">
                                            <span class="stats-number">+23,356</span>
                                            <p class="stats-info">New Registrations</p>
                                        </div>
                                        <div class="pull-right">
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-3 col-md-6">
                                <div class="panel panel-white stats-widget">
                                    <div class="panel-body">
                                        <div class="pull-left">
                                            <span class="stats-number">58%</span>
                                            <p class="stats-info">Finished Tasks</p>
                                        </div>
                                        <div class="pull-right">
                                       
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!-- Row -->

                       
                        <div class="row">
                            <div class="col-lg-4 col-md-6">
                                <div class="panel panel-white">
                                    <div class="panel-heading clearfix">
                                        <h4 class="panel-title">Thread Terbaru</h4>
                                    </div>
                                    <div class="panel-body">
                                        <div class="browser-stats">
                                            <ul class="list-unstyled">
                                                <li><i class="fa fa-chrome"></i>Google Chrome<div class="text-success pull-right">32%<i class="fa fa-level-up"></i></div></li>
                                                <li><i class="fa fa-firefox"></i>Firefox<div class="text-success pull-right">25%<i class="fa fa-level-up"></i></div></li>
                                                <li><i class="fa fa-internet-explorer"></i>Internet Explorer<div class="text-success pull-right">16%<i class="fa fa-level-up"></i></div></li>
                                                <li><i class="fa fa-safari"></i>Safari<div class="text-danger pull-right">13%<i class="fa fa-level-down"></i></div></li>
                                                <li><i class="fa fa-opera"></i>Opera<div class="text-danger pull-right">7%<i class="fa fa-level-down"></i></div></li>
                                                <li><i class="fa fa-tablet"></i>Mobile &amp; tablet<div class="text-success pull-right">4%<i class="fa fa-level-up"></i></div></li>
                                                <li><i class="fa fa-hashtag"></i>Others<div class="text-success pull-right">3%<i class="fa fa-level-up"></i></div></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-6">
                                <div class="panel panel-white">
                                    <div class="panel-heading clearfix">
                                        <h4 class="panel-title">Member Terbaru</h4>
                                    </div>
                                    <div class="panel-body">
                                        <div class="project-stats">
                                            <ul class="list-unstyled">
                                                <li>Alpha - Admin Template<span class="label label-default pull-right">85%</span></li>
                                                <li>Meteor - Landing Page<span class="label label-success pull-right">Finished</span></li>
                                                <li>Modern - Corporate Website<span class="label label-success pull-right">Finished</span></li>
                                                <li>Space - Admin Template<span class="label label-danger pull-right">Rejected</span></li>
                                                <li>Backend UI<span class="label label-default pull-right">27%</span></li>
                                                <li>Personal Blog<span class="label label-default pull-right">48%</span></li>
                                                <li>E-mail Templates<span class="label label-default pull-right">Pending</span></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-4 col-md-12">
                                <div class="panel panel-white">
                                    <div class="panel-heading clearfix">
                                        <h4 class="panel-title">Income</h4>
                                    </div>
                                    <div class="panel-body">
                                        <canvas id="chart3"></canvas>
                                    </div>
                                </div>
                            </div>
                        </div><!-- Row -->
                    </div><!-- Main Wrapper -->
                    <div class="page-footer">
                        <p>Made with <i class="fa fa-heart"></i> by hadegawe</p>
                    </div>
                </div><!-- /Page Inner -->
                
@endsection