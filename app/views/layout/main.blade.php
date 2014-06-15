<!DOCTYPE html>
<html>
	<head>
		@include('layout/head')
	</head>
	<body onload="showCategorys()">
		<div class="container">
			@include('layout/navigation')

			@include('layout/favorites')

			@if(Session::has('global'))
				<p>{{ Session::get('global')}}</p>
			@endif

			@yield('content')
				
			@include('layout/footer')
		</div>
	</body>
</html>