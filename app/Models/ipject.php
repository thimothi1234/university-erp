<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ipject extends Model
{
    use HasFactory;

    protected $fillable = [
        'costcentre', 'tid', 'sub','amount'
    ];
}
