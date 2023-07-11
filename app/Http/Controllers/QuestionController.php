<?php

namespace App\Http\Controllers;

use App\Mail\MailQuizUrl;
use App\Models\Question;
use App\Models\Question_Choix;
use App\Models\Niveau_question;
use App\Models\question_theme;
use App\Models\Quiz;

use Illuminate\Support\Facades\DB;
use Exception;
use GuzzleHttp\Psr7\Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class QuestionController extends Controller
{
    //


    public function index()
    {
        try {


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

    public function show($id)
    {
        try {

            $question = Question::find($id);

            $niveau = Niveau_question::find($question->niveau_question_id)->libelle;
            $theme = question_theme::find($question->theme_question_id)->title;

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
    public function insert(Request $req)
    {
        //return response()->json($req);
        try {
            $questions = $req->questions;
            $catId = intval($req->categorieId);
            $nivId = intval($req->niveauId);
            // Parcourir chaque question
            foreach ($questions as $question) {
                // Insérer la question et obtenir son ID
                $questionModel = Question::create([
                    'question' => $question['questionText'],
                    //'duration' => $question['questionDuree'],
                    'duration' => '00:30',
                    'niveau_question_id' => $nivId,
                    'theme_question_id' => $catId
                ]);
                $questionId = $questionModel->id;

                // Parcourir chaque réponse de la question
                foreach ($question['answers'] as $answer) {
                    // Insérer la réponse avec la clé étrangère de la question
                    Question_Choix::create([
                        'question_id' => $questionId,
                        'choix' => $answer['text'],
                        'estVrai' => $answer['correct'],
                    ]);
                }
            }
            return response()->json(['message' => 'success']);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage()], 400);
        }

        //Question::insert();
    }


    public function getQuestionsForEachCategory()
    {

        try {
            $categories = question_theme::all(); // Assuming you have a model named 'Categorie' for categories
            $questionsForEachCategory = [];

            $i = 0;
            foreach ($categories as $category) {
                $categoryId = $category->id;
                $questions = Question::where('theme_question_id', $categoryId)->get();
                $i++;
                $questionsForEachCategory[$category->title] = $questions;
            }

            return response()->json($questionsForEachCategory);
        } catch (Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'error' => $e->getTraceAsString()], 400);
        }
    }

    public function generateQuiz(Request $req)
    {
        try {

            $req->validate([
                'niveau_question_id' => 'required',
                'theme_question_id' => 'required',
                'stagiaire_id' => 'required',
                'number_question' => 'required'
            ]);

            $uniqueUrl = md5(uniqid(rand(), true));
            $idNiv = intval($req->niveau_question_id);
            $idCat = intval($req->theme_question_id);
            $idStagiaire = intval($req->stagiaire_id);
            $nbrQuestion = intval($req->number_question);
            $hostQuiz = $req->hostQuiz;
            $mail = $req->mail;

            $randomQuestionIds = DB::table('questions')
                ->where('niveau_question_id', $idNiv)
                ->where('theme_question_id', $idCat)
                ->inRandomOrder()
                ->take($nbrQuestion)
                ->pluck('id');

            // si le nombre des question exist dans base donnees insuffisant
            if (count($randomQuestionIds) < $nbrQuestion) {
                return response()->json(["message", "Nombre des question existe insuffisant"],400);
            }

            $quiz = Quiz::create([
                'stagiaire_id' => $idStagiaire,
                'niveau_question_id' => $idNiv,
                'theme_question_id' => $idCat,
                'url' => $uniqueUrl,
            ]);

            $data = [];

            foreach ($randomQuestionIds as $questionId) {
                $data[] = [
                    'quiz_id' => $quiz->id,
                    'question_id' => $questionId
                ];
            }
            DB::table('quiz__questions')->insert($data);

            $this->sendQuizUrl($mail,$hostQuiz.$quiz->url);

            return response()->json($quiz);


        } catch (\Exception $e) {
            //throw $th;
            return response()->json(['message' => $e->getMessage()], 400);
        }
    }

    public function getQuestionForQuiz($quizUrl){
        try{
            /** get quiz par lien */
        $quiz = Quiz::where('url', $quizUrl)->first();

        //if (!$quiz || $quiz->expiration_date < now()) {
        if (!$quiz ) {
            return response()->json(['message' => "quiz n'existe pas"], 400);
        }
        $questionIds = DB::table('quiz__questions')
        ->where('quiz_id',$quiz->id)
        ->pluck('question_id');



        $questions = DB::table('questions')
        ->whereIn('id', $questionIds)
        ->get();

        // Iterate through each question
        foreach ($questions as $question) {
            // Get the question ID
            $questionId = $question->id;

            // Fetch the responses for the current question
            $responses = Question_Choix::where('question_id', $questionId)->get();

            foreach($responses as $c){
                $c->selected = false;
            }

            // Add the responses to the question object
            $question->responses = $responses;
        }

        return response()->json(['questions' => $questions,'quiz'=>$quiz]);
        }
        catch (\Exception $e) {
            //throw $th;
            return response()->json(['message' => $e->getMessage()], 400);
        }

    }




    public function sendQuizUrl($email,$url){
        $data = [
            'url'=>$url
        ];
        Mail::to($email)->send(new MailQuizUrl($data));
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
