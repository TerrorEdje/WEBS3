<!DOCTYPE html>
<html>
@include('layout/shared/head')
<body>
<div class="container">
@include('layout/shared/header')

@if(Session::has('global'))
	<p>{{ Session::get('global')}}</p>
@endif

@yield('content')
	
@include('layout/shared/footer')
</div>
</body>
</html>