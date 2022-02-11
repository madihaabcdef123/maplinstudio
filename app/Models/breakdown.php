<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class breakdown extends Model
 {
    use HasFactory;
    protected $table = 'breakdown';
    protected $primaryKey = 'id';
    protected $fillable = ['type', 'uploader', 'user_id'];
 }
