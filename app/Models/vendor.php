<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class vendor extends Model
{
    use HasFactory;
    protected $fillable = [
        'vid', 'type','name', 'acno','ifsc', 'branch','bankname', 'gst','pan','mail', 'mobile','adress','entered','updated'
    ];


    
}
