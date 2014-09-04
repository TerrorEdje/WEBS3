<!DOCTYPE html>
<html>

	<!-- Edwin Hattink en Jip Verhoeven -->
	
	<head>
		@include('layout/head')
	</head>
	
	<!-- Toont alle onderdelen van een pagina -->
	<body onload="showCategorys()">
		<div class="container">
			@include('layout/navigation')

			@if(Session::has('global'))
				<p>{{ Session::get('global')}}</p>
			@endif

			@if(isset($breadcrumbs))
				{{ $breadcrumbs }}
			@endif
			

			@yield('content')
				
			@include('layout/footer')
		</div>
	</body>
	
</html>