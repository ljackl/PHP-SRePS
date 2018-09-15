<?php

namespace App\Http\Controllers;

use App\Sale;
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
        return View::make('reports.index');
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

        return View::make('reports.view')->with('sales', $sales);
    }
}
