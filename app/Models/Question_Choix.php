<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question_Choix extends Model
{
    protected $fillable = ['question_id', 'choix', 'estVrai'];

    use HasFactory;
}
