<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Niveau_question;
class NiveauQuestionController extends Controller
{
    //


    public function index(){
        try{
            return Niveau_question::all();
        } catch (\Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }
    }

    public function show($id){
        try{
            return Niveau_question::find($id);
        } catch (\Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }
    }

    public function add(Request $req)
    {
        try {
            $typeStage = new Niveau_question();
            $typeStage->libelle   = $req->input('libelle');
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
            Niveau_question::where('id', $id)->update($dataToUpdate);
            return json_encode(['isUpdated' => '1']);
        } catch (\Exception $e) {
            return json_encode(['isUpdated' => '0', 'error' => $e->getMessage()]);
        }
    }


    public function delete($id)
    {
        try {
            Niveau_question::destroy($id);
            
            return json_encode(['isDeleted' => '1']);
        } catch (\Exception $e) {
            return json_encode(['isDeleted' => '0', 'error' => $e->getMessage()]);
        }
    }
}
