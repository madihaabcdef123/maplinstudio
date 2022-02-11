<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class breakdown_img extends Model
{
    use HasFactory;
    protected $table = 'breakdown_img';
    protected $primaryKey = 'id';
    protected $fillable = ['name', 'path', 'record_id'];
}
