<?php

namespace App\Http\Controllers;

use App\Models\QuizQuestionChoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\Quiz;
use App\Models\Question;
use App\Models\Question_choix;

use function PHPUnit\Framework\returnSelf;

class QuizQuestionChoiceController extends Controller
{


    // public function calculateQuizScore($quizId)
    // {
    //     // Récupérer les choix du stagiaire pour le quiz donné
    //     $quizChoices = QuizQuestionChoice::where('quiz_id', $quizId)
    //         ->where('quiz_id', $quizId)
    //         ->get();

    //     // Récupérer les choix corrects pour chaque question du quiz
    //     $questionIds = $quizChoices->pluck('choice.question_id')->unique();
    //     $correctChoices = Question_choix::whereIn('question_id', $questionIds)
    //         ->where('estVrai', true)
    //         ->pluck('id');

    //     // Calculer le score en comparant les choix du stagiaire avec les choix corrects
    //     $score = 0;
    //     foreach ($quizChoices as $quizChoice) {
    //         if (in_array($quizChoice->choice_id, $correctChoices->toArray())) {
    //             $score++;
    //         }
    //     }

    //     // Sauvegarder le score dans la table "quizzes" pour le stagiaire donné
    //     // $quiz = Quiz::find($quizId);
    //     // $quiz->score = $score;
    //     // $quiz->save();

    //     return $score;
    // }


    public function calculateQuizScore($quizId)
{
    // Récupérer les choix du stagiaire pour le quiz donné
    $quizChoicesIds = QuizQuestionChoice::where('quiz_id', $quizId)->pluck('choice_id');
    //return $quizChoicesIds;

    // Récupérer les choix corrects pour chaque question du quiz
    // $questionIds = $quizChoices->pluck('choice.question_id')->unique();

    $questionIds = Question_choix::whereIn('id',$quizChoicesIds)->pluck('question_id')->unique();
    //return $questionIds;

    $correctChoices = Question_choix::whereIn('question_id', $questionIds)
        ->where('estVrai', true)
        ->get();

    // Calculate the score based on the correct choices and the selected choices
    $score = 0;
    foreach ($questionIds as $questionId) {
        $correctChoiceIds = $correctChoices->where('question_id', $questionId)->pluck('id');
        $selectedChoiceIds = $quizChoicesIds->where('question_id', $questionId)->pluck('choice_id');

        // Check if all the correct choices are among the selected choices and vice versa
        $isAllCorrectSelected = $correctChoiceIds->diff($selectedChoiceIds)->isEmpty();
        $isAllSelectedCorrect = $selectedChoiceIds->diff($correctChoiceIds)->isEmpty();

        if ($isAllCorrectSelected && $isAllSelectedCorrect) {
            $score++;
        }
    }

    // Sauvegarder le score dans la table "quizzes" pour le stagiaire donné
    // $quiz = Quiz::find($quizId);
    // $quiz->score = $score;
    // $quiz->save();

    return $score;
}




    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\QuizQuestionChoice  $quizQuestionChoice
     * @return \Illuminate\Http\Response
     */
    public function show(QuizQuestionChoice $quizQuestionChoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\QuizQuestionChoice  $quizQuestionChoice
     * @return \Illuminate\Http\Response
     */
    public function edit(QuizQuestionChoice $quizQuestionChoice)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\QuizQuestionChoice  $quizQuestionChoice
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, QuizQuestionChoice $quizQuestionChoice)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\QuizQuestionChoice  $quizQuestionChoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(QuizQuestionChoice $quizQuestionChoice)
    {
        //
    }


    public function insert(Request $req)
    {

        try {

            $formData = $req->all(); // Get an array representation of the form data
            DB::table('quiz_question_choices')->insert($formData);

            // recupere quiz id pour calculer score
            $quizId = $formData[0]['quiz_id'];


            return json_encode(['score' => $this->calculateQuizScore($quizId)]);
        } catch (\Exception $e) {
            return json_encode(['isAdded' => '0', 'error' => $e->getMessage()]);
        }
    }

    // Fonction pour calculer le score du quiz pour un stagiaire donné



}
