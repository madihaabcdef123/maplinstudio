<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class weeklyBreakdown extends Model
{
    use HasFactory;
 
    protected $table = 'weekly_breakdowns';
    
    public function user(){
    	return $this->belongsTo('App\Models\User', 'user_id' , 'id');
    }

    public function all_images($id){
    	$all_images = breakdown_img::where("is_active" , 1)->where("is_deleted" , 0)->where("record_id" , $id)->get();
    	return $all_images;
    }
  
}
