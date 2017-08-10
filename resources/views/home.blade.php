@extends('layouts.master')

@section('title')
    Dorminator Home
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ URL::asset('js/home.js') }}"></script>
@endsection

@section('styles')
    <link rel="stylesheet" href="{{ URL::asset('css/home.css') }}"/>
@endsection

@section('content')

    <div class="view intro hm-black-strong" id="home" style="background-image:url('{{URL::asset('images/fmi.jpg')}}');">
        <div class="full-bg-img flex-center">

            <div class="container">
                <div class="row">
                    <section class="signup">
                        <div class="row">
                            <div class="col-md-6 col-lg-5 login-form mx-auto float-xs-none">

                                <!--Form with header-->
                                <div class="card">
                                    <div class="card-block">

                                        <!--Header-->
                                        <div class="form-header">
                                            <h3><i class="fa fa-lock"></i> Login</h3>
                                        </div>

                                        <div class="md-form">
                                            <i class="fa fa-envelope prefix"></i>
                                            <input type="text" id="username" class="form-control validate">
                                            <label for="username">Username</label>
                                        </div>

                                        <div class="md-form">
                                            <i class="fa fa-lock prefix"></i>
                                            <input type="password" id="password" class="form-control validate">
                                            <label for="password">Parolă</label>
                                        </div>

                                        <div class="text-center">
                                            <fieldset class="form-group">
                                                <input type="checkbox" id="remember" name="remember">
                                                <label for="remember">Ține-mă minte</label>
                                            </fieldset>
                                            <button class="btn btn-primary" id="login">Login</button>
                                        </div>
                                    </div>
                                    <!--/Form with header-->
                                </div>
                            </div>
                    </section>
                </div>
            </div>

        </div>
    </div>

@endsection
