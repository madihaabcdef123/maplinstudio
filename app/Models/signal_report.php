<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class signal_report extends Model
{
 	protected $primaryKey = 'id';
  	protected $table = 'signal_report';
    protected $guarded = [];  

    public function user(){
    	return $this->belongsTo('App\Models\User', 'user_id' , 'id');
    }
}
