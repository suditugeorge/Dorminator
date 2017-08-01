@extends('layouts.master')

@section('title')
Dorminator Home
@endsection

@section('scripts')
<script type="text/javascript" src="{{ URL::asset('js/admin-signup.js') }}"></script>
@endsection

@section('styles')
<link rel="stylesheet" href="{{ URL::asset('css/home.css') }}" />
@endsection

@section('content')

<div class="view intro hm-black-strong" id="home" style="background-image:url('{{URL::asset('images/fmi.jpg')}}');">
<div class="full-bg-img flex-center">

<div class="container">
    <div class="row">
        <div class="col-md-6 col-lg-5 login-form mx-auto float-xs-none">
            
            <!--Form with header-->
            <div class="card">
                <div class="card-block">

                    <!--Header-->
                    <div class="form-header">
                        <h3><i class="fa fa-lock"></i> Înregistrare:</h3>
                    </div>

                    <div class="md-form">
                        <i class="fa fa-envelope prefix"></i>
                        <input type="text" id="email" class="form-control validate" value="{{$email}}" disabled>
                        <label for="email" class="disabled">Email</label>
                    </div>

                    <!--Body-->
                    <div class="md-form">
                        <i class="fa fa-user prefix"></i>
                        <input type="text" id="name" class="form-control validate">
                        <label for="name">Nume</label>
                    </div>

                    <div class="md-form">
                        <i class="fa fa-phone prefix"></i>
                        <input type="text" id="phone" class="form-control validate">
                        <label for="phone">Telefon</label>
                    </div>                    

                    <div class="md-form">
                        <i class="fa fa-lock prefix"></i>
                        <input type="password" id="password" class="form-control validate">
                        <label for="password">Parolă</label>
                    </div>

                    <div class="text-xs-center">
                        <button class="btn btn-primary" id="signup">Sign up</button>
                    </div>

                </div>

            </div>
            <!--/Form with header-->

        </div>
    </div>
</div>

</div>
</div>

@endsection