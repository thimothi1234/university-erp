<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tady extends Model
{
    use HasFactory;
    protected $fillable = [
        'costcentre', 'sub', 'type', 'onward', 'return','taid'
    ];
}
