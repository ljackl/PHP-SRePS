<!DOCTYPE html>
<html>
  <head>
    <title>Sales (Index)</title>
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
  </head>
  <body>
    <div class="container">

      <nav class="navbar navbar-inverse">
        <div class="navbar-header">
          <a class="navbar-brand" href="{{URL::to('sales')}}">Sales Alert</a>
        </div>

          <a href="{{URL::to('sales/create')}}">Create a Sale</a>
        </li>
      </ul>

      </nav>

      <h1>All the Sales</h1>
      <!--will be used to show any messages -->
      @if (Session::has('message'))
        <div class="alert alert-info">{{Session::get('message')}}</div>
      @endif

      <table class"table table-striped table-bordered">
        <thead>
          <tr>
            <th>Item ID</th>
            <th>Sale Price</th>
            <th>Quantity Sold</th>
          </tr>
        </thead>
        <tbody>
          @foreach($sales as $key => $value)
            <tr>
              <td>{{$value->item_id}}</td>
              <td>{{$value->sale}}</td>
              <td>{{$value->quantity}}</td>
              <!--add show,edit, and delete buttons -->
              <td><!--delete sales button?--></td>
              <td><!--show the order-->
                  <a class ="btn btn-small btn-success" href="{{URL::to('sales/'.$value->id)}}">
                    Show this Order
                  </a>
                  {{ Form::open(array('url' => 'sales/' . $value->id, 'class' => 'pull-right')) }} {{ Form::hidden('_method', 'DELETE') }} {{ Form::submit('Delete', array('class' => 'btn btn-small btn-warning')) }} {{ Form::close() }}
              </td>
              <td>
                <a class="btn btn-small btn-info" href="{{ URL::to('sales/' . $value->id . '/edit') }}">Edit this Sale</a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </body>
</html>
