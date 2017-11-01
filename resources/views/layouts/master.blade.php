<!DOCTYPE html>
<html>
<head>
	@include ('partials.head')
</head>
<body>

	@include('partials.nav')

	<div class="container">
		<div class="page">
			@yield('content')
		</div>
		
	</div>
	@include('partials.footer_bottom')
	@include('partials.scripts')
	@yield('scripts')
</body>
</html>