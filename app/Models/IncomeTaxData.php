<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class IncomeTaxData extends Model
{
    use HasFactory;
     protected $fillable = [
        'month_index', 'basic', 'da','hra', 'ta','tada','total','eid','fy'
    ];

}
