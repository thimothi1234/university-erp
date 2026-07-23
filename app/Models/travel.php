<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class travel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',	'designation',	'department',	'eid'	,'vendor',	'amount',	'status',	'remarks'	,'path',	'submittedby'
    ];

    public function nmmms()
    {
    return $this->hasOne(employee::class, 'id', 'vendor');
    }
}


	