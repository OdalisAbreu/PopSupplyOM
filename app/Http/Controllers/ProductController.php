<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;

class ProductController extends Controller
{
   public function show($id) 
   {
   	  $product = Product::find($id);
      $images = $product->images;

      $imagesLeft = collect();
      $imagesRight = collect();
      foreach ($images as $key => $image) {
        if($key%2 == 0)
              $imagesLeft->push($image);
        else
              $imagesRight->push($image);

      }
   		return view('products.show')->with(compact('product', 'imagesLeft', 'imagesRight'));
   }
  public function index()
   {  
         $product = Product::select('id','name','description','price')->get();
         return response()->json($product->load('images'));

   }
   
   public function product($id)
   {  
      $product = Product::findOrFail($id);
      return response()->json($product->load('category','images'));
   }
   
}
