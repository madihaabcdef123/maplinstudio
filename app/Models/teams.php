<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class teams extends Model
{
    protected $table = 'teams';
	public $primaryKey = 'id';
    protected $fillable = [
    	'is_active','is_deleted','user_id','name','designation','img'
    ];
}
