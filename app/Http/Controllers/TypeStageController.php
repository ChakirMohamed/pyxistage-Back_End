<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\typeStage;

class TypeStageController extends Controller
{
    
    public function index(){
        try{
            return typeStage::all();
        } catch (\Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }
    }

    public function show($id){
        try{
            return typeStage::find($id);
        } catch (\Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }
    }

    public function add(Request $req)
    {
        try {
            $typeStage = new TypeStage();
            $typeStage->libelle = $req->input('libelle');
            $typeStage->save();
            return json_encode(['isAdded' => '1']);
        } catch (\Exception $e) {
            return json_encode(['isAdded' => '0', 'error' => $e->getMessage()]);
        }
    }

    public function update(Request $req, $id)
    {
        try {
            $newLibelle = $req->input('libelle');
            
            typeStage::where('id',$id)->update(
                [
                    'libelle'=>$newLibelle
                ]
                );
            return json_encode(['isUpdated' => '1']);
        } catch (\Exception $e) {
            return json_encode(['isUpdated' => '0', 'error' => $e->getMessage()]);
        }
    }


    public function delete($id)
    {
        try {
            TypeStage::destroy($id);
            
            return json_encode(['isDeleted' => '1']);
        } catch (\Exception $e) {
            return json_encode(['isDeleted' => '0', 'error' => $e->getMessage()]);
        }
    }

}
