<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Division;
use App\Models\Expenditure;
use App\Models\Income;
use App\Models\Product;
use App\Models\State;
use App\Models\Stock;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    public function load_date_stock_report()
    {
        $start_date = date('Y-m-d');
        $end_date = date('Y-m-d');

        return view('pages.prod_manage.report.date_filter_stock_report', compact('start_date', 'end_date'));
    }
    public function filter_date_stock(Request $request)
    {
        $request->validate([
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        $start_date = $request->start_date;
        $end_date = $request->end_date;


        $stocks = Stock::with(['product', 'division', 'user'])->whereBetween('date', [$request->start_date, $request->end_date])->get();
        return view('pages.prod_manage.report.date_filter_stock_report', compact('stocks', 'start_date', 'end_date'));
    }

    public function downloadDateRangeStockPDF(Request $request) {

        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $stocks = Stock::with(['product', 'division', 'user'])->whereBetween('date', [$request->start_date, $request->end_date])->get();
        $pdf = PDF::loadView('pages.prod_manage.report.download_PDF.date_range_stock_report', compact('stocks', 'start_date', 'end_date'));

        return $pdf->download('date_range_stock_report.pdf');
    }

    public function load_daily_stock_report()
    {
        $today = date('Y-m-d');

        $stocks = Stock::with(['product', 'division', 'user'])->where('date', $today)->get();

        return view('pages.prod_manage.report.daily_stock_report', compact('stocks'));
    }
    public function downloadDailyStockPDF() {
        $today = date('Y-m-d');
        $stocks = Stock::with(['product', 'division', 'user'])->where('date', $today)->get();
        $pdf = PDF::loadView('pages.prod_manage.report.download_PDF.daily_stock_report', compact('stocks'));

        return $pdf->download('daily_stock_report.pdf');
    }

    public function load_state_wise_report()
    {
        $states = State::all();

        return view('pages.prod_manage.report.state_wise_report', compact('states'));
    }
    public function downloadStateWisePDF() {

        $states = State::all();
        $pdf = PDF::loadView('pages.prod_manage.report.download_PDF.state_wise_report', compact('states'));

        return $pdf->download('state_wise_report.pdf');
    }

    public function load_division_wise_report()
    {
        $divisions = Division::with(['state'])->get();

        return view('pages.prod_manage.report.division_wise_report', compact('divisions'));
    }
    public function downloadDivisionWisePDF() {

        $divisions = Division::with(['state'])->get();
        $pdf = PDF::loadView('pages.prod_manage.report.download_PDF.division_wise_report', compact('divisions'));

        return $pdf->download('division_wise_report.pdf');
    }

    public function load_user_wise_report()
    {
        $users = User::with('role')->get();
        $stateIds = $users->pluck('state_id')->flatten()->unique()->toArray();
        $states_data = State::all();

        return view('pages.prod_manage.report.user_wise_report', compact('users', 'states_data'));

    }

    public function downloadUserWisePDF() {

        $users = User::with('role')->get();
        $stateIds = $users->pluck('state_id')->flatten()->unique()->toArray();
        $states_data = State::all();

        $pdf = PDF::loadView('pages.prod_manage.report.download_PDF.user_wise_report', compact('users', 'states_data'));

        return $pdf->download('division_wise_report.pdf');
    }


    public function load_category_wise_report()
    {
        $categories = Category::all();

        return view('pages.prod_manage.report.category_wise_report', compact('categories'));

    }

    public function downloadCategoryWisePDF() {

        $categories = Category::all();

        $pdf = PDF::loadView('pages.prod_manage.report.download_PDF.category_wise_report', compact('categories'));

        return $pdf->download('category_wise_report.pdf');
    }

    public function load_product_wise_report()
    {
        $products = Product::with(['category','user','division'])->paginate(10);

        return view('pages.prod_manage.report.product_wise_report', compact('products'));

    }

    public function downloadProductWisePDF() {

        $products = Product::with(['category','user','division'])->get();

        $pdf = PDF::loadView('pages.prod_manage.report.download_PDF.product_wise_report', compact('products'));

        return $pdf->download('product_wise_report.pdf');
    }

    public function load_date_income_report()
    {
        $start_date = date('Y-m-d');
        $end_date = date('Y-m-d');

        return view('pages.prod_manage.report.date_filter_income_report', compact('start_date', 'end_date'));
    }
    public function filter_date_income(Request $request)
    {
        $request->validate([
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        $start_date = $request->start_date;
        $end_date = $request->end_date;


        $incomes = Income::with(['users'])->whereBetween('date', [$request->start_date, $request->end_date])->get();
        return view('pages.prod_manage.report.date_filter_income_report', compact('incomes', 'start_date', 'end_date'));
    }

    public function downloadDateRangeIncomePDF(Request $request) {

        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $incomes = Income::with(['users'])->whereBetween('date', [$request->start_date, $request->end_date])->get();
        $pdf = PDF::loadView('pages.prod_manage.report.download_PDF.date_range_income_report', compact('incomes', 'start_date', 'end_date'));

        return $pdf->download('date_range_income_report.pdf');
    }


    public function load_date_expend_report()
    {
        $start_date = date('Y-m-d');
        $end_date = date('Y-m-d');

        return view('pages.prod_manage.report.date_filter_expend_report', compact('start_date', 'end_date'));
    }
    public function filter_date_expend(Request $request)
    {
        $request->validate([
            'start_date' => 'required',
            'end_date' => 'required',
        ]);

        $start_date = $request->start_date;
        $end_date = $request->end_date;


        $expends = Expenditure::with(['users'])->whereBetween('date', [$request->start_date, $request->end_date])->get();
        return view('pages.prod_manage.report.date_filter_expend_report', compact('expends', 'start_date', 'end_date'));
    }

    public function downloadDateRangeExpendPDF(Request $request) {

        $start_date = $request->start_date;
        $end_date = $request->end_date;

        $expends = Expenditure::with(['users'])->whereBetween('date', [$request->start_date, $request->end_date])->get();
        $pdf = PDF::loadView('pages.prod_manage.report.download_PDF.date_range_expend_report', compact('expends', 'start_date', 'end_date'));

        return $pdf->download('date_range_expenditure_report.pdf');
    }



    public function load_low_stock_report()
    {
        $low_qty = 0;
        $high_qty = 10;

        return view('pages.prod_manage.report.low_stock_product_report', compact('low_qty', 'high_qty'));
    }
    public function filter_low_stock(Request $request)
    {
        $request->validate([
            'low_qty' => 'required',
            'high_qty' => 'required',
        ]);

        $low_qty = $request->low_qty;
        $high_qty = $request->high_qty;

        $lowStocks = Product::with(['division'])->whereBetween('qty', [$low_qty, $high_qty])->orderBy('qty', 'asc')->get();
        return view('pages.prod_manage.report.low_stock_product_report', compact('lowStocks', 'low_qty', 'high_qty'));
    }

    public function downloadLowStockProductPDF(Request $request) {

        $low_qty = $request->low_qty;
        $high_qty = $request->high_qty;

        $lowStocks = Product::with(['division'])->whereBetween('qty', [$low_qty, $high_qty])->orderBy('qty', 'asc')->get();
        $pdf = PDF::loadView('pages.prod_manage.report.download_PDF.low_stock_product_report', compact('lowStocks', 'low_qty', 'high_qty'));

        return $pdf->download('low_stock_product_report.pdf');
    }

}
