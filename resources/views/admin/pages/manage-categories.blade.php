@extends('admin/layouts/master')

@section('title')
Admin Panel | Manage Categories | Store My Notes
@endsection

@section('content')
<div class="panel panel-theme">
	<div class="panel-heading">
		<h3 class="panel-title">Add Category</h3>
	</div>
	<div class="panel-body">

		{!! Form::open(['route'=> 'admin.category.store', 'data-parsley-validate' => true, 'class' => 'form-horizontal']) !!}
		<div class="form-group">
			{{ Form::label('name', 'Category Name', ['class' => 'control-label col-sm-2']) }}
			<div class="col-sm-10">
				{{ Form::text('name', null, ['class' => 'form-control', 'required' => true, 'minlength' => 3]) }}
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
				{{ Form::submit('Add Category', ['class' => 'btn btn-primary']) }}
			</div>
		</div>
		{!! Form::close() !!}

	</div>
</div>
<div class="panel panel-theme">
	<div class="panel-heading">
		<h3 class="panel-title">Manage Categories</h3>
	</div>
	<div class="panel-body">
		<table class="table table-hover table-striped table-responsive">
			<thead>
				<tr>
					<th>#</th>
					<th width="20%">Category Name</th>
					<th width="40%">Category Description</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
				@php
				$i = 1;
				@endphp

				@foreach ($categories as $category)
				<tr>
					<td>{{ $i }}</td>
					<td>{{ $category->name }}</td>
					<td>{{ $category->description }}</td>
					<td>
						<a href="{{ route('admin.category.edit', $category->id) }}" class="btn btn-primary btn-sm"><i class="fa fa-edit"></i> Edit</a>

						{!! Form::open(['route' => ['admin.category.delete', $category->id], 'method' => 'DELETE', 'class' => 'form-inline']) !!}

						{{ Form::submit('Delete', ['class' => 'btn btn-danger btn-sm']) }}
						{!! Form::close() !!}


					</td>
				</tr>

				@php
				$i++;
				@endphp

				@endforeach
				

			</tbody>
		</table>
		<div class="text-center">
			{{ $categories->links() }}
		</div>
	</div>
</div>
@endsection