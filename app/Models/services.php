<?php

namespace App\Models;

use Helper;
use Illuminate\Database\Eloquent\Model;

class services extends Model
{
    protected $table = 'services';
    public $primaryKey = 'id';
    protected $fillable = ['name', 'amount'];

}
