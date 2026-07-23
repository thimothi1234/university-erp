<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class medicalsub extends Model
{
    use HasFactory;
    protected $fillable = [
        'type', 'name','invoice','date', 'quantity','amount', 'pid'
    ];
}
