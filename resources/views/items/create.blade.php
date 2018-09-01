<!DOCTYPE html>
<html>
<head>
	<title>Create Item</title>
	<link href="{{asset('css/app.css')}}" rel="stylesheet">
</head>
<body>
	<div class="container">
		<nav class="navbar navbar-inverse">
			<div class="navbar-header">
				<a class="navbar-brand" href="{{URL::to('items')}}">Item Alert</a>
			</div>
			<ul class="nav navbar-nav">
				<li>
					<a href="{{URL::to('items')}}">View All Items</a>
				</li>
				<li>
					<a href="{{URL::to('items/create')}}">Create a Item</a>
				</li>
			</ul>
		</nav>
		<h1>Create an Item</h1>

		<!-- if there are creation errors, they will show here -->
		{{ HTML::ul($errors->all()) }} {{ Form::open(array('url' => 'items')) }}

		<div class="form-group">
			{{ Form::label('name', 'Item Name') }} {{ Form::text('name', Input::old('name'), array('class' => 'form-control')) }}
		</div>

		<div class="form-group">
			{{ Form::label('description', 'Item Description') }} {{ Form::text('description', Input::old('description'), array('class' => 'form-control')) }}
		</div>

		<div class="form-group">
			{{ Form::label('stock', 'Item Stock') }} {{ Form::text('stock', Input::old('stock'), array('class' => 'form-control')) }}
		</div>

		<div class="form-group">
			{{ Form::label('cost', 'Item Cost') }} {{ Form::text('cost', Input::old('cost'), array('class' => 'form-control')) }}
		</div>

		{{ Form::submit('Create the Item!', array('class' => 'btn btn-primary')) }} {{ Form::close() }}
	</div>
</body>
</html>
