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
				<a class="navbar-brand" href="{{URL::to('items')}}">Back to Items</a>
			</div>
			<ul class="nav navbar-nav">
				<li>
					<a href="{{URL::to('items/create')}}">Create an Item</a>
				</li>
				<li>
					<a href="{{URL::to('items/'.$item->id.'/edit')}}">Edit this Item</a>
				</li>
			</ul>
		</nav>

		<h1>Showing Item {{ $item->name }}</h1>
		<div class="jumbotron text-center">
			<p>Category: {{ $item->category }}</p>
			<p>Description: {{ $item->description }}</p>
			<p>Stock: {{ $item->stock }}</p>
			<p>Cost: ${{ $item->cost }}</p>
		</div>

		<h1>Sales</h1>
		<table class="table table-striped table-bordered">
			<thead>
				<tr>
					<th>Sale ID</th>
                    <th>Sale Price</th>
                    <th>Quantity Sold</th>
                    <th>Date</th>
				</tr>
			</thead>
			<tbody>
      			@foreach($item->sales as $key => $value)
					<tr>
                        <td><a href="{{URL::to('sales/'.$value->id)}}">{{$value->id}}</a></td>
                        <td>${{$value->sale}}</td>
                        <td>{{$value->quantity}}</td>
                        <td>{{$value->created_at}}</td>
					</tr>
      			@endforeach
			</tbody>
		</table>
	</div>
</body>
</html>
