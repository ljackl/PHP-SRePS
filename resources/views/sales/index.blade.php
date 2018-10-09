<!DOCTYPE html>
<html>
<head>
	<title>Sales (Index)</title>
	<link href="{{asset('css/app.css')}}" rel="stylesheet">
</head>
<body>
	<div class="container">
		<nav class="navbar navbar-inverse">
			<div class="navbar-header">
				<a class="navbar-brand" href="{{URL::to('/')}}">Back to Home</a>
			</div>
			<ul class="nav navbar-nav">
				<li>
					<a href="{{URL::to('items')}}">Items</a>
				</li>
				<li>
					<a href="{{URL::to('sales/create')}}">Create a Sale</a>
				</li>
			</ul>
		</nav>

		<!-- will be used to show any messages -->
		@if (Session::has('message'))
			<div class="alert alert-info">
				{{Session::get('message') }}
			</div>
		@endif

		<h1>All Sales</h1>
		<table class="table table-striped table-bordered">
			<thead>
				<tr>
					<th>Sale ID</th>
                    <th>Item Name</th>
                    <th>Sale Price</th>
                    <th>Quantity Sold</th>
                    <th>Date</th>
					<th>Actions</th>
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
						<td>
							<!-- show, edit, and delete buttons -->
							<a class="btn btn-small btn-block btn-primary" href="{{URL::to('sales/'.$value->id)}}">View</a>
							<a class="btn btn-small btn-block btn-secondary" href="{{URL::to('sales/'.$value->id.'/edit')}}">Edit</a>
							{{ Form::open(array('url' => 'sales/' . $value->id, 'class' => 'pull-right')) }}
								{{ Form::hidden('_method', 'DELETE') }}
								{{ Form::submit('Delete', array('class' => 'btn btn-small btn-block btn-warning')) }}
							{{ Form::close() }}
						</td>
					</tr>
      			@endforeach
			</tbody>
		</table>
	</div>
</body>
</html>
