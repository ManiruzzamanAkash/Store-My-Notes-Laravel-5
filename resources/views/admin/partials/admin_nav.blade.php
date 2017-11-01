<header>
	<div class="header-main">
		<nav class="navbar navbar-default navbar-fixed-top" role="navigation">
			<div class="container">
				<!-- Brand and toggle get grouped for better mobile display -->
				<div class="navbar-header">
					<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="./"><img src="{{ URL::to('images/logo.png') }}" alt="Store My Notes" class="img logo-image" ></a>
				</div>

				<!-- Collect the nav links, forms, and other content for toggling -->
				<div class="collapse navbar-collapse navbar-ex1-collapse">
					<ul class="nav navbar-nav">
						<li class="{{ Request::is('/') ? "active" : "" }}">
							<a href="{{ route('admin.dashboard') }}">Admin Panel</a>
						</li>
						
					</ul>

					<ul class="nav navbar-nav navbar-right">
						<li><form class="navbar-form " role="search">
							<div class="form-group">
								<input type="text" class="form-control" placeholder="Search">
							</div>
						</form>
					</li>
					<li class="dropdown notification">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
							<i class="fa fa-bell"><span class="badge">{{$admin_notifications->count()}}</span></i>
						</a>

						<ul class="dropdown-menu notification" role="menu">
							@foreach ($admin_notifications as $notification)
								<li><a href="{{ route('admin.notification.single', $notification->id) }}">Notification From {{ $notification->email }}</a></li>
							@endforeach
							<li><a href="{{ route('admin.notifications') }}" style="color: green;">See More Notifications</a></li>
							
						</ul>
					</li>


					<li class="dropdown">
						<a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">
							{{ Auth::user()->name }} <span class="caret"></span>
						</a>

						<ul class="dropdown-menu" role="menu">
							<li>
								<a href="{{ route('admin.logout') }}"
								onclick="event.preventDefault();
								document.getElementById('logout-form').submit();">
								Logout
							</a>

							<form id="logout-form" action="{{ route('admin.logout') }}" method="POST" style="display: none;">
								{{ csrf_field() }}
							</form>
						</li>
					</ul>
				</li>

			</ul>
		</div><!-- /.navbar-collapse -->
	</div>
</nav>
</div> <!-- End Header Main -->
</header>