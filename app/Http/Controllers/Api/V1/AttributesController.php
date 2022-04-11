<?php

namespace App\Http\Controllers\Api\V1;

use App\Attributes;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
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
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Attributes  $attributes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attributes $attributes)
    {
        //
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
    
    public function saborProducto($id){
        $sabores = DB::table('products_attributes')
                ->join('attributes','products_attributes.attribute_id','=', 'attributes.id')
                ->where('products_attributes.product_id',$id)
                ->select('products_attributes.id', 'attributes.value','attributes.description')
                ->orderByDesc('id')->get();

        return $sabores;
    }
}
