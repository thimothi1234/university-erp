<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class transactions extends Model
{
    use HasFactory;


    protected $fillable = [
        'debit_credit', 'sum', 'narration','mailmsg','voucherno_bvrno', 'transactiondate', 'vendor','chequeno', 'status',  'project', 'pfms','commitment','bank','entered','gross','po','sub','inwardsno','namee','invno','invdate'
    ];

    public function ledger()
        {
        return $this->hasOne(ledger::class, 'transaction_id', 'id');
        }

        public function vendors()
        {
        return $this->hasOne(employee::class, 'id', 'vendor');
        }  
        
         public function vendorss()
        {
        return $this->hasOne(employee::class, 'id', 'namee');
        } 

        public function projects()
        {
        return $this->hasOne(project::class, 'id', 'project');
        } 
        public function pfmss()
        {
        return $this->hasOne(pfms::class, 'id', 'pfms');
        } 

        public function entereds()
        {
        return $this->hasOne(user::class, 'id', 'entered');
        } 

        public function pffms()
        {
        return $this->hasOne(pfms::class, 'id', 'pfms');
        } 
        public function subs()
        {
        return $this->hasOne(project_head::class, 'id', 'sub');
        } 

        public function bankkk()
        {
        return $this->hasOne(tally::class, 'id', 'bank');
        } 
        
        public function project()
    {
        return $this->belongsTo(Project::class, 'project');
    }

    public function head()
    {
        return $this->belongsTo(ProjectHead::class, 'sub');
    }
        

     // --- Relations ---
    public function bulkt()
    {
        return $this->hasOne(Bulk::class, 'transaction_id');
    }

    public function employee()
    {
        return $this->belongsTo(Employee::class, 'vendor');
    }

    public function pfmst()
    {
        return $this->belongsTo(Pfms::class, 'pfms');
    }

    // --- Conditional Vendor Accessor ---
    public function getVendorNameAttribute()
    {
        // ✅ If vendor is 518, use the employee linked to bulk.name
        if ($this->vendor == 518 && $this->bulk && $this->bulk->name) {
            $employee = Employee::find($this->bulk->name);
            return $employee ? $employee->name : '—';
        }

        // ✅ Otherwise, use normal vendor
        return $this->employee ? $this->employee->name : '—';
    }

   // public $timestamps = false;

        
        
    
}
