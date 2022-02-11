<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class applied_job extends Model
{
    use HasFactory;

     public $timestamps= false;
     protected $table='applied_jobs';


     public function jobs(){
    	return $this->belongsTo('App\Models\jobs', 'job_id' , 'id');
    }
}
