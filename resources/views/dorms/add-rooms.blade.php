<div class="container-fluid">
    @if ($can_insert)
        <div class="alert alert-info">
            <p><strong>Atenție!</strong> Pentru a adăuga o listă de camere este necesar să adăugați un fișier de tip xls cu datele fiecarei camere după exemplul de mai jos.</p>
            <p>Aplicația va lua datele din fișier și le va importa în felul următor:</p>
            <p>Pentru linia 2: Îi va aloca căminului cu codul "KG" camerele de la 1 la 3 inclusiv, fiecare având o capacitate de 4 persoane. În plus, va permite accesul doar studenților
                ce aparțin instituției cu codul "INFO". </p>
        </div>
        <div class="card-block text-center">
            <img src="{{URL::asset('images/xls-rooms.png')}}" class="img-fluid">
        </div>
        <div class="row">
            <div class="col-md-3">
                <a href="{{URL::asset('files/template-rooms.xlsx')}}" class="btn btn-elegant" download>Download Template</a>
            </div>
            <div class="col-md-9">
                <form method="POST" action="/upload-rooms" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{Session::token()}}">
                    <div class="file-field">
                        <div class="btn btn-elegant btn-sm">
                            <span>Alege fișierul</span>
                            <input type="file" name="roomTemplate" onchange="this.form.submit();">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text" placeholder="Urcă fișierul cu camere">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @else
        <div class="alert alert-danger">
            <strong>Atenție!</strong> Pentru a adăuga camere trebuie să existe minim un cămin în sistem.
        </div>
    @endif
</div>