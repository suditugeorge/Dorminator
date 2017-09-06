@extends('layouts.master')

@section('title')
Dorminator Utilizatori
@endsection

@section('scripts')
<script type="text/javascript" src="{{ URL::asset('js/users-admin.js') }}"></script>
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
    <section class="section">
        <!-- First row -->
        <div class="row">
            <!-- Second column -->
            <div class="col-lg-12">
                <!--Card-->
                <div class="card card-cascade narrower mb-r">
                    <div class="admin-panel info-admin-panel">
                        <!--Card image-->
                        <div class="view primary-color">
                            <h5>Adaugă admini</h5>
                        </div>
                        <!--/Card image-->
                        <!--Card content-->
                        <div class="card-block">
                            <!-- Edit Form -->
							<form>
							    <!--Second row-->
							    <div class="row">
							        <!--First column-->
							        <div class="col-md-12">

							            <div class="md-form">
							                <textarea type="text" id="emails" class="md-textarea" style="resize:vertical;"></textarea>
							                <label for="emails">Adrese de email</label>
							            </div>

							        </div>
							    </div>
							    <!-- Fourth row -->
							    <div class="row">
							        <div class="col-md-12 text-center">
							            <button class="btn btn-primary" id="add-admins">Adaugă admini</button>
							        </div>
							    </div>
							    <!-- /.Fourth row -->
							</form>

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