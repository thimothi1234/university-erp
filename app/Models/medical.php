<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class medical extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'designation', 'eid','type', 'patientname','patientage','relation', 'doctor','reffered', 'address','disease','from','to', 'submittedby','remarks','path'
    ];
    public function nmmms()
    {
    return $this->hasOne(employee::class, 'id', 'vendor');
    }
}
