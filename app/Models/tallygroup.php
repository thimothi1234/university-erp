<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tallygroup extends Model
{
    use HasFactory;

    protected $fillable = [
        'groupname', 'groupunder', 'actsas'
    ];

    public function groupunders()
        {
        return $this->hasOne(tallygroup::class, 'id', 'groupunder');
        }
}
