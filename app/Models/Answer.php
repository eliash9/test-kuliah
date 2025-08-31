<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    protected $fillable = [
        'user_id', 'question_id', 'chosen_option', 'sub',
    ];

    public function question()
    {
        return $this->belongsTo(Question::class);
    }
}
