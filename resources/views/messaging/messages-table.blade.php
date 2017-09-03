<div class="container">
    <!-- First row -->
    <div class="row">
        <!-- First column -->
        <div class="col-md-12">
            <div class="row mb-1">
                <div class="col-md-9 col-sm-12">
                    <h4 class="h4-responsive mt-1">Mesaje</h4>
                </div>
                <div class="col-md-3 text-right col-sm-12">
                        <a href="/new-message" class="btn btn-unique">Mesaj Nou <i class="fa fa-pencil ml-1"></i></a>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <!-- Tabs -->
                    <!-- Nav tabs -->
                    <div class="tabs-wrapper">
                        <ul class="nav classic-tabs tabs-primary primary-color" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link waves-light active" data-toggle="tab" href="#panel83" role="tab">Mesaje</a>
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
                                        <th>De la</th>
                                        <th>Subiect</th>
                                        <th>Acțiuni</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach ($messages as $message)
                                    <tr>
                                        <th scope="row">{{$message->id}}</th>
                                        <td>{{$message->user()->get()[0]->username}}</td>
                                        <td>{{$message->subject}}</td>
                                        <td>
                                            <a class="teal-text" href="/messages/{{$message->id}}"><i class="fa fa-pencil"></i></a>
                                            <a class="red-text" href="/delete-message/{{$message->id}}"><i class="fa fa-times"></i></a>
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
                    {{$messages->links('layouts.pagination')}}
                </div>
            </div>
        </div>
        <!-- /.First column -->
    </div>
    <!-- /.First row -->
</div>
<!--/Pagination -->