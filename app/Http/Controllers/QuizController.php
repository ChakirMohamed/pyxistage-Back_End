<?php

namespace App\Http\Controllers;
use App\Models\Quiz;
use App\Models\question_theme;

use Illuminate\Http\Request;

class QuizController extends Controller
{
    //


    public function show($quizUrl){
        try{
            $quiz = Quiz::where('url', $quizUrl)->first();
            $categorie = question_theme::find($quiz->theme_question_id)->title;
            return json_encode([
                'id'=>$quiz->id,
                'categorie'=>$categorie,
                'expirationDate'=>$quiz->expirationDate
            ]);
        } catch (\Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }
    }
}
