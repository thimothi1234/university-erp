<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payhead extends Model
{
    use HasFactory;
    protected $table = 'payhead'; 
    // Each PaySheetDetail belongs to a PaySheet
  

   
}
