@extends('layouts.master')

@section('title')
    Dorminator - Mesaj #{{$message->id}}
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
    <main>
        <div class="container">
            <!-- Form contact -->
            <form>

                <p class="h5 text-center mb-4">Mesaj #{{$message->id}}</p>

                <div class="md-form">
                    <i class="fa fa-user prefix grey-text"></i>
                    <input type="text" id="form3" class="form-control" disabled value="{{$from->username}}">
                    <label for="form3">De la</label>
                </div>

                <div class="md-form">
                    <i class="fa fa-tag prefix grey-text"></i>
                    <input type="text" id="form32" class="form-control" disabled value="{{$message->subject}}">
                    <label for="form34">Subiect</label>
                </div>

                <div class="md-form">
                    <i class="fa fa-pencil prefix grey-text"></i>
                    <textarea type="text" id="form8" class="md-textarea" style="height: 100px ;resize: vertical;overflow-y: scroll;" disabled>{{$message->message}}</textarea>
                    <label for="form8">Conținutul mesajului</label>
                </div>

            </form>
            <!-- Form contact -->
        </div>
    </main>

@endsection
