<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Division;
use App\Models\MediaFile;
use App\Models\Product;
use App\Models\Stock;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class ProdController extends Controller
{
    public function add_categories(Request $request)
    {
        $request->validate([
            'category_name' => 'required',
        ]);

        $categoryName = $request->input('category_name');
        Category::create(['cate_name' => $categoryName]);
        return redirect('/cate-manage')->with('success', 'Category has been saved!');
    }

    public function list_categories()
    {
        $list_categories = Category::orderBy('updated_at', 'desc')->get();
        return view('pages.prod_manage.category.cate_manage', compact('list_categories'));
    }

    public function edit_category($id)
    {
        $category_record = Category::find($id);
        return view('pages.prod_manage.category.edit_cate_manage', compact('category_record'));
    }

    public function edit_auth_category(Request $request, $id)
    {
        $validate_data = $request->validate([
            'category_name' => 'required',
        ]);

        //Find & update Data
        $find_category = Category::find($id);

        if ($find_category->cate_name != $validate_data['category_name']) {

            $categoryName = $request->input('category_name');
            $find_category->update(['cate_name' => $categoryName]);
            return redirect()->back()->with('success', 'Category has been updated!');
        }
        return redirect()->back()->with('info', 'No changes were made');
    }

    public function delete_category($id)
    {
        Category::destroy($id);
        return redirect()->back()->with('success', 'Category has been deleted!');
    }

    public function list_product()
    {
        $list_products = Product::with(['category', 'image', 'user', 'division'])->orderBy('created_at', 'desc')->paginate(10);
        return view('pages.prod_manage.product.list_product', compact('list_products'));
    }

    public function add_product()
    {
        $categories = Category::all();
        $divisions = Division::all();
        $list_media_files = MediaFile::all();
        return view('pages.prod_manage.product.add_product', compact('categories', 'list_media_files', 'divisions'));
    }

    public function delete_product($id)
    {
        Product::destroy($id);
        return redirect()->back()->with('success', 'Product has been deleted!');
    }
    public function edit_product($id)
    {
        $products = Product::with('image')->find($id);
        $categories = Category::all();
        $divisions = Division::all();
        $list_media_files = MediaFile::all();
        return view('pages.prod_manage.product.edit_product', compact('products', 'categories', 'list_media_files','divisions'));
    }
    public function edit_auth_product(Request $request, $id)
    {
        $validate_data = $request->validate([
            'title' => 'required',
            'category' => 'required',
            'division' => 'required',
            'qty' => 'required|integer',
            'buy_price' => 'required|integer',
            'sell_price' => 'required|integer',
            'manu_date' => 'required',
            'exp_date' => 'required',
        ],[
            'qty.required' => 'The quantity field is required.',
            'qty.integer' => 'The quantity must be an integer.',
            'manu_date.required' => 'The manufacture date field is required.',
            'exp_date.required' => 'The expire date field is required.',
        ]);

       $products = Product::find($id);

        $products->name = $request->title;
        $products->cate_id = $request->category;
        $products->division_id = $request->division;
        $products->qty = $request->qty;
        $products-> buy_price  = $request-> buy_price;
        $products->sell_price = $request->sell_price;
        $products->manu_date = $request->manu_date;
        $products->exp_date = $request->exp_date;
        $products->img_id = $request->img_id;
        $products->user_id = Auth::user()->id;
        $products->isActive = $request->status;

        if (
            $products->name != $validate_data['title'] ||
            $products->cate_id != $validate_data['category'] ||
            $products->division_id != $validate_data['division'] ||
            $products->qty != $validate_data['qty'] ||
            $products->buy_price != $validate_data['buy_price'] ||
            $products->sell_price != $validate_data['sell_price'] ||
            $products->manu_date != $validate_data['manu_date'] ||
            $products->img_id ||
            $products->exp_date != $validate_data['exp_date']
        ) {
            $products->update();
            return redirect('/edit-product/'.$products->id)->with('success', 'Product has been updated!');
        }

        return redirect()->back()->with('info', 'No changes were made');
    }
    public function add_auth_product(Request $request)
    {
            $request->validate([
                'title' => 'required',
                'category' => 'required',
                'division' => 'required',
                'qty' => 'required|integer',
                'buy_price' => 'required|integer',
                'sell_price' => 'required|integer',
                'manu_date' => 'required',
                'exp_date' => 'required',
            ],[
                'qty.required' => 'The quantity field is required.',
                'qty.integer' => 'The quantity must be an integer.',
                'manu_date.required' => 'The manufacture date field is required.',
                'exp_date.required' => 'The expire date field is required.',
            ]);

            if($request->img_id == null)
            {
                $request->img_id = 1;
            }

        $products = new Product();
        $products->name = $request->title;
        $products->cate_id = $request->category;
        $products->division_id = $request->division;
        $products->qty = $request->qty;
        $products-> buy_price  = $request-> buy_price;
        $products->sell_price = $request->sell_price;
        $products->manu_date = $request->manu_date;
        $products->exp_date = $request->exp_date;
        $products->img_id = $request->img_id;
        $products->user_id = Auth::user()->id;
        $products->isActive = 1;

        $products->save();

        return redirect('/add-product')->with('success', 'Product has been saved!');
    }

    public function lowest_product()
    {
        $lowest_stock_products = Product::with(['category', 'image', 'user', 'division'])->where('qty', '<=', 10)->orderBy('qty', 'asc')->paginate(10);
        return view('pages.prod_manage.product.list_lowest_product', compact('lowest_stock_products'));
    }

    public function search_product(Request $request)
    {
        $search = $request->search_product;

        $list_products = Product::where(function ($query) use ($search) {
            $query->where('name', 'like', "%$search%");
        })->orWhereHas('division', function ($query) use ($search) {
            $query->where('division_name', 'like', "%$search%");
        })->orWhereHas('category', function ($query) use ($search) {
            $query->where('cate_name', 'like', "%$search%");
        })->paginate(10); // Adjust the number of items per page as needed

        return view('pages.prod_manage.product.list_product', compact('list_products', 'search'));
    }

}
