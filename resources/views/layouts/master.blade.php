<!DOCTYPE HTML>
<html>
	<head>
		<title>@yield('title') - Dorminator</title>
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	    <meta http-equiv="x-ua-compatible" content="ie=edge">

	    <link rel="stylesheet" href="{{ URL::asset('css/layout/font-awesome.min.css') }}" />
		<link rel="stylesheet" href="{{ URL::asset('css/layout/bootstrap.min.css') }}" />
		<link rel="stylesheet" href="{{ URL::asset('css/layout/mdb.css') }}" />
		<link rel="stylesheet" href="{{ URL::asset('css/layout/toastr.css') }}" />
		
		@yield('styles')
		{{--<script src='https://www.google.com/recaptcha/api.js'></script> --}}
</head>

<body class="fixed-sn black-skin">
<input type="hidden" name="_token" value="{{Session::token()}}">
@yield('content')
<script type="text/javascript" src="{{ URL::asset('js/layout/jquery-3.1.1.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/layout/tether.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/layout/bootstrap.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/layout/mdb.min.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/layout/toastr.js') }}"></script>
<script type="text/javascript" src="{{ URL::asset('js/main.js') }}"></script>
@yield('scripts')
</body>
</html>