<?php

namespace App\Http\Controllers;

use App\Sale;
use App\Item;
use App\Http\Requests\TimeRange;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\View;
use Carbon\Carbon;
use Validator;
use Input;
use Session;
use Redirect;

class ReportController extends Controller
{
    /**
     * Show the report home view.
     *
     * @return Response
     */
    public function show()
    {
        $items = Item::orderBy('stock', 'asc')->take(5)->get();
        $itemid = Item::pluck('name', 'id');
        $category = ItemController::getEnumValues('items','category') ;
        return View::make('reports.index')
            ->with('items', $items)
            ->with('itemid', $itemid)
            ->with('category', $category);
    }

    public function toCSV(TimeRange $request)
    {
        // Validate dates
        $validated = $request->validated();

        // Define time and create csv object
        $from = Input::get('select_from');
        $to = Input::get('select_to');
        $csv = \League\Csv\Writer::createFromFileObject(new \SplTempFileObject());

        // Get all sales for period
        $sales = Sale::whereBetween('created_at', [$from, $to])->orderBy('created_at')->get();

        $csv->insertOne(\Schema::getColumnListing('sales'));
        foreach ($sales as $sale) {
            $csv->insertOne($sale->toArray());
        }

        // Get all sales for period
        $topSold = Sale::groupBy('item_id')
                    ->selectRaw('sum(quantity) as quantity_total, item_id')
                    ->whereBetween('created_at', [$from, $to])
                    ->orderBy('quantity_total', 'desc')
                    ->pluck('quantity_total','item_id')
                    ->take(5);
        //dd($topSold);

        $csv->insertOne(['item_id', 'quantity_total']);
        foreach ($topSold as $item => $qty) {
            $csv->insertOne([$item, $qty]);
        }

        // Send for download
        $csv->output($from.'_'.$to.'_sales.csv');
    }

    public function viewReport(TimeRange $request)
    {
        // Validate dates
        $validated = $request->validated();

        $from = Input::get('select_from');
        $to = Input::get('select_to');
        $sales = Sale::whereBetween('created_at', [$from, $to])->orderBy('created_at')->get();

        $topSold = Sale::groupBy('item_id')
                    ->selectRaw('sum(quantity) as quantity_total, item_id')
                    ->whereBetween('created_at', [$from, $to])
                    ->orderBy('quantity_total', 'desc')
                    ->pluck('quantity_total','item_id')
                    ->take(5);

        return View::make('reports.view')
            ->with('sales', $sales)
            ->with('topSold', $topSold);
    }

    public function predictItemSales(TimeRange $request)
    {
        // Validate dates
        $validated = $request->validated();

        // Get item details
        $item_id = Input::get('item_id');
        $item = Item::find($item_id);

        // Get dates from input
        $from = Input::get('select_from');
        $to = Input::get('select_to');

        // Get total time span
        $earliestEntry = DB::Table('sales')
                    ->where('item_id', $item_id)
                    ->min('created_at');
        $latestEntry = DB::Table('sales')
                    ->where('item_id', $item_id)
                    ->max('created_at');

        $startTime = Carbon::Parse($latestEntry);
        $finishTime = Carbon::Parse($earliestEntry);
        $totalDuration = $finishTime-> diffInDays($startTime);
        if ($totalDuration == 0)
        {
            Session::flash('message', 'Error: Not enough data for prediction!');
            return Redirect::to('reports');
        }

        // Get selected time span
        $startTime = Carbon::Parse($from);
        $finishTime = Carbon::Parse($to);
        $selectedDuration = $finishTime-> diffInDays($startTime);

        // Get period
        $period = $selectedDuration / $totalDuration;
        if ($period > 1) $period = 1;

        // Get sum of quantity
        $quantitySum = Sale::groupBy('item_id')
                    ->selectRaw('sum(quantity) as quantity_total')
                    ->where('item_id', $item_id)
                    ->orderBy('quantity_total')
                    ->pluck('quantity_total');

        // quantity per period
        $quantityPerPeriod = round($quantitySum[0] * $period);

        return View::make('reports.view')
            ->with('quantityPerPeriod', $quantityPerPeriod)
            ->with('item', $item)
            ->with('selectedDuration', $selectedDuration);
    }

    public function predictCategorySales(TimeRange $request)
    {
        // Validate dates
        $validated = $request->validated();

        // Get category from input
        $category = Input::get('category');

        // Get dates from input
        $from = Input::get('select_from');
        $to = Input::get('select_to');

        // Get total time span
        $earliestEntry = Sale::join('items', 'sales.item_id', '=', 'items.id')
            ->where('items.category', $category)
            ->min('sales.created_at');
        $latestEntry = Sale::join('items', 'sales.item_id', '=', 'items.id')
            ->where('items.category', $category)
            ->max('sales.created_at');

        $startTime = Carbon::parse($latestEntry);
        $finishTime = Carbon::parse($earliestEntry);
        $totalDuration = $finishTime->diffInDays($startTime);
        if ($totalDuration == 0)
        {
            Session::flash('message', 'Error: Not enough data for prediction!');
            return Redirect::to('reports');
        }

        // Get selected time span
        $startTime = Carbon::parse($from);
        $finishTime = Carbon::parse($to);
        $selectedDuration = $finishTime->diffInDays($startTime);

        // Get period
        $period = $selectedDuration / $totalDuration;
        if ($period > 1) $period = 1;

        // Get sum of quantity
        $quantitySum = Sale::groupBy('category')
                    ->join('items', 'sales.item_id', '=', 'items.id')
                    ->selectRaw('sum(quantity) as quantity_total')
                    ->where('category', $category)
                    ->orderBy('category')
                    ->pluck('quantity_total');

        // quantity per period
        $quantityPerPeriod = round($quantitySum[0] * $period);

        return View::make('reports.view')
            ->with('quantityPerPeriod', $quantityPerPeriod)
            ->with('category', $category)
            ->with('selectedDuration', $selectedDuration);
    }
}
