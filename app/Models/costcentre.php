<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class costcentre extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'group', 'balance'
    ];
}
