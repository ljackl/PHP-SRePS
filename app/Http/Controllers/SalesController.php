<?php

namespace App\Http\Controllers;

use App\Sale;
use App\Item;
use App\Http\Requests\StoreSale;

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
        // Retrieve all objects from Model
        $sales = Sale::all();

        // Return view with objects
        return View::make('sales.index')->with('sales', $sales);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $items = Item::pluck('name', 'id');
        return View::make('sales.create')->with('items', $items);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */


    public function store(StoreSale $request)
    {
        // Validate
        $validated = $request->validated();

        // Check item quantity
        $item = Item::find(Input::get('item_id'));
        if ($item->stock < 10) {
            $message = 'Item '.$item->name.' has low stock!';
        } else {
            $message = 'Successfully created!';
        }

        // Check stock covers sale quantity
        if ($item->stock < Input::get('quantity')) {
            Session::flash('message', 'Error: Not enough stock for sale!');
            return Redirect::to('sales');
        }

        // Create new object
        $sale = new Sale;
        $sale->sale = Input::get('sale');
        $sale->quantity = Input::get('quantity');
        $sale->created_at = Carbon::now();
        $sale->item_id = Input::get('item_id');
        $sale->save();

        //update items stock
        $item->stock -= $sale->quantity;
        $item->save();

        // Redirect
        Session::flash('message', $message);
        return Redirect::to('sales');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        // Retrieve all objects from Model based on ID
        $sale = Sale::find($id);

        // Return view with objects
        return View::make('sales.show')->with('sale', $sale);
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
    public function update(StoreSale $request, $id)
    {
        $validated = $request->validated();

        $sale = Sale::find($id);
        $sale->sale = Input::get('sale');
        $sale->quantity = Input::get('quantity');
        $sale->created_at = Carbon::now();
        $sale->item_id = Input::get('item_id');
        $sale->save();

        // Redirect
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

        // Redirect
        Session::flash('message', 'Successfully deleted!');
        return Redirect::to('sales');
    }
}
