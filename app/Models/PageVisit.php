<?php

// app/Models/PageVisit.php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageVisit extends Model
{
    protected $fillable = ['user_id', 'visit_count'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

