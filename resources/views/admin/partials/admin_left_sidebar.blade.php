<nav class="left-sidebar-full">
	<ul>
		<a href="{{ route('admin.dashboard') }}"><li class="{{ Request::is('admin') ? "active" : "" }}"><i class="fa fa-dashboard"></i> Dashboard</li></a>
		<a href="{{ route('admin.notifications') }}"><li class="{{ Request::is('admin/notifications') ? "active" : "" }}"><i class="fa fa-bell"></i> Notifications <span class="badge">{{$admin_notifications->count()}}</li></a>

		<a href="{{ route('admin.manage_users') }}"><li class="{{ Request::is('admin/manage-users') ? "active" : "" }}"><i class="fa fa-user"></i> Manage Users</li></a>
		<a href="{{ route('admin.manage_notes') }}"><li class="{{ Request::is('admin/manage-notes')? 'active' : ' '}}"><i class="fa fa-sticky-note"></i> Manage Notes</li></a>
		<a href="{{ route('admin.manage_categories') }}"><li class="{{ Request::is('admin/manage-categories') ? "active" : "" }}"><i class="fa fa-tasks"></i> Manage Categories</li></a>
		<a href="{{ route('admin.manage_tags') }}"><li class="{{ Request::is('admin/manage-tags') ? "active" : "" }}"><i class="fa fa-tags"></i> Manage Tags</li></a>
		<a href="{{ route('admin.settings') }}"><li class="{{ Request::is('admin/settings') ? "active" : "" }}"><i class="fa fa-cog"></i> Settings</li></a>
	</ul>
</nav>