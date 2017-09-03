@extends('layouts.master')

@section('title')
    Dorminator - Mesaje
@endsection

@section('scripts')
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
    <main class="">
        <div class="container-fluid">
            <section class="section">
                @include('messaging.messages-table')
            </section>
        </div>
    </main>

@endsection