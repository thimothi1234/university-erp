<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class travelsub extends Model
{
    use HasFactory;
    protected $fillable = [
        'date'	,'costcentre',	'sub'	,'distance',	'type',	'ticket',	'amount',	'rimbid','station'
    ];
}
	