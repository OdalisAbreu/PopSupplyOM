<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Cart extends Model
{
    
    public function details()
    {
    	return $this->hasMany(CartDetail::class);
    }

    public function getTotalAttribute(){
    	$total =0;
    	foreach ($this->details as $detail) {
    		$total += $detail->quantity * $detail->product->price;	
		}
	//	DB::table('carts')->where('id',auth()->user()->cart->id)->update(['total'=>$total]);
    	return $total;

    }
}
