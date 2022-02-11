<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class orders extends Model
{
 	protected $primaryKey = 'id';
  	protected $table = 'orders';
    protected $guarded = [];  

    public function package(){
    	return $this->belongsTo('App\Models\packages', 'package_id' , 'id');
    }

    public function user(){
    	return $this->belongsTo('App\Models\User', 'user_id' , 'id');
    }
}
