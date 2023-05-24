<?php

namespace App\Http\Controllers;
use App\Models\Responsable;
use Illuminate\Http\Request;

class ResponsableController extends Controller
{
    //

    
    public function index(){
        try{
            return Responsable::all();
        } catch (\Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }
    }

    public function show($id){
        try{
            return Responsable::find($id);
        } catch (\Exception $e) {
            return json_encode(['error' => $e->getMessage()]);
        }
    }

    public function add(Request $req)
    {
        try {
            $responsable = new Responsable();

            $responsable->userName = $req->input('userName');
            $responsable->nom  = $req->input('nom');
            $responsable->passwordHash  = bcrypt($req->input('passwordHash'));

            /*
                if (password_verify($userProvidedPassword, $hashedPassword)) {
                    // Password is correct
                    // Proceed with the authentication logic
                } else {
                    // Password is incorrect
                    // Handle the invalid password case
                }
            */
            

            $responsable->save();
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
            Responsable::where('id', $id)->update($dataToUpdate);
                
            return json_encode(['isUpdated' => '1']);
        } catch (\Exception $e) {
            return json_encode(['isUpdated' => '0', 'error' => $e->getMessage()]);
        }
    }


    public function delete($id)
    {
        try {
            Responsable::destroy($id);
            
            return json_encode(['isDeleted' => '1']);
        } catch (\Exception $e) {
            return json_encode(['isDeleted' => '0', 'error' => $e->getMessage()]);
        }
    }
}
