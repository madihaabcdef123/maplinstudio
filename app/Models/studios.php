<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class studios extends Model
{
 	protected $primaryKey = 'id';
  	protected $table = 'studios';
    protected $guarded = [];  
    protected $fillable = ['name', 'banner_img','inner_1_img','inner_2_img','details', 'user_id'];
}
