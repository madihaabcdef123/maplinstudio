<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class faqs extends Model
{
 	protected $primaryKey = 'id';
  	protected $table = 'faqs';
    protected $guarded = [];  

    public function user(){
    	return $this->belongsTo('App\Models\User', 'user_id' , 'id');
    }
}
