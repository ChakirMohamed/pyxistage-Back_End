<?php

namespace App\Http\Controllers;

use App\Models\QuizQuestionChoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuizQuestionChoiceController extends Controller
{
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


    public function insert(Request $req){

        try
        {
        $formData = $req->all(); // Get an array representation of the form data
        DB::table('quiz_question_choices')->insert($formData);

        return json_encode(['isDeleted' => '1']);
    } catch (\Exception $e) {
        return json_encode(['isDeleted' => '0', 'error' => $e->getMessage()]);
    }

    }
}
