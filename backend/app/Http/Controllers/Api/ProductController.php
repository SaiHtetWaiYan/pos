<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Supplier;
use App\Models\StockPrice;

class ProductController extends Controller
{
    //
    public function getData()
    {
        $user_id=Auth::user()->id;
        $brands = Brand::where('user_id',$user_id)->where('is_show',1)->get();
        $categories = Category::where('user_id', $user_id)->get();
        $suppliers = Supplier::where('user_id', $user_id)->get();
        return response()->json(['brands'=> $brands , 'categories' => $categories , 'suppliers' => $suppliers],200);
    }

    public function create(Request $request)
    {
        if(!empty(Product::where('user_id',Auth::user()->id)->where('code', $request->code)->first())){
            return response()->json(['codeError'=> 'Product code already exit!'],401);
        }
        if ($request->photo){
            $request->validate([
                'photo' => 'mimes:jpg,jpeg,png'
            ]);
            $imageName = time().'.'.$request->photo->getClientOriginalExtension();
            $request->photo->move(public_path('products'), $imageName);
        }
        else {
            $imageName = 'default.jpg';
        }

        $product =Product::create([
            'user_id' => $request->user_id,
            'name' => $request->name,
            'code' => $request->code,
            'variant' => $request->variant,
            'description' => $request->description,
            'brand_id' => $request->brand_id,
            'category_id' => $request->category_id,
            'supplier_id' => $request->supplier_id,
            'price' => $request->selling_price,
            'is_show' => $request->is_show,
            'photo' => $imageName,
        ]);


        StockPrice::create([
            'product_id' => $product->id,
            'buying_price' => $request->buying_price,
            'selling_price' => $request->selling_price,
            'stock' => $request->stock,
        ]);

        return response()->json(['message'=>'Product successfully created'],200);
    }
}
