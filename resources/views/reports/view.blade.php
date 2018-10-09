<!DOCTYPE html>
<html>
<head>
	<title>Sales Report</title>
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

		@if ($topSold != null)
			<h1>Top 5 Selling Items</h1>
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>Item ID</th>
						<th>Quantity Sold</th>
					</tr>
				</thead>
				<tbody>
					@foreach($topSold as $key => $value)
						<tr>
							<td><a href="{{URL::to('items/'.$key)}}">{{$key}}</a></td>
							<td>{{$value}}</td>
						</tr>
					@endforeach
				</tbody>
			</table>

			</br>

		<h1>All Sales For Selected Item and Time Period</h1>
		<table class="table table-striped table-bordered">
			<thead>
				<tr>
					<th>Sale ID</th>
                    <th>Item Name</th>
                    <th>Sale Price</th>
                    <th>Quantity Sold</th>
                    <th>Date</th>
				</tr>
			</thead>
			<tbody>
      			@foreach($sales as $key => $value)
					<tr>
                        <td>{{$value->id}}</td>
                        <td>{{$value->item->name}}</td>
                        <td>${{$value->sale}}</td>
                        <td>{{$value->quantity}}</td>
                        <td>{{$value->created_at}}</td>
					</tr>
      			@endforeach
			</tbody>
		</table>

		</br>
		@endif

		@if ($topSold == null)
			<h1>Estimated Sales For Next Similar Time Period</h1>
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>Item ID</th>
						<th>Estimated Sale Quantity</th>
					</tr>
				</thead>
				<tbody>
					@foreach($estSales as $key => $value)
						<tr>
							<td><a href="{{URL::to('items/'.$key)}}">{{$key}}</a></td>
							<td>{{$value}}</td>
						</tr>
					@endforeach
				</tbody>
			</table>
		@endif
	</div>
</body>
</html>
