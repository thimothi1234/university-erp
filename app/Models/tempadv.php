<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tempadv extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'designation', 'department', 'amount', 'submittedby', 'status', 'eid','path'
    ];

    public function nmmms()
    {
    return $this->hasOne(employee::class, 'id', 'vendor');
    }
}
