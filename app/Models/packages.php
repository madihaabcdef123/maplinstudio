<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class packages extends Model
{
 	protected $primaryKey = 'id';
  	protected $table = 'packages';
    protected $guarded = [];  

    public function user(){
    	return $this->belongsTo('App\Models\User', 'user_id' , 'id');
    }
}
