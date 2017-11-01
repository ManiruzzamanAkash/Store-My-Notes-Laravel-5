@extends('admin/layouts/master')

@section('title')
Admin Panel | Edit Category | Store My Notes
@endsection

@section('content')
<div class="panel panel-theme">
	<div class="panel-heading">
		<h3 class="panel-title">Edit Category</h3>
	</div>
	<div class="panel-body">
		{!! Form::model($category, ['route'=> ['admin.category.update', $category->id],'method'=>'PUT', 'data-parsley-validate' => true, 'class' => 'form-horizontal']) !!}

		<div class="form-group">
			{{ Form::label('category_name', 'Category Name', ['class' => 'control-label col-sm-2']) }}
			<div class="col-sm-10">
				{{ Form::text('name', null, ['class' => 'form-control', 'required' => true]) }}
			</div>
		</div>
		<div class="form-group">
			{{ Form::label('description', 'Category Description', ['class' => 'control-label col-sm-2']) }}
			<div class="col-sm-10">
				{{ Form::textarea('description', null, ['rows' => 5, 'class' => 'form-control', 'minlength' => 10]) }}
			</div>
		</div>

		<div class="form-group">
			<div class="col-sm-offset-2 col-sm-10">
				{{ Form::submit('Update', ['class' => 'btn btn-primary']) }}
			</div>
		</div>
		{!! Form::close() !!}
	</div>
</div>
@endsection