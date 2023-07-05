<?php

namespace App\Http\Controllers;
use App\Models\Quiz;
use App\Models\question_theme;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class QuizController extends Controller
{
    //


    public function show($quizUrl){
        try{
            $quiz = Quiz::where('url', $quizUrl)->first();
            $categorie = question_theme::find($quiz->theme_question_id)->title;
            $count = DB::table('quiz__questions')->where('quiz_id', $quiz->id)->count();

            return json_encode([
                'id'=>$quiz->id,
                'categorie'=>$categorie,
                'expirationDate'=>$quiz->expirationDate,
                'nombreQuestion'=>$count,
                "quizUrl"=>$quiz->url
            ]);
        } catch (\Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }
    }
}
