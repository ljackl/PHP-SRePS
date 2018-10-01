<?php

namespace App\Http\Controllers;

use App\Item;
use App\Http\Requests\StoreItem;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;
use Validator;
use Input;
use Session;
use Redirect;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Retrieve all objects from Model
        $items = Item::all();

        // Return view with objects
        return View::make('items.index')->with('items', $items);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return View::make('items.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreItem $request)
    {
        // Validate
        $validated = $request->validated();

        // Create new object
        $item = new Item;
        $item->name = Input::get('name');
        $item->description = Input::get('description');
        $item->stock = Input::get('stock');
        $item->cost = Input::get('cost');
        $item->created_at = Carbon::now();
        $item->save();

        // Redirect
        Session::flash('message', 'Successfully created!');
        return Redirect::to('items');
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
        $item = Item::find($id);

        // Return view with objects
        return View::make('items.show')->with('item', $item);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $item = Item::find($id);
        return View::make('items.edit')->with('item', $item);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(StoreItem $request, $id)
    {
        $validated = $request->validated();

        $item = Item::find($id);
        $item->name = Input::get('name');
        $item->description = Input::get('description');
        $item->stock = Input::get('stock');
        $item->cost = Input::get('cost');
        $item->updated_at = Carbon::now();
        $item->save();

        // Redirect
        Session::flash('message', 'Successfully updated!');
        return Redirect::to('items');
    }

    public function add($id)
    {
        $item = Item::find($id);
        return View::make('items.add')->with('item', $item);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $item = Item::find($id);
        $item->delete();

        // Redirect
        Session::flash('message', 'Successfully deleted!');
        return Redirect::to('items');
    }
}
