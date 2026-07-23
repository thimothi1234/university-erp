<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PaySheetDetail extends Model
{
    use HasFactory;
    protected $fillable = ['pay_sheet_id', 'head_name', 'amount', 'type'];

    // Each PaySheetDetail belongs to a PaySheet
    public function paySheet()
    {
        return $this->belongsTo(PaySheet::class, 'pay_id');
    }

    public function payhead()
{
    return $this->belongsTo(Payhead::class, 'head_name');
}
}
