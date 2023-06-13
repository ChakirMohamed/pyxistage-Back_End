<?php

namespace App\Http\Controllers;
use App\Models\stagiaire;
use Illuminate\Support\Facades\Storage;

use Illuminate\Http\Request;

class FileController extends Controller
{
    //
    public function uploadFile(Request $request)
    {
        if ($request->hasFile('file')) {
            $stagiaireId = $request->query('stagiaire_id');
            $file = $request->file('file');
            $filePath = $file->store('uploads'); // Store the file in the 'uploads' directory
            // Mise à jour du champ "cv" de la table "stagiaires"
            $stagiaire = Stagiaire::find($stagiaireId);
            $stagiaire->cvPath = $filePath;
            $stagiaire->save();
            return response()->json(['message' => 'File uploaded successfully']);
        }
        return response()->json(['message' => 'No file uploaded'], 400);
    }

    public function show($filename)
    {
        $path = storage_path('app/' . $filename );

        if (!Storage::exists($path)) {
            abort(404);
        }

        return response()->file($path);
    }
}
