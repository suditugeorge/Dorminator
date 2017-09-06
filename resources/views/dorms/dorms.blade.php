<div class="container-fluid">
    <div class="container">
        <div class="alert alert-warning">
            <p><strong>Atenție!</strong> Câmpurile marcate cu * sunt obligatorii!</p>
        </div>
        <!-- Form contact -->
        <form>

            <p class="h5 text-center mb-4">Cămin nou</p>

            <div class="md-form">
                <i class="fa fa-building prefix grey-text"></i>
                <input type="text" class="form-control required" id="dorm-name">
                <label for="dorm-name">Nume cămin *</label>
            </div>

            <div class="md-form">
                <i class="fa fa-code prefix grey-text"></i>
                <input type="text" class="form-control" id="dorm-code">
                <label for="dorm-code">Cod cămin *</label>
            </div>

            <div class="md-form">
                <i class="fa fa-pencil prefix grey-text"></i>
                <textarea type="text" class="md-textarea" style="height: 100px ;resize: vertical;"
                          id="dorm-description"></textarea>
                <label for="dorm-description">Descriere cămin</label>
            </div>

            <div class="text-center">
                <button class="btn btn-unique" id="send-dorm">Adaugă cămin <i class="fa fa-paper-plane-o ml-1"></i>
                </button>
            </div>
            <div class="text-center spinner-wrap hidden">
                <i class="fa fa-spinner fa-pulse fa-5x fa-fw"></i>
            </div>
        </form>
        <!-- Form contact -->
    </div>
    <br/>
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
                                    <a class="nav-link waves-light active" data-toggle="tab" href="#panel83" role="tab">Cămine</a>
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
                                        @foreach ($dorms as $dorm)
                                            <tr>
                                                <th scope="row">{{$dorm->id}}</th>
                                                <td>{{$dorm->name}}</td>
                                                <td>{{$dorm->code}}</td>
                                                <td>
                                                    <a class="red-text" href="/delete-dorm/{{$dorm->id}}"><i
                                                                class="fa fa-times"></i></a>
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
                        {{$dorms->links('layouts.pagination')}}
                    </div>
                </div>
            </div>
            <!-- /.First column -->
        </div>
        <!-- /.First row -->
    </div>
    <!--/Pagination -->
</div>