<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class news extends Model
{
    protected $table = 'news';
	public $primaryKey = 'id';
    protected $fillable = [
    	'is_active','user_id','name','img','details'
    ];
}
