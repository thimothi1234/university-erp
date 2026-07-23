<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaySheet extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'department', 'month_with_year', 'pay_id', 'designation'];

    // One PaySheet has many PaySheetDetails
    public function details()
    {
        return $this->hasMany(PaySheetDetail::class);
    }
}
