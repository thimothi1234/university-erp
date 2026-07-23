<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class project_head extends Model
{
    use HasFactory;
    protected $fillable = [
        'project_id',
        'head',
        'amount',

    ];

    public function sub()
    {
    return $this->belongsTo(project::class, 'id', 'project_id');
    }
public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function ledgers()
    {
        return $this->hasMany(Ledger::class, 'sub');
    }

    
}
