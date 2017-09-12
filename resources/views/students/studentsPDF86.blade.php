<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title></title>
    <link href='http://fonts.googleapis.com/css?family=Roboto+Condensed:400,300,700&subset=latin,latin-ext' rel='stylesheet' type='text/css'>
    <style>
        .page {
            width: 210mm;
            height: 297mm;
            padding: 4.85mm 7.5mm;
            page-break-after: always;
        }
        body {
            width: 210mm;
            margin: 0mm;
            padding: 0mm;
            font-family: Arial;
            font-size: 8pt;
        }
        * {
            box-sizing: border-box;
        }
        .lbl {
            width: 48.5mm;
            height: 16.9mm;
            padding: 1mm;
            padding-bottom: 10em;
            float: left;
            overflow: hidden;
        }
        .pb {
            width: 100%;
            text-align: left;
            float: left;
            font-size: 9pt;
            border-bottom: 0.2mm solid black;
            padding-bottom: 0.5mm;
            margin-bottom: 0.5mm;
        }
        .bc {
            float: left;
            width: 100%;
            text-align: center;
        }
        .ttl {
            margin-bottom: 3mm;
        }
    </style>
</head>
<body>
<div class="page">
    @foreach($students as $i => $student)
        <div class="lbl">
            <div class="pb">
                Nume: <b>{{$student->contact()->get()[0]->name}}</b>
            </div>
            <div class="ttl">
                Username: {{trim($student->username)}}<br/>
                Parolă: {{$student->username}}
            </div>
        </div>
        @if($i != 0 && $i%68 == 0)
            </div><div class="page">
        @endif
    @endforeach
</div>
</body>

</html>