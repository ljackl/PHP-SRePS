<!DOCTYPE html>
<html>
<head>
	<title>Add Item</title>
	<link href="{{asset('css/app.css')}}" rel="stylesheet">
</head>
<body>
	<div class="container">
		<nav class="navbar navbar-inverse">
			<div class="navbar-header">
				<a class="navbar-brand" href="{{URL::to('items')}}">Back to Items</a>
			</div>
			<ul class="nav navbar-nav">
				<li>
					<a href="{{URL::to('items/create')}}">Create a Item</a>
				</li>
			</ul>
		</nav>

		<h1>Add stock to {{ $item->name }}</h1>

		<!-- if there are creation errors, they will show here -->
		{{ HTML::ul($errors->all()) }} {{ Form::model($item, array('route' => array('items.update', $item->id), 'method' => 'PUT')) }}

		<div class="form-group">
			{{ Form::label('stock', 'Item Stock') }} {{ Form::text('stock', Input::old('stock'), array('class' => 'form-control')) }}
		</div>


		{{ Form::submit('Add stock to the Item!', array('class' => 'btn btn-primary')) }} {{ Form::close() }}
	</div>
</body>
</html>
