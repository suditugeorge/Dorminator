@extends('layouts.master')

@section('title')
    Dorminator - Mesaj nou
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ URL::asset('js/messages.js') }}"></script>
    <script>
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
    <main>
        <div class="container">
            <!-- Form contact -->
            <form>

                <p class="h5 text-center mb-4">Mesaj Nou</p>

                <div class="md-form">
                    <i class="fa fa-user prefix grey-text"></i>
                    <input type="text" class="form-control" id="username">
                    <label for="form3">Pentru (username)</label>
                </div>

                <div class="md-form">
                    <i class="fa fa-tag prefix grey-text"></i>
                    <input type="text" class="form-control" id="subject">
                    <label for="form34">Subiect</label>
                </div>

                <div class="md-form">
                    <i class="fa fa-pencil prefix grey-text"></i>
                    <textarea type="text" class="md-textarea" style="height: 100px ;resize: vertical;" id="message"></textarea>
                    <label for="form8">Conținutul mesajului</label>
                </div>

                <div class="text-center">
                    <button class="btn btn-unique" id="send-message">Trimite <i class="fa fa-paper-plane-o ml-1"></i></button>
                </div>
                <div class="text-center spinner-wrap hidden">
                    <i class="fa fa-spinner fa-pulse fa-5x fa-fw"></i>
                </div>
            </form>
            <!-- Form contact -->
        </div>
    </main>

@endsection
