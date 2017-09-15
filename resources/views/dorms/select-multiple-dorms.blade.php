<div class="col-md-12">
    @if($has_been_accepted)
        <div class="alert alert-success">
            <p><strong>FELICITĂRI!</strong> Căminul în care ați intrat este {{$main_dorm->name}}.</p>
        </div>
    @elseif($db_stat->end)
        <div class="alert alert-error">
            <p><strong>Ne pare rău!</strong> Din păcate nu ați reușit să intrați într-un cămin.<br/>Dacă aveți întrebări vă rugăm să ne contactați telefonic.</p>
        </div>
    @elseif($has_applied)
        <div class="alert alert-success">
            <p>Ați aplicat cu succes pentru un loc în cămin.<br/>Imediat cum aplicarea este procesată veți primi email și un mesaj în aplicație.<br/>
                Pentru a evita posibilele întârzieri alea emailului vă rugăm să accesați secțiunea "Mesaje" cât mai des.<br/>Căminele afișate ca opțiune sunt reprezentate de acelea
                la care mai puteți aplica.
            </p>
        </div>
    @elseif(!$db_stat->end && !$db_stat->can_operate)
        <div class="alert alert-error">
            <p><strong>Ne pare rău!</strong> Din păcate aplicația este în procesul de sortare.<br/>Vă vom anunța când aceasta este gata printr-un mesaj în aplicație. Din acest motiv vă rugăm să accesați secțiunea "Mesaje" cât mai des.</p>
        </div>
    @else
        <div class="alert alert-info">
            <p><strong>Atenție!</strong> Căminul selectat vă reprezenta opțiunea dumneavoastră. Dacă nu vi se va aproba selecția veți primi email și un mesaj în aplicație.<br/>
                Pentru a evita posibilele întârzieri alea emailului vă rugăm să accesați secțiunea "Mesaje" cât mai des.<br/>Căminele afișate ca opțiune sunt reprezentate de acelea
                la care mai puteți aplica.</p>
        </div>
        @foreach($dorms_can_apply as $d)
            <select class="mdb-select dorm-select">
                <option value="" disabled selected>Alege unul dintre cămine</option>
                @foreach($dorms_can_apply as $dorm)
                    <option value="{{$dorm->code}}">{{$dorm->name}}</option>
                @endforeach
            </select>
        @endforeach
        <a href="#" class="btn btn-elegant" id="pick-multiple-dorms">Alege cămin</a>
        <div class="text-center spinner-wrap hidden">
            <i class="fa fa-spinner fa-pulse fa-5x fa-fw"></i>
        </div>
    @endif
</div>