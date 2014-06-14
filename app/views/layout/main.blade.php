<!DOCTYPE html>
<html>
	<head>
		@include('layout/head')
	</head>
	<body onload="showCategorys()">
		<div class="container">
			@include('layout/navigation')

			<div id="favorites" class="favorites">

			</div>

			@if(Session::has('global'))
				<p>{{ Session::get('global')}}</p>
			@endif

			@yield('content')
				
			@include('layout/footer')
		</div>
	</body>
</html>