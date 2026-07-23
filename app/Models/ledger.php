<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ledger extends Model
{
    use HasFactory;
    protected $fillable = [
        'ledger', 'costcentre', 'cr_dr','amount', 'transaction_id','banks','sub'
    ];

    

        public function ledgers()
        {
        return $this->hasOne(Tally::class, 'id', 'ledger');
        } 
        public function costcentres()
        {
        return $this->hasOne(project::class, 'id', 'costcentre');
        } 

        public function subs()
        {
        return $this->hasOne(project_head::class, 'id', 'sub');
        } 
        
        public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
    
}
