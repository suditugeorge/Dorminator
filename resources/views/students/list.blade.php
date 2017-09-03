<div class="container">
    <!-- First row -->
    <div class="alert alert-info">
        <div class="row">
            <div class="col-md-9">
                <p><strong>Atenție!</strong> Pentru a descarca lista de studenți ce au nevoie de schimbare de parolă vă rugăm să dați click pe buton.</p>
            </div>
            <div class="col-md-3">
                <a href="/get-students-pdf" class="btn btn-elegant">PDF Studenți</a>
            </div>
        </div>
    </div>
    <div class="row">
        <!-- First column -->
        <div class="col-md-12">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th>Nume</th>
                        <th>Notă concurs</th>
                        <th>CNP</th>
                        <th>Telefon</th>
                        <th>Sex</th>
                        <th>Cod universitate</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach ($students as $student)
                        <tr>
                            <th scope="row">{{$student->id}}</th>
                            <td>{{$student->name}}</td>
                            <td>{{$student->grade}}</td>
                            <td>{{$student->cnp}}</td>
                            <td>{{$student->phone}}</td>
                            <td>{{$student->sex}}</td>
                            <td>{{$student->institution_code}}</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            {{$students->links('layouts.pagination')}}
        </div>
        <!-- /.First column -->
    </div>
    <!-- /.First row -->
</div>
<!--/Pagination -->