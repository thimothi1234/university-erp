<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class userrole extends Model
{
    use HasFactory;
    protected $fillable = [
        'roleid', 'userid'
    ];

    public function names()
        {
        return $this->hasOne(role::class, 'roleid', 'id');
        } 

    
}
