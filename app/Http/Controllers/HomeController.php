<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use App\Models\State;
use App\Models\Stock;
use App\Models\SystemSetting;
use App\Models\User;
use App\Models\UserRole;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        Session::put('title', SystemSetting::first()->title);
        Session::put('logo', SystemSetting::first()->logo);
        Session::put('footer', SystemSetting::first()->footer_title);
        Session::put('states', Auth::user()->state_id);

        $lowest_stock_products = Product::where('qty', '<=', 10)->orderBy('qty', 'asc')->limit(10)->get();

        $top_latest_issue_items = Stock::with(['product'])->orderBy('date', 'desc')->limit(10)->get();

        $product_quantities = Stock::with(['product'])->select('product_id', DB::raw('SUM(qty) as total_quantity'))
            ->groupBy('product_id')
            ->orderByDesc('total_quantity')
            ->limit(10)
            ->get();

        $user_count = User::where('id', '<>', 1)->count();
        $category_count = Category::count();
        $product_count = Product::where('isActive', '1')->count();

        $today = date('Y-m-d');
        $stock_amount = Stock::where('date',$today)->where('user_id', Auth::user()->id)->sum('total');

        return view('homepage', compact('lowest_stock_products', 'top_latest_issue_items','product_quantities', 'user_count', 'category_count', 'product_count', 'stock_amount'));
    }
}
