@extends('layouts.master')

@section('title')
    Schimbă adresa de email a contului
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ URL::asset('js/change-email.js') }}"></script>
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
                                    <h3><i class="fa fa-lock"></i> Schimbă adresa de email</h3>
                                </div>

                                <div class="md-form">
                                    <i class="fa fa-user prefix"></i>
                                    <input type="text" id="username" class="form-control validate " disabled value="{{$user->username}}">
                                    <label for="username">Username</label>
                                </div>

                                <div class="md-form">
                                    <i class="fa fa-envelope prefix"></i>
                                    <input type="text" id="email" class="form-control validate">
                                    <label for="email">Adresă de email nouă</label>
                                </div>

                                <div class="text-center">
                                    <button class="btn btn-primary" id="change-email">Schimbă</button>
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
