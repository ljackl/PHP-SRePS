<!DOCTYPE html>
<html>
<head>
	<title>Show Item</title>
	<link href="{{asset('css/app.css')}}" rel="stylesheet">
</head>
<body>
	<div class="container">
		<nav class="navbar navbar-inverse">
			<div class="navbar-header">
				<a class="navbar-brand" href="{{URL::to('items')}}">Items Alert</a>
			</div>
			<ul class="nav navbar-nav">
				<li>
					<a href="{{URL::to('items')}}">View All Items</a>
				</li>
				<li>
					<a href="{{URL::to('items/create')}}">Create an Item</a>
				</li>
			</ul>
		</nav>
		<h1>Showing {{ $item->name }}</h1>
		<div class="jumbotron text-center">
			<p>Description: {{ $item->description }}</p>
			<p>Stock: {{ $item->stock }}</p>
			<p>Cost: ${{ $item->cost }}</p>
		</div>
	</div>
</body>
</html>
