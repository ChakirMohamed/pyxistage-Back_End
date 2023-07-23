<?php

namespace App\Http\Controllers;

use App\Models\stagiaire;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class StagiaireController extends Controller
{
    //

    public function index(){
        try{
            return stagiaire::all();
        } catch (\Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }
    }

    public function show($id){
        try{
            return stagiaire::find($id);
        } catch (\Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }
    }

    public function add(Request $req)
    {
        try {
            $stagiaire = new stagiaire();

            $stagiaire->nom = $req->input('nom');
            $stagiaire->tel = $req->input('tel');
            $stagiaire->mail = $req->input('mail');
            $stagiaire->statut = $req->input('statut');
            $stagiaire->dateDebut = $req->input('dateDebut');
            $stagiaire->dateFin = $req->input('dateFin');
            $stagiaire->cvPath = $req->input('cvPath');
            $stagiaire->respo_id = $req->input('respo_id');
            $stagiaire->type_stage_id = $req->input('type_stage_id');


            $stagiaire->save();
            return json_encode(['isAdded' => '1','id'=>$stagiaire->id]);
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
            stagiaire::where('id', $id)->update($dataToUpdate);

            return json_encode(['isUpdated' => '1']);
        } catch (\Exception $e) {
            return json_encode(['isUpdated' => '0', 'error' => $e->getMessage()]);
        }
    }



    public function delete($id)
    {
        try {

            // trouver stagiaire
            $stagiaire = Stagiaire::find($id);

            // Supprimer l'ancien fichier s'il existe
            if ($stagiaire->cvPath && Storage::exists($stagiaire->cvPath)) {
                Storage::delete($stagiaire->cvPath);
            }
            
            stagiaire::destroy($id);

            return json_encode(['isDeleted' => '1']);
        } catch (\Exception $e) {
            return json_encode(['isDeleted' => '0', 'error' => $e->getMessage()]);
        }
    }
}
