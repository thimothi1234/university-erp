<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ceasub extends Model
{
    use HasFactory;
    protected $fillable = [
        'name','dob','ayfrom','ayto','rid','class','school','created_at','updated_at','board','flexRadioDefault','nameschool','attemtno','reason','flexRadioDefault1','disability','dateofdis','disaper','distance'
    ];

}
