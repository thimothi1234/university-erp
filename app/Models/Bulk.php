<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bulk extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'transaction_id','gross','tds','ptax','net'
    ];

    public function vendors()
        {
        return $this->hasOne(employee::class, 'id', 'name');
        }   
}
