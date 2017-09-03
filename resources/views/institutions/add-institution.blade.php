@extends('layouts.master')

@section('title')
    Dorminator - Adaugă instituție
@endsection

@section('scripts')
    <script type="text/javascript" src="{{ URL::asset('js/institution.js') }}"></script>
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
            <div class="container">
                <!-- Form contact -->
                <form>

                    <p class="h5 text-center mb-4">Instituție Nouă</p>

                    <div class="md-form">
                        <i class="fa fa-building prefix grey-text"></i>
                        <input type="text" class="form-control required" id="institution-name">
                        <label for="institution-name">Nume instituție</label>
                    </div>

                    <div class="md-form">
                        <i class="fa fa-code prefix grey-text"></i>
                        <input type="text" class="form-control" id="institution-code">
                        <label for="institution-code">Cod instituție</label>
                    </div>

                    <div class="md-form">
                        <i class="fa fa-pencil prefix grey-text"></i>
                        <textarea type="text" class="md-textarea" style="height: 100px ;resize: vertical;" id="institution-description"></textarea>
                        <label for="institution-description">Descriere instituție</label>
                    </div>

                    <div class="text-center">
                        <button class="btn btn-unique" id="send-institution">Adaugă instituție <i class="fa fa-paper-plane-o ml-1"></i></button>
                    </div>
                    <div class="text-center spinner-wrap hidden">
                        <i class="fa fa-spinner fa-pulse fa-5x fa-fw"></i>
                    </div>
                </form>
                <!-- Form contact -->
            </div>
            <br />
            <div class="container">
                <!-- First row -->
                <div class="row">
                    <!-- First column -->
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-12">
                                <!-- Tabs -->
                                <!-- Nav tabs -->
                                <div class="tabs-wrapper">
                                    <ul class="nav classic-tabs tabs-primary primary-color" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link waves-light active" data-toggle="tab" href="#panel83" role="tab">Instituții</a>
                                        </li>
                                    </ul>
                                </div>
                                <!-- Tab panels -->
                                <div class="tab-content card">
                                    <!--Panel 1-->
                                    <div class="tab-pane fade show active" id="panel83" role="tabpanel">
                                        <div class="table-responsive">
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>Nume</th>
                                                    <th>Cod</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach ($institutions as $institution)
                                                    <tr>
                                                        <th scope="row">{{$institution->id}}</th>
                                                        <td>{{$institution->name}}</td>
                                                        <td>{{$institution->code}}</td>
                                                        <td>
                                                            <a class="red-text" href="/delete-institution/{{$institution->id}}"><i class="fa fa-times"></i></a>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <!--/.Panel 1-->
                                </div>
                                <!-- /.Tabs -->
                                {{$institutions->links('layouts.pagination')}}
                            </div>
                        </div>
                    </div>
                    <!-- /.First column -->
                </div>
                <!-- /.First row -->
            </div>
            <!--/Pagination -->
        </div>
    </main>

@endsection