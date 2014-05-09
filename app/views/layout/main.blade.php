<!DOCTYPE html>
<html>
@include('layout/shared/head')
<body>
<div class="container">
@include('layout/shared/header')

@yield('content')
	
@include('layout/shared/footer')
</div>
</body>
</html>