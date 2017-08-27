@extends('layouts.master')

@section('title')
    Schimbă parola contului
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ URL::asset('js/change-password.js') }}"></script>
    <script>
        // Material Select Initialization
        $(document).ready(function() {
            $('.mdb-select').material_select();
        });

        // Tooltips Initialization
        $(function() {
            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>
@endsection

@section('content')

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
                                    <h3><i class="fa fa-lock"></i> Schimbă parola</h3>
                                </div>

                                <div class="md-form">
                                    <i class="fa fa-envelope prefix"></i>
                                    <input type="text" id="username" class="form-control validate " disabled value="{{$user->username}}">
                                    <label for="username">Username</label>
                                </div>

                                <div class="md-form">
                                    <i class="fa fa-lock prefix"></i>
                                    <input type="password" id="password" class="form-control validate">
                                    <label for="password">Parolă nouă</label>
                                </div>
                                <div class="md-form">
                                    <i class="fa fa-lock prefix"></i>
                                    <input type="password" id="repeat-password" class="form-control validate">
                                    <label for="repeat-password">Repetă parola nouă</label>
                                </div>


                                <div class="text-center">
                                    <button class="btn btn-primary" id="change-password">Schimbă</button>
                                </div>
                                <div class="text-center spinner-wrap hidden">
                                    <i class="fa fa-spinner fa-pulse fa-5x fa-fw"></i>
                                </div>
                            </div>
                            <!--/Form with header-->
                        </div>
                    </div>
            </section>
        </div>
    </div>

@endsection
