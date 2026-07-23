<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tally extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'group', 'balance','entered','updated'
    ];

    public function groups()
        {
        return $this->hasOne(Tally::class, 'id', 'group');
        }
}
