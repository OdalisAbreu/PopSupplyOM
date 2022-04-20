<?php

namespace App\Http\Controllers\admin;

use App\Attributes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use Attribute;
use Illuminate\Support\Facades\Session;
use File;
use Illuminate\Support\Facades\DB;

class AttributesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
      $attributes = Attributes::paginate(1000);
      return view('admin.attributes.index')->with(compact('attributes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
            return view('admin/attributes/create');
            
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
               // Attributes::create($request->only('value', 'description')); //mass assigment
            $attribute = new Attributes;
            $attribute->value = $request->value;
            $attribute->description = $request->description;
            $attribute->save();

            return redirect('admin/attributes');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Attributes  $attributes
     * @return \Illuminate\Http\Response
     */
    public function show(Attributes $attributes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Attributes  $attributes
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $attributes =  Attributes::find($id);
        return view('admin.attributes.edit')->with(compact('attributes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Attributes  $attributes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        	
        //return dd($request->all());
            $this->validate($request, Attributes::$rules);
            // $attributes->update($request->only('description'));  	
            $attributes = Attributes::find($id);
            $attributes->description = $request->input('description');
            $attributes->save();

           

                return redirect('admin/attributes');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Attributes  $attributes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attributes $attributes)
    {
        //
    }

    public function editSabor($id){
        $product = Product::find($id);
        $attributes = Attributes::all();
        $sabores = DB::table('products_attributes')
                ->join('attributes','products_attributes.attribute_id','=', 'attributes.id')
                ->where('products_attributes.product_id',$id)->get();

        return view('admin.attributes.add')->with(compact('product','attributes','sabores' ));
    }

    public function addSabor(Request $request){

        $producto = DB::table('products_attributes')->where([['product_id',$request->product_id],['attribute_id',$request->attribute_id]])->get();
        if(empty(json_decode($producto))){
            DB::insert('insert into products_attributes (product_id, attribute_id, qty) values 
            (?,?,?)', [$request->product_id,$request->attribute_id, $request->qty]);
        }else{
            $cantidad = 0;
            $cantidad = $request->qty + $producto[0]->qty;
            DB::update('update products_attributes set qty ='.$cantidad.' where id = ?',array($producto[0]->id));
        }
      
        
        return redirect('admin/attributes/edit/'.$request->product_id);
    }

    public function eliminar($id, $product_id){
        DB::delete('delete from products_attributes where id = '.$id);
        return redirect('admin/attributes/edit/'.$product_id);
    }
}
