<?php

namespace App\Http\Controllers;

use App\Attributes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class AttributesController extends Controller
{
    public function index() 
    {
      $attributes = Attributes::orderBy('id')->paginate(10);
        return view('admin.attributes.index')->with(compact('attributes'));
    }

    //Descuenta un producto del inventario para añadirlo al carrito
    public function addProduct($id, $qty){
      $attribute = DB::table('products_attributes')->where('id',$id)->get();
      $cantidad = $attribute[0]->qty - $qty;
      DB::table('products_attributes')->where('id',$id)->update(['qty' => $cantidad]);    
    }

    //Aumentar un producto del inventario al eliminarlo del carrito
    public function removeProduct($id, $qty){
      $attribute = DB::table('products_attributes')->where('id',$id)->get();
      $cantidad = $attribute->qty - $qty;
      DB::table('products_attributes')->where('id',$id)->update(['qty' => $cantidad]);    
    }
    
}
