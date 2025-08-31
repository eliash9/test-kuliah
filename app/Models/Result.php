<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Result extends Model
{
    protected $fillable = [
        'user_id', 'multimedia_score', 'tkj_score', 'rpl_score', 'umum_score',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
