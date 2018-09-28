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
        return View::make('reports.index')->with('items', $items);
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

        /*
        // Sums all items sales and return the 5 most sold items
        SELECT item_id, SUM(quantity) AS quantity_total
        FROM sales
        GROUP BY item_id
        ORDER BY quantity_total DESC LIMIT 5
        */
        $topSold = Sale::groupBy('item_id')
                    ->selectRaw('sum(quantity) as quantity_total, item_id')
                    ->whereBetween('created_at', [$from, $to])
                    ->orderBy('quantity_total', 'desc')
                    ->pluck('quantity_total','item_id')
                    ->take(5);
        //var_dump($topSold);

        return View::make('reports.view')
            ->with('sales', $sales)
            ->with('topSold', $topSold);
    }
}
