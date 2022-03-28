<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    public function user(){

        return $this->belongsTo(User::class);
    }

    public function cart(){
        return $this->belongsTo(Cart::class);
    }
}
