<div class="container-fluid">
    @if ($can_insert)
        <div class="alert alert-warning">
            <p><strong>Atenție!</strong> Dacă nu se cunoaște adresa de email a candidatului se va genera una automat și îi va cere acestuia să o schimbe la primul login.</p>
        </div>
        <div class="alert alert-info">
            <p><strong>Atenție!</strong> Pentru a adăuga o listă de studenți este necesar să adăugați un fișier de tip xls cu datele fiecarui student după exemplul de mai jos.</p>
        </div>
        <div class="card-block text-center">
            <img src="{{URL::asset('images/xls-exemple.png')}}" class="img-fluid">
        </div>
        <div class="row">
            <div class="col-md-3">
                <a href="{{URL::asset('files/template-students.xlsx')}}" class="btn btn-elegant" download>Download Template</a>
            </div>
            <div class="col-md-9">
                <form method="POST" action="/upload-students" enctype="multipart/form-data">
                    <input type="hidden" name="_token" value="{{Session::token()}}">
                    <div class="file-field">
                        <div class="btn btn-elegant btn-sm">
                            <span>Alege fișierul</span>
                            <input type="file" name="studentTemplate" onchange="this.form.submit();">
                        </div>
                        <div class="file-path-wrapper">
                            <input class="file-path validate" type="text" placeholder="Urcă fișierul cu studenți">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    @else
        <div class="alert alert-danger">
            <strong>Atenție!</strong> Pentru a adăuga studenți trebuie să existe minim o instituție de învățământ.
        </div>
    @endif
</div>