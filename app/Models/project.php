<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class project extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'Projectcode','funding_agency', 'whether','start_date', 'agreement','Sanctionno',
        'sanctioned','type','date', 'duration','end_date','status', 'pfms','remarks', 'created_at','updated_at','entered','updated'
    ];

    public function projects()
        {
        return $this->hasOne(transactions::class, 'id', 'project');
        }


        public function head()
        {
        return $this->hasMany(project_head::class, 'project_id', 'id');
        }
        
        
        public function heads()
    {
        return $this->hasMany(ProjectHead::class, 'project_id');
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'project');
    }
}
