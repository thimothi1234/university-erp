<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reimbsub extends Model
{
    use HasFactory;

    protected $fillable = [
        'date', 'invoice','firm', 'purpose','amount', 'rimbid','costcentre','sub'
    ];
}
