<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attributes extends Model
{
      //mass asigment
  protected $fillable = ['name', 'description'];

  //validation
	public static $rules = [
   		'description' => 'max:250'
   		
   	];

/*
    // $category->products
    public function products()
    {
      $produc = $this->hasMany(Product::class);
    	return $produc; //una categoria tiene muchos productos
    }

    public function getFeaturedImageUrlAttribute()
    {
      if($this->image){
          return '/images/categories/' . $this->image;
      }else{

        $firstProduct = $this->products()->first();    
        if($firstProduct)   
            return $firstProduct->featured_image_url;
          else
            return '/images/default.png';
      }

    }
*/
 }
