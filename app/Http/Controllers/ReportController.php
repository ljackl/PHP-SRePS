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
        return View::make('reports.index')
            ->with('items', $items)
            ->with('itemid', $itemid);
    }

    public function toCSV(TimeRange $request)
    {
        // Validate dates
        $validated = $request->validated();

        $from = Input::get('select_from');
        $to = Input::get('select_to');
        $sales = Sale::whereBetween('created_at', [$from, $to])->orderBy('created_at')->get();

        $csv = \League\Csv\Writer::createFromFileObject(new \SplTempFileObject());
        $csv->insertOne(\Schema::getColumnListing('sales'));
        foreach ($sales as $sale) {
            $csv->insertOne($sale->toArray());
        }

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
        //dd($topSold);

        return View::make('reports.view')
            ->with('sales', $sales)
            ->with('topSold', $topSold);
    }

    public function predictItemSales(TimeRange $request)
    {
        // Validate dates
        $validated = $request->validated();

        $itemid = Input::get('item_id');
        $from = Input::get('select_from');
        $to = Input::get('select_to');
        $sales = Sale::whereBetween('created_at', [$from, $to])
                    ->where('item_id', $itemid)
                    ->orderBy('created_at')->get();
        $topSold = null;
        $estSales = Sale::groupBy('item_id')
                    ->selectRaw('ceil(avg(quantity)) as estimated_quantity, item_id')
                    ->where('item_id', $itemid)
                    ->orderBy('item_id')
                    ->pluck('estimated_quantity','item_id');
        //dd($estSales);
        //dd($itemid);

        return View::make('reports.view')
            ->with('sales', $sales)
            ->with('topSold', $topSold)
            ->with('estSales', $estSales);
    }
}
