<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mobile extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'vendor',
        'designation',
        'eid',
        'department',
        'from',
        'to',
        'submittedby',
        'amount',
        'status',
        'remarks',
        'path'

    ];

    public function nmmms()
        {
        return $this->hasOne(employee::class, 'id', 'vendor');
        }
}
