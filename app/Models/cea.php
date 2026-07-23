<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class cea extends Model
{
    use HasFactory;


    protected $fillable = [
        'cea','hostel','name','designation','department','eid','vendor','amount','doj','hostelsubsidy','ifhostelyesamount','paidbyme','notgovtservent','govtservent','noclaim','distance','declar','attach','file','remarks','status','submittedby','nameofemloyee','workingas','organis'
    ];
    public function nmmms()
    {
    return $this->hasOne(employee::class, 'id', 'vendor');
    }

    public function statuss()
    {
    return $this->hasOne(user::class, 'id', 'status');
    }
}
