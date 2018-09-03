<!DOCTYPE html>
<html>
  <head>
    <title>Show Order</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
  </head>
  <body>
    <div class="container">

    <nav class="navbar navbar-inverse">
        <div class="navbar-header">
          <a class="navbar-brand" href="{{URL::to('sales')}}">Sales Alert</a>
        </div>
        <ul class="nav navbar-nav">
          <li><a href="{{URL::to('sales')}}">View All Sales</a></li>
        </ul>
    </nav>

    <h1>Showing {{ $sales->item_id}}</h1>
      <div class="jumbotron text-center">
        <p>Item ID: {{$sales->item_id}}</p>
        <p>Sale Price: {{$sales->sale}}</p>
        <p>Quantity Sold: {{$sales->quantity}}</p>
      </div>
    </div>
  </body>
</html>
