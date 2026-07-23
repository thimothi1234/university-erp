<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AddIncome extends Model
{
    // Table name (optional if it matches 'add_incomes')
    protected $table = 'addincome';

    // Disable timestamps if the table doesn't have created_at / updated_at
    public $timestamps = false;

    // Fillable columns
    protected $fillable = [
        'eid',
        'fy',
        'type',
        'gross',
        'tds',
        'month',
        'remarks',
    ];
}
