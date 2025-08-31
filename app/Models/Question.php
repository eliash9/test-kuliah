<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //
    protected $fillable = [
        'text',
        'option_a', 'option_a_sub',
        'option_b', 'option_b_sub',
        'option_c', 'option_c_sub',
        'option_d', 'option_d_sub',
    ];
}
