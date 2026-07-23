<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tempadvsub extends Model
{
    use HasFactory;
    protected $fillable = [
        'invoice', 'firm', 'quantity', 'details', 'qty', 'rate', 'amount', 'rid','costcentre','sub'
    ];
}
