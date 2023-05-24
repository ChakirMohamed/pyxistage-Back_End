<?php

namespace App\Http\Controllers;
use App\Models\Question;
use App\Models\Niveau_question;
use App\Models\question_theme;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    // 


    public function index(){
        try{
            

            //return Question::all();
            $questions = Question::all();

        foreach ($questions as $question) {
            $niveau = Niveau_question::find($question->niveau_question_id)->libelle;
            $theme = question_theme::find($question->theme_question_id)->title;

            $question->niveau = $niveau;
            $question->theme = $theme;
        }

        return response()->json($questions);

        } catch (\Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }
    }

    public function show($id){
        try{
            
            $question = Question::find($id);

            $niveau = Niveau_question::find($question->niveau_question_id)->libelle;
            $theme = question_theme::find($question->theme_question_id)->title ;

            //return // je veux ajouter les variables $niveau et $theme au objet $question et le return
            $question->niveau = $niveau;
            $question->theme = $theme;
    
            return response()->json($question);


        } catch (\Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }
    }

    public function add(Request $req)
    {
        try {
            $typeStage = new Question();

            $typeStage->question = $req->input('question');
            $typeStage->niveau_question_id = $req->input('niveau_question_id');
            $typeStage->theme_question_id = $req->input('theme_question_id');
            
            $typeStage->save();
            return json_encode(['isAdded' => '1']);
        } catch (\Exception $e) {
            return json_encode(['isAdded' => '0', 'error' => $e->getMessage()]);
        }
    }

    public function update(Request $req, $id)
    {
        try {
            $dataToUpdate = $req->all();

            // Remove any fields with null values from the dataToUpdate array
            $dataToUpdate = array_filter($dataToUpdate, function ($value) {
                return $value !== null;
            });

            // Update the fields that are not null
            Question::where('id', $id)->update($dataToUpdate);
            return json_encode(['isUpdated' => '1']);
        } catch (\Exception $e) {
            return json_encode(['isUpdated' => '0', 'error' => $e->getMessage()]);
        }
    }


    public function delete($id)
    {
        try {
            Question::destroy($id);
            
            return json_encode(['isDeleted' => '1']);
        } catch (\Exception $e) {
            return json_encode(['isDeleted' => '0', 'error' => $e->getMessage()]);
        }
    }

    public function filter(Request $req)
    {
        return json_encode(['isDeleted' => '1']);
        //return" Question::all();";
        /*
        $idNiveau = $req->input('niveau_question_id');
        $idTheme = $req->input('theme_question_id');

        if ($idNiveau && $idTheme) {
            $records = Question::where('niveau_question_id', $idNiveau)
                ->where('theme_question_id', $idTheme)
                ->get();
        } elseif ($idNiveau) {
            $records = Question::where('niveau_question_id', $idNiveau)
                ->get();
        } elseif ($idTheme) {
            $records = Question::where('theme_question_id', $idTheme)
                ->get();
        } else {
            return Question::all();
        }

        return $records;
        */
    }

}
