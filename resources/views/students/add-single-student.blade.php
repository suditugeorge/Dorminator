<div class="container-fluid">
    @if ($can_insert)
        <div class="alert alert-warning">
            <p><strong>Atenție!</strong> Dacă nu se cunoaște adresa de email a candidatului se va genera una automat și îi va cere acestuia să o schimbe la primul login.</p>
            <p>Câmpurile marcate cu * sunt obligatorii!</p>
        </div>
    @else
        <div class="alert alert-danger">
            <strong>Atenție!</strong> Pentru a adăuga studenți trebuie să existe minim o instituție de învățământ.
        </div>
    @endif
</div>
<br />
<div class="container-fluid">
    <div class="container">
        <!-- Form contact -->
        <form>
            <p class="h5 text-center mb-4">Student Nou</p>

            <div class="md-form">
                <i class="fa fa-user prefix grey-text"></i>
                <input type="text" class="form-control" id="student-name">
                <label for="student-name">Nume student *</label>
            </div>
            <div class="md-form">
                <i class="fa fa-graduation-cap prefix grey-text"></i>
                <input type="text" class="form-control" id="student-grade">
                <label for="student-grade">Notă concurs *</label>
            </div>
            <div class="md-form">
                <i class="fa fa-address-book-o prefix grey-text"></i>
                <input type="text" class="form-control" id="student-cnp">
                <label for="student-cnp">Cod numeric personal</label>
            </div>
            <div class="md-form">
                <i class="fa fa-phone prefix grey-text"></i>
                <input type="text" class="form-control" id="student-phone">
                <label for="student-phone">Telefon</label>
            </div>

            <div class="row">
                <div class="col-sm-6">
                    <div class="form-group">
                        <input name="group1" type="radio" id="student-female" checked="checked">
                        <label for="student-female">Sex feminin</label>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <input name="group1" type="radio" id="student-male">
                        <label for="student-male">Sex masculin</label>
                    </div>
                </div>
            </div>

            <div class="md-form">
                <i class="fa fa-user prefix grey-text"></i>
                <input type="text" class="form-control" id="student-email">
                <label for="student-email">Email</label>
            </div>

            <div class="md-form">
                <i class="fa fa-code prefix grey-text"></i>
                <input type="text" class="form-control" id="student-code">
                <label for="student-code">Cod instituție *</label>
            </div>
            @if ($can_insert)
                <div class="text-center">
                    <button class="btn btn-unique" id="send-student">Adaugă student <i class="fa fa-paper-plane-o ml-1"></i></button>
                </div>
            @else
                <div class="text-center">
                    <button class="btn btn-unique disabled" id="send-student" disabled>Adaugă student <i class="fa fa-paper-plane-o ml-1"></i></button>
                </div>
            @endif
            <div class="text-center spinner-wrap hidden">
                <i class="fa fa-spinner fa-pulse fa-5x fa-fw"></i>
            </div>
        </form>
        <!-- Form contact -->
    </div>
    <br />

</div>