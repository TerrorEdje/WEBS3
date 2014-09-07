<!DOCTYPE html>
<html>

	<!-- Website created by Iseke -->
	
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

			@yield('content')
				
			@include('layout/footer')
		</div>
	</body>
	
</html>