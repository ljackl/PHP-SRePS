<!DOCTYPE html>
<html>
<head>
	<title>Create Sale</title>
	<link href="{{asset('css/app.css')}}" rel="stylesheet">
</head>
<body>
	<div class="container">
		<nav class="navbar navbar-inverse">
			<div class="navbar-header">
				<a class="navbar-brand" href="{{URL::to('sales')}}">Back to Sales</a>
			</div>
		</nav>
		<h1>Create a Sale</h1>

		<!-- if there are creation errors, they will show here -->
		{{ HTML::ul($errors->all()) }} {{ Form::open(array('url' => 'sales')) }}

		<div class="form-group">
			{{ Form::label('sale', 'Sale Price') }} {{ Form::text('sale', Input::old('sale'), array('class' => 'form-control')) }}
		</div>

		<div class="form-group">
			{{ Form::label('quantity', 'Quantity Sold') }} {{ Form::text('quantity', Input::old('quantity'), array('class' => 'form-control')) }}
		</div>

    	<div class="form-group">
			{{ Form::label('item_id', 'Item ID') }} {{ Form::text('item_id', Input::old('item_id'), array('class' => 'form-control')) }}
		</div>

		{{ Form::submit('Create the Order!', array('class' => 'btn btn-primary')) }} {{ Form::close() }}
	</div>
</body>
</html>
