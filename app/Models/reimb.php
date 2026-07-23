<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reimb extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'eid','designation', 'vendor','status', 'department','submittedby', 'amount','remarks','path'
    ];

    public function nmmms()
    {
    return $this->hasOne(employee::class, 'id', 'vendor');
    }

}
