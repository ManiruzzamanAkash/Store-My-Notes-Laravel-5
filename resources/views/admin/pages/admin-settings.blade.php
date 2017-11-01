@extends('admin/layouts/master')

@section('title')
Admin Panel | Settings | Store My Notes
@endsection

@section('content')
<div class="panel panel-theme">
	<div class="panel-heading">
		<h3 class="panel-title pull-left">Settings Page</h3>
		<span class="pull-right">Last updated {{ $settings->updated_at }}</span>
		<div class="clearfix"></div>
	</div>
	<div class="panel-body">

		{!! Form::model($settings, ['route' => 'admin.settings.update', 'method'=>'PUT', 'files'=>true, 'class' => 'form-horizontal', 'data-parsley-validate' => true]) !!}


		<div class="form-group">
			{{ Form::label('site_title', 'Site Title', ['class' => 'control-label col-sm-3']) }}
			<div class="col-sm-8">
				{{ Form::text('site_title', null, ['class' => 'form-control', 'required' => true, 'minlength' => 3]) }}
			</div>
		</div>

		<div class="form-group">
			{{ Form::label('site_description', 'Site Description', ['class' => 'control-label col-sm-3']) }}
			<div class="col-sm-8">
				{{ Form::textarea('site_description', null, ['rows' => 5, 'class' => 'form-control', 'minlength' => 10]) }}
			</div>
		</div>


		<div class="form-group">
			{{ Form::label('site_description_visible', 'Show Site Description in Main Page', ['class' => 'control-label col-sm-3']) }}
			<div class="col-sm-8">
				<label class="switch ">
					@if ($settings->site_description_visible == 1)
					<input type="checkbox" name="site_description_visible" value="1" checked>
					@else
					<input type="checkbox" name="site_description_visible" value="0">
					@endif
					<div class="slider round"></div>
				</label>
			</div>
		</div>

		<div class="form-group">
			{{ Form::label('site_prev_logo', 'Site Previous Favicon/logo', ['class' => 'control-label col-sm-3']) }}
			<div class="col-sm-8">
				<img src="{{ URL::to("images/$settings->site_logo") }}" class="img img-thumbnail img-responsive" style="width: 200px">
			</div>
		</div>
		<div class="form-group">
			{{ Form::label('site_logo', 'Change Site Favicon/logo', ['class' => 'control-label col-sm-3']) }}
			<div class="col-sm-8">
				{{ Form::file('site_logo',['class' => 'form-control']) }}
			</div>
		</div>

		<div class="form-group">
			{{ Form::label('home_min_note', 'Minimum Note in HomePage', ['class' => 'control-label col-sm-3']) }}
			<div class="col-sm-8">
				{{ Form::number('home_min_note', null, ['class' => 'form-control', 'required' => true, 'min' => 1]) }}
			</div>
		</div>

		<hr />
		<div class="form-group">
			{{ Form::label('site_meta_keywords', 'Site Meta Keywords', ['class' => 'control-label col-sm-3']) }}
			<div class="col-sm-8">
				{{ Form::text('site_meta_keywords', null, ['class' => 'form-control', 'required' => true, 'minlength' => 3]) }}
			</div>
		</div>

		<div class="form-group">
			{{ Form::label('site_meta_description', 'Site Meta Description', ['class' => 'control-label col-sm-3']) }}
			<div class="col-sm-8">
				{{ Form::textarea('site_meta_description', null, ['rows' => 5, 'class' => 'form-control', 'minlength' => 10]) }}
			</div>
		</div>


		<div class="form-group">
			<div class="col-sm-offset-3 col-sm-8">
				{{ Form::submit('Save Settings', ['class' => 'btn btn-theme']) }}
			</div>
		</div>
		{!! Form::close() !!}
	</div>
</div>
@endsection