<!DOCTYPE html>
<html>
	@include('layout/head')
	<body>
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