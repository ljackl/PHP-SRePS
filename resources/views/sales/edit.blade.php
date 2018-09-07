<!DOCTYPE html>
<html>
<head>
	<title>Edit Sale</title>
	<link href="{{asset('css/app.css')}}" rel="stylesheet">
</head>
<body>
	<div class="container">
		<nav class="navbar navbar-inverse">
			<div class="navbar-header">
				<a class="navbar-brand" href="{{URL::to('sales')}}">Back to Sales</a>
			</div>
			<ul class="nav navbar-nav">
				<li>
					<a href="{{URL::to('sales/create')}}">Create a Sale</a>
				</li>
			</ul>
		</nav>

		<h1>Edit {{ $sale->id }}</h1>

		<!-- if there are creation errors, they will show here -->
		{{ HTML::ul($errors->all()) }} {{ Form::model($sale, array('route' => array('sales.update', $sale->id), 'method' => 'PUT')) }}

		<div class="form-group">
			{{ Form::label('sale', 'Sale Price') }} {{ Form::text('sale', Input::old('sale'), array('class' => 'form-control')) }}
		</div>

		<div class="form-group">
			{{ Form::label('quantity', 'Sale Quantity') }} {{ Form::text('quantity', Input::old('quantity'), array('class' => 'form-control')) }}
		</div>

		<div class="form-group">
			{{ Form::label('item_id', 'Item ID') }} {{ Form::text('item_id', Input::old('item_id'), array('class' => 'form-control')) }}
		</div>

		{{ Form::submit('Edit the Sale!', array('class' => 'btn btn-primary')) }} {{ Form::close() }}
	</div>
</body>
</html>
