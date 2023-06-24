<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quiz extends Model
{
    protected $fillable = [
        'stagiaire_id',
        'niveau_question_id',
        'theme_question_id',
        'url'
    ];
    use HasFactory;
}
