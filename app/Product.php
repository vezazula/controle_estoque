<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = ['suppliers_id','name', 'description', 'cost', 'quantity'];

    public function suppliers(){
    	return $this->belongsTo(Supplier::class);
    }
}
