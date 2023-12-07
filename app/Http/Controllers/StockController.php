<?php

namespace App\Http\Controllers;

use App\Models\Division;
use App\Models\Product;
use App\Models\Stock;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StockController extends Controller
{
   public function list_stock()
   {
       //Show state only division data
       $user_state_id = Auth::user()->current_state;
       $divisions = Division::where('state_id', $user_state_id)->get();
       //dd($divisions);
       $products = Product::all()->where('isActive', 1);

       //Show stock data
       $user_id = Auth::user()->id;
       $stocks = Stock::with(['division', 'product'])->
       where('user_id', $user_id)->
       orderBy('created_at', 'desc')->paginate(9);

       return view('pages.prod_manage.stock.stock_manage', compact('stocks', 'divisions','products'));
   }
   public function get_stock_division(Request $request){

       $division_id = $request->input('selectedValue');
       $products_data = Product::where('division_id', $division_id)->where('isActive', 1)->orderBy('updated_at', 'desc')->get();
       return response()->json(['data' => $products_data]);
   }
   public function get_price($product_id)
   {
       $product_data = Product::find($product_id);
       $product_price = $product_data->sell_price;
       $product_qty = $product_data->qty;
       return response()->json(['price' => $product_price, 'qty' => $product_qty]);
   }
   public function add_stock(Request $request)
   {
       $request->validate([
           'stock_date' => 'required',
           'division' => 'required',
           'product' => 'required',
           'sell_price' => 'required|numeric|not_in:0',
           'qty' => 'required|numeric',
       ],[
           'qty.required' => 'The quantity field is required.',
           'sell_price.required' => 'The price field is required.',
           'sell_price.not_in:0' => 'You cannot give 0 value and please select Product.',
       ]);

       $product_id = $request->product;
       $qty = $request->qty;

       //Save stock
       $Stock = new Stock();
       $Stock->date = $request->stock_date;
       $Stock->division_id = $request->division;
       $Stock->product_id = $request->product;
       $Stock->price = $request->sell_price;
       $Stock->total = $request->total;
       $Stock->qty = $request->qty;
       $Stock->user_id = Auth::user()->id;

       $Stock->save();

       //Update Stock in product table
       $product_data = Product::find($product_id);
       $product_in_stock = $product_data->qty;
       $in_stock = $product_in_stock-$qty;

       $product_data->qty = $in_stock;
       $product_data->update();

       return redirect()->back()->with('success', 'Saved!');
   }

   public function delete_stock($id)
   {
       //get Stock table quantity
       $stock_data = Stock::find($id);
       $product_id = $stock_data->product_id;
       $stock_qty = $stock_data->qty;

       //get Production table quantity
       $prod_data = Product::find($product_id);
       $product_instock = $prod_data->qty;

       //When delete, Stock quantity should add to product quantity
       $new_stock = $stock_qty+$product_instock;
       $prod_data->qty = $new_stock;
       $prod_data->update();

       //Finally, Delete stock data record
       $stock_data->delete();

       return redirect()->back();

   }
   public function edit_stock_form($id)
   {
       $user_state_id = Auth::user()->current_state;
       $divisions = Division::where('state_id', $user_state_id)->get();

       $stocks = Stock::with(['division', 'product'])->find($id);

       $products = Product::where('division_id', $stocks->division_id)->where('isActive', 1)->get();

       return view('pages.prod_manage.stock.edit_stock_manage', compact('stocks', 'divisions', 'products'));
   }

   public  function edit_stock(Request $request, $id)
   {
       $request->validate([
           'stock_date' => 'required',
           'division' => 'required',
           'product' => 'required',
           'sell_price' => 'required|numeric',
           'qty' => 'required|numeric',
       ],[
           'qty.required' => 'The quantity field is required.',
           'sell_price.required' => 'The price field is required.',
       ]);

       $product_id = $request->product;
       $changed_qty = $request->qty;

       $Stock = Stock::find($id);

       //Update Stock in product table
       $product_data = Product::find($product_id);

       if($Stock->qty <= $changed_qty)
       {
           //$requested_qty = $changed_qty-$Stock->qty; //Ex - current stock - 10, enter 20, difference of 10 products.
           $requested_qty = $changed_qty;  //Given Quantity without change and calculate instock

           //Logic - (Form Quantity value - Current Stock quantity) + Product Quantity
           $update_stock = $product_data->qty-$requested_qty;
       }else
       {
           //$requested_qty = $Stock->qty-$changed_qty; //Ex - current stock - 10, enter 20, difference of 10 products.
           $requested_qty = $changed_qty; //Given Quantity without change and calculate instock

           //Logic - (Form Quantity value - Current Stock quantity) - Product Quantity
           $update_stock = $requested_qty+$product_data->qty;
       }

       //Save stock
       $Stock->date = $request->stock_date;
       $Stock->division_id = $request->division;
       $Stock->product_id = $request->product;
       $Stock->price = $request->sell_price;
       $Stock->total = $request->total;
       $Stock->qty = $request->qty;
       $Stock->user_id = Auth::user()->id;

       $Stock->update();

       $product_data->qty = $update_stock;
       $product_data->update();

       return redirect()->back()->with('success', 'Stock has been updated!');
   }
    public function search_issue_stock(Request $request)
    {
        //Show state only division data
        $user_state_id = Auth::user()->current_state;
        $divisions = Division::where('state_id', $user_state_id)->get();
        //dd($divisions);
        $products = Product::all()->where('isActive', 1);

        $search = $request->search_issue_stock;

        $stocks = Stock::where(function ($query) use ($search) {
            $query->where('date', 'like', "%$search%");
        })->orWhereHas('division', function ($query) use ($search) {
            $query->where('division_name', 'like', "%$search%");
        })->orWhereHas('product', function ($query) use ($search) {
            $query->where('name', 'like', "%$search%");
        })->paginate(10); // Adjust the number of items per page as needed

        return view('pages.prod_manage.stock.stock_manage', compact('stocks', 'search' , 'divisions', 'products'));
    }
}
