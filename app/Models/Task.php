<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

             public function getStatuse()
   {
       return $this->belongsTo('App\Models\Statuse', 'status_id', 'id');
   }
}
