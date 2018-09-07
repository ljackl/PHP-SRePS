<!DOCTYPE html>
<html>
<head>
	<title>Show Sale</title>
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
                <li>
					<a href="{{URL::to('sales/'.$sale->id.'/edit')}}">Edit this Sale</a>
				</li>
			</ul>
		</nav>

        <h1>Showing Sale ID {{ $sale->id}}</h1>

        <div class="jumbotron text-center">
            <p>Item ID: {{$sale->item_id}}</p>
            <p>Item Name: {{$sale->item->name}}</p>
            <p>Sale Price: ${{$sale->sale}}</p>
            <p>Quantity Sold: {{$sale->quantity}}</p>
        </div>
	</div>
</body>
</html>
