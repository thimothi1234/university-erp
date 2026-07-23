<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class approval extends Model
{
    use HasFactory;


    public function ars()
        {
        return $this->hasOne(user::class, 'id', 'user_id');
        }

         
}
