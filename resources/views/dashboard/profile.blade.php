@extends('layouts.master')

@section('title')
Dorminator Home
@endsection

@section('scripts')
<script type="text/javascript" src="{{ URL::asset('js/profile.js') }}"></script>
<script>
// Data Picker Initialization
$('.datepicker').pickadate();


// Material Select Initialization
$(document).ready(function() {
    $('.mdb-select').material_select();
});

// Sidenav Initialization
$(".button-collapse").sideNav();
var el = document.querySelector('.custom-scrollbar');
Ps.initialize(el);

// Tooltips Initialization
$(function() {
    $('[data-toggle="tooltip"]').tooltip();
});
</script>
@endsection

@section('styles')
@endsection

@section('content')
@include('dashboard.navigation')
<main class="">
<div class="container-fluid">
    <!-- Section: Edit Account -->
    <section class="section">
        <!-- First row -->
        <div class="row">
            <!-- First column -->
            <div class="col-lg-4">

                <!-- Card -->
                <div class="card contact-card card-cascade narrower mb-r">
                    <div class="admin-panel info-admin-panel">
                        <!-- Card title -->
                        <div class="view primary-color">
                            <h5>Profil</h5>
                        </div>
                        <!-- /.Card title -->

                        <!-- Card content -->
                        <div class="card-block text-center">
                            @if (file_exists(public_path('images/users/'.$user->id.'.jpg')))
                            <img src="{{URL::asset('images/users/'.$user->id.'.jpg')}}" alt="User Photo" class="rounded-circle contact-avatar my-2 mx-auto" />
                            @else
                                <img src="{{URL::asset('images/users/default.png')}}" alt="User Photo" class="rounded-circle contact-avatar my-2 mx-auto" />
                            @endif
                            <p class="text-muted"><small>{{App\Http\Controllers\MainController::getBasicInfo()}}</small></p>

                            <form role="form" method="POST" action="/change-profile-photo" enctype="multipart/form-data">
                                <input type="hidden" name="_token" value="{{Session::token()}}">
                                <div class="file-field">
                                    <div class="btn btn-primary btn-block">
                                        <span>Alege poză</span>
                                        <input type="file" name="profilePicture" onchange="this.form.submit();">
                                    </div>
                                </div>
                            </form>
                            <br/><br/><br/>
                                @if(isset($error_message))
                                <div class="card card-danger text-center z-depth-2 mt-1">
                                    <div class="card-block">
                                    <div class="row" style="margin-bottom: 0;">
                                      <div class="col-md-3"><i class="fa fa-warning fa-4x"></i></div>
                                      <div class="col-md-9"><p class="text-left font-weight-bold" id="error-message">{{$error_message}}</p></div>
                                    </div>
                                    </div>
                                </div>
                                @endif
                        </div>
                        
                        <!-- /.Card content -->

                    </div>
                </div>
                <!-- /.Card -->

            </div>
            <!-- /.First column -->
            <!-- Second column -->
            <div class="col-lg-8">
                <!--Card-->
                <div class="card card-cascade narrower mb-r">
                    <div class="admin-panel info-admin-panel">
                        <!--Card image-->
                        <div class="view primary-color">
                            <h5>Informații utilizator</h5>
                        </div>
                        <!--/Card image-->
                        <!--Card content-->
                        <div class="card-block">
                            <!-- Edit Form -->
                            @include('dashboard.edit-profile')

                        </div>
                        <!--/.Card content-->
                    </div>
                </div>
                <!--/.Card-->
            </div>
            <!-- /.Second column -->
        </div>
        <!-- /.First row -->
    </section>
    <!-- /.Section: Edit Account -->
</div>
</main>

@endsection