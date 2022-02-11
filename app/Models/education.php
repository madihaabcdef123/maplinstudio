<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class education extends Model
{
 	protected $primaryKey = 'id';
  	protected $table = 'education';
    protected $guarded = [];  

    public function user(){
    	return $this->belongsTo('App\Models\User', 'user_id' , 'id');
    }
}
