<?php

namespace App\Http\Controllers;
use App\Models\Question_Choix;
use Illuminate\Http\Request;

class QuestionChoixController extends Controller
{
    //

    public function index(){
        try{
            return Question_Choix::all();
        } catch (\Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }
    }

    public function show($id){
        try{
            return Question_Choix::find($id);
        } catch (\Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }
    }

    public function add(Request $req)
    {
        try {
            $choix = new Question_Choix();

            $choix->question_id = $req->input('question_id');
            $choix->estVrai  = $req->input('estVrai');
            $choix->choix = $req->input('choix');
            


            $choix->save();
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
            Question_Choix::where('id', $id)->update($dataToUpdate);
            return json_encode(['isUpdated' => '1']);
        } catch (\Exception $e) {
            return json_encode(['isUpdated' => '0', 'error' => $e->getMessage()]);
        }
    }


    public function delete($id)
    {
        try {
            Question_Choix::destroy($id);
            
            return json_encode(['isDeleted' => '1']);
        } catch (\Exception $e) {
            return json_encode(['isDeleted' => '0', 'error' => $e->getMessage()]);
        }
    }

}
