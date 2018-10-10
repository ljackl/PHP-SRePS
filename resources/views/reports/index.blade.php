<!DOCTYPE html>
<html>
<head>
	<title>Sales Reports</title>
	<link href="{{asset('css/app.css')}}" rel="stylesheet">
</head>
<body>
	<div class="container">
		<nav class="navbar navbar-inverse">
			<div class="navbar-header">
				<a class="navbar-brand" href="{{URL::to('/')}}">Back to Home</a>
			</div>
		</nav>

		<!-- will be used to show any messages -->
		@if (Session::has('message'))
			<div class="alert alert-info">
				{{Session::get('message') }}
			</div>
		@endif

		{{ HTML::ul($errors->all()) }}

		<h1>View general report</h1>
		<div class="jumbotron text-center">
			{{ Form::open(array('url' => 'reports/view', 'class' => 'pull-right')) }}
				{{ Form::label('select_from', 'Select From') }}
				{{ Form::date('select_from', null, array('class' => 'form-control')) }}

				{{ Form::label('select_to', 'Select To') }}
				{{ Form::date('select_to', null, array('class' => 'form-control')) }}

				</br>

				{{ Form::submit('Go', array('class' => 'btn btn-small btn-block btn-info')) }}
			{{ Form::close() }}
		</div>

		<h1>Predict sales for single item</h1>
		<div class="jumbotron text-center">
			{{ Form::open(array('url' => 'reports/predict', 'class' => 'pull-right')) }}
				{{ Form::label('item_id', 'Item') }}
			    {{ Form::select('item_id', $itemid, null, ['class' => 'form-control']) }}

				{{ Form::label('select_from', 'Select From') }}
				{{ Form::date('select_from', null, array('class' => 'form-control')) }}

				{{ Form::label('select_to', 'Select To') }}
				{{ Form::date('select_to', null, array('class' => 'form-control')) }}

				</br>

				{{ Form::submit('Go', array('class' => 'btn btn-small btn-block btn-info')) }}
			{{ Form::close() }}
		</div>

		<h1>Predict sales for an item category</h1>
		<div class="jumbotron text-center">
			{{ Form::open(array('url' => 'reports/predictCat', 'class' => 'pull-right')) }}
				{{ Form::label('category', 'Category') }}
				{{ Form::select('category', $category, null, ['class' => 'form-control']) }}

				{{ Form::label('select_from', 'Select From') }}
				{{ Form::date('select_from', null, array('class' => 'form-control')) }}

				{{ Form::label('select_to', 'Select To') }}
				{{ Form::date('select_to', null, array('class' => 'form-control')) }}

				</br>

				{{ Form::submit('Go', array('class' => 'btn btn-small btn-block btn-info')) }}
			{{ Form::close() }}
		</div>

		<h1>Export CSV</h1>
		<div class="jumbotron text-center">
			{{ Form::open(array('url' => 'reports/csv', 'class' => 'pull-right')) }}
				{{ Form::label('select_from', 'Select From') }}
				{{ Form::date('select_from', null, array('class' => 'form-control')) }}

				{{ Form::label('select_to', 'Select To') }}
				{{ Form::date('select_to', null, array('class' => 'form-control')) }}

				</br>

				{{ Form::submit('Download Sales', array('class' => 'btn btn-small btn-block btn-info')) }}
			{{ Form::close() }}
		</div>
	</div>
</body>
</html>
