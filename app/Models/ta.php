<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ta extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'designation', 'paylevel','type', 'idno', 'department','purpose', 'proposeddate',  'todate', 'class','project','head','to','total','submittedby','vendor','status','remarks','path'
    ];

    public function projectsss()
        {
        return $this->hasOne(project::class, 'id', 'project');
        }

        public function nmmm()
        {
        return $this->hasOne(employee::class, 'id', 'status');
        }

        public function nmmms()
        {
        return $this->hasOne(employee::class, 'id', 'vendor');
        }
}
