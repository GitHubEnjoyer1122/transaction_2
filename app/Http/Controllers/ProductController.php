<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function store(Request $request){
        Product::create([
            "product_name" => $request->product_name,
            "product_capital_price" => $request->product_capital_price,
            "product_sell_price" => $request->product_sell_price
        ]);

        return redirect()->back()->with('success', 'Product Added Succesfully!');
    }

    public function menuadd(Request $request){
        $productAll = Product::all();
        $products = [];

        foreach($productAll as $prod){
            if(in_array($prod->product_name, $request->product_limit)){
                continue;
            }

            $products[] = $prod;
        }

        return response()->json([
            "datas" => $products
        ]);
    }
}
