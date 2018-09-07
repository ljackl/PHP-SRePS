<?php

namespace App\Http\Controllers;

use App\Sale;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;
use Validator;
use Input;
use Session;
use Redirect;

class SalesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //retrieve all Sales
        $sales = Sale::all();

        //Load the view and pass the orders
        return View::make ('sales.index')->with('sales', $sales);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('sales.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(Request $request)
 {
   // Validate
   // Read more on validation at http://laravel.com/docs/validation
   $rules = array(
     'sale' => 'required|numeric',
     'quantity' => 'required|numeric',
     'item_id' => 'required|numeric',
   );
   $validator = Validator::make(Input::all(), $rules);

   if ($validator->fails()) {
     return Redirect::to('orders/create')
       ->withErrors($validator)
       ->withInput(Input::except('password'));
   } else {
     $sale = new Sale;
     $sale->sale = Input::get('sale');
     $sale->quantity = Input::get('quantity');
     $sale->created_at = Carbon::now();
     $sale->item_id = Input::get('item_id');
     $sale->save();

     // redirect
     Session::flash('message', 'Successfully created sale!');
     return Redirect::to('sales');
   }
 }





    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //retrieve order based on id
        $sales = Sale::find($id);

        //show the view and pass the sale info to it
        return View::make('sales.show')->with('sales', $sales);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sale = Sale::find($id);
        return View::make('sales.edit')->with('sale', $sale);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = $request->validated();

        $sale = Sale::find($id);
        $sale->sale = Input::get('sale');
        $sale->quantity = Input::get('quantity');
        $sale->item_id = Input::get('item_id');
        $sale->updated_at = Carbon::now();
        $item->save();

        // redirect
        Session::flash('message', 'Successfully updated!');
        return Redirect::to('sales');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sale = Sale::find($id);
        $sale->delete();

        // redirect
        Session::flash('message', 'Successfully deleted!');
        return Redirect::to('sales');
    }
}
