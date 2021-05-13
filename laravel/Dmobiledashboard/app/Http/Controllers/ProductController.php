<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Productslider;

class ProductController extends Controller
{
    public function CreateProduct(Request $request){
        $product = Product::create([
            'name'=> $request->name,
            'description'=>$request->description,
            'price'=>$request->price,
            'productimg'=>$request->file('productimg')->store('products'),
        ]);
        $product->save();
        return (['Product'=> $product]);
    }
    public function productdisplay(Request $request){
        $product = Product::all();
        return (['products'=> $product]);
    }

    public function productSlider(Request $request){
        $productslider =  Productslider::create([
            'productimg'=>$request->file('productimg')->store('productslider'),
        ]);
        $productslider->save();
        return (['Product'=> $productslider]);
    }
      
    public function Sliderimages(Request $request){
        // $productslider = productSlider::all();
        $productslider = productSlider::select( 'id' ,'productimg')->get();
        return response()->json($productslider);
    }
}
