<?php

namespace App\Http\Controllers;
use App\Models\Quiz_Questions_Reponse;
use Illuminate\Http\Request;

class QuizQuestionsReponseController extends Controller
{
    //

    public function index(){
        try{
            return Quiz_Questions_Reponse::all();
        } catch (\Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }
    }

    public function show($id){
        try{
            return Quiz_Questions_Reponse::find($id);
        } catch (\Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }
    }

    public function add(Request $req)
    {
        try {
            $Quiz_Questions_Reponse = new Quiz_Questions_Reponse();

            $Quiz_Questions_Reponse->question_id  = $req->input('question_id');
            $Quiz_Questions_Reponse->quiz_id = $req->input('quiz_id');
            $Quiz_Questions_Reponse->choi_id = $req->input('choi_id');

            $Quiz_Questions_Reponse->save();
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
            Quiz_Questions_Reponse::where('id', $id)->update($dataToUpdate);
            return json_encode(['isUpdated' => '1']);
        } catch (\Exception $e) {
            return json_encode(['isUpdated' => '0', 'error' => $e->getMessage()]);
        }
    }


    public function delete($id)
    {
        try {
            Quiz_Questions_Reponse::destroy($id);
            
            return json_encode(['isDeleted' => '1']);
        } catch (\Exception $e) {
            return json_encode(['isDeleted' => '0', 'error' => $e->getMessage()]);
        }
    }

}
