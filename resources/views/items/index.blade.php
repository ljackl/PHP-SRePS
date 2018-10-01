<!DOCTYPE html>
<html>
<head>
	<title>Items (Index)</title>
	<link href="{{asset('css/app.css')}}" rel="stylesheet">
</head>
<body>
	<div class="container">
		<nav class="navbar navbar-inverse">
			<div class="navbar-header">
				<a class="navbar-brand" href="{{URL::to('items')}}">Items</a>
			</div>
			<ul class="nav navbar-nav">
				<li>
					<a href="{{URL::to('items/create')}}">Create an Item</a>
				</li>
			</ul>
		</nav>
		<h1>All Items</h1>

		<!-- will be used to show any messages -->
		@if (Session::has('message'))
			<div class="alert alert-info">
				{{Session::get('message') }}
			</div>
		@endif

		<table class="table table-striped table-bordered">
			<thead>
				<tr>
					<th>Name</th>
					<th>Description</th>
					<th>Stock</th>
					<th>Cost</th>
					<th>Actions</th>
				</tr>
			</thead>
			<tbody>
      			@foreach($items as $key => $value)
					<tr>
						<td>{{ $value->name }}</td>
						<td>{{ $value->description }}</td>
						<td>{{ $value->stock }}</td>
						<td>${{ $value->cost }}</td>
						<td>
							<!-- show, edit, and delete buttons -->
							<a class="btn btn-small btn-success" href="{{URL::to('items/'.$value->id)}}">View</a>
							<a class="btn btn-small btn-info" href="{{URL::to('items/'.$value->id.'/edit')}}">Edit</a>
							<a class="btn btn-small btn-danger" href="{{URL::to('items/'.$value->id.'/addstock')}}">Buy Stock (5)</a>
							{{ Form::open(array('url' => 'items/' . $value->id, 'class' => 'pull-right')) }} {{ Form::hidden('_method', 'DELETE') }} {{ Form::submit('Delete', array('class' => 'btn btn-small btn-warning')) }} {{ Form::close() }}
						</td>
					</tr>
      			@endforeach
			</tbody>
		</table>
	</div>
</body>
</html>
