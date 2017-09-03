@extends('layouts.master')

@section('title')
    Dorminator - Adaugă instituție
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ URL::asset('js/student.js') }}"></script>
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
        <!-- Nav tabs -->
        <ul class="nav nav-tabs nav-justified" style="background-color: #222;">
            <li class="nav-item">
                <a class="nav-link active" data-toggle="tab" href="#panel3" role="tab">Listă studenți</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#panel1" role="tab">Adaugă un student</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" data-toggle="tab" href="#panel2" role="tab">Adaugă listă de studenți</a>
            </li>

        </ul>
        <!-- Tab panels -->
        <div class="tab-content card">
            <!--Panel 1-->
            <div class="tab-pane fade" id="panel1" role="tabpanel">
                <br/>
                @include('students.add-single-student')
            </div>
            <!--/.Panel 1-->
            <!--Panel 2-->
            <div class="tab-pane fade" id="panel2" role="tabpanel">
                <br>
                @include('students.add-students-list')
            </div>
            <!--/.Panel 2-->
            <!--Panel 3-->
            <div class="tab-pane fade in show active" id="panel3" role="tabpanel">
                <br>
                @include('students.list')
            </div>
            <!--/.Panel 3-->
        </div>

    </main>

@endsection