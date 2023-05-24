<?php

namespace App\Http\Controllers;
use App\Models\comments;
use Illuminate\Http\Request;

class CommentsController extends Controller
{
    //


    public function comments_stagiaire( $idStagiaire)
    {
        try {
            
            // Update the fields that are not null
            return comments::where('stagiaire_id', $idStagiaire)->orderBy('created_at')->get();

        } catch (\Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }
    }


    public function show($id){
        try{
            return comments::find($id);
        } catch (\Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }
    }

    public function add(Request $req)
    {
        try {
            $comment = new comments();

            $comment ->commentaire  = $req->input('commentaire');
            $comment ->stagiaire_id   = $req->input('stagiaire_id');

            $comment->save();
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
            comments::where('id', $id)->update($dataToUpdate);
                
            return json_encode(['isUpdated' => '1']);
        } catch (\Exception $e) {
            return json_encode(['isUpdated' => '0', 'error' => $e->getMessage()]);
        }
    }


    public function delete($id)
    {
        try {
            comments::destroy($id);
            
            return json_encode(['isDeleted' => '1']);
        } catch (\Exception $e) {
            return json_encode(['isDeleted' => '0', 'error' => $e->getMessage()]);
        }
    }
}
