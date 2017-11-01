<!DOCTYPE html>
<html>
<head>
	@include ('admin.partials.admin_head')
</head>
<body>

	@include('admin.partials.admin_nav')

	
	<div class="row  page" style="margin-right: 0px">
		<div class="col-sm-3 col-md-2 hidden-xs-down bg-faded sidebar">
			@include('admin.partials.admin_left_sidebar')
		</div>
		<div class="clearfix"></div>
		<div class="col-sm-9 offset-sm-3 col-md-10 offset-md-2 pt-3 main">
			@include('admin.partials.admin_messages')
			@yield('content')

		</div>
	</div>

	@include('admin.partials.admin_scripts')
	@yield('scripts')
</body>
</html>