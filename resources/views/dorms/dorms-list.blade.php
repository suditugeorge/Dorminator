<div class="col-md-12">
    <!-- Tabs -->
    <!-- Nav tabs -->
    <div class="alert alert-info">
        <p><strong>Atenție!</strong> Căminele de mai jos reprezintă toate căminele instituției din care faceți parte.</p>
    </div>
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