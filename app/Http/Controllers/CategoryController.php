<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    
  public function show(Category $category)
  {
  			$products = $category->products()->paginate(10);
  		    return view('categories.show')->with(compact('category','products'));
  }
  public function index()
  {
    $category = Category::all();
   // return response()->json($category->load('products'));
  
    $bot_category = '{ "categories": '.$category.'}';
    return $bot_category;
  }
  
  public function verproducto($id){
   // $category = Category::findOrFail($id);
   // return response()->json($category->load('products'));
      $products = DB::table('categories')
                  ->join('products', 'products.category_id','=','categories.id')
                  ->join('product_images','product_images.product_id', '=','products.id')
                  ->where([['categories.id', $id],['product_images.featured','1']])
                  ->select('categories.name','products.id','products.name','products.price', 'product_images.featured', 'product_images.image')
                  ->get();
      return '{ "products": '.$products.'}';
  }



  // Vista para comprar por el Bot
  public function bot($token)
  {

    //validar Token 
    if($id = DB::table('users')->where('remember_token', $token)->exists()){
      
      $user = DB::table('users')->where('remember_token', $token)->get();//Optiene el id con el token
      $id = $user[0]->id;

      $categories = Category::all();
      $products = $categories->load('products');
  
      if(DB::table('carts')->where([['user_id',$id],['status','Active']])->exists() ){
        $cart = DB::table('carts')->where([['user_id',$id],['status','Active']])->get();
        $cant_produc = DB::table('cart_details')->where('cart_id', $cart[0]->id)->count();
        $total1 = DB::table('carts')->where([['user_id',$id],['status','Active']])->get(['total']);
        $total = $total1[0]->total; 
        
        //Trae los productos del carrito
        // $products_user = DB::table('cart_details')->where('cart_id', $cart[0]->id)->get();
        $products_user = DB::table('cart_details')
                        ->join('products','cart_details.product_id','=','products.id')
                        ->join('product_images','product_images.product_id','=','products.id')
                        ->where([['cart_details.cart_id', $cart[0]->id],['product_images.featured', 1]])
                        ->select('product_images.image','cart_details.id','cart_details.quantity','products.price')
                        ->get();
        $cart_id = $cart[0]->id;
        return view('categories.categories')->with(compact('categories','products', 'id', 'cant_produc', 'total', 'products_user', 'cart_id'));
      }else{
        $cant_produc = 0;
        $total = 0;
        $cart_id = 0;
        return view('categories.categories')->with(compact('categories','products', 'id', 'cant_produc', 'total', 'cart_id'));  
      }
    }



  }

}
