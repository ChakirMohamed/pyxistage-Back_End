<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TypeStageController;
use App\Http\Controllers\StagiaireController;
use App\Http\Controllers\ResponsableController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\QuestionThemeController;
use App\Http\Controllers\NiveauQuestionController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuestionChoixController;
use App\Http\Controllers\QuizQuestionsReponseController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\sendInvitation;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\QuizQuestionChoiceController;
use App\Models\Quiz;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);

Route::group(['middleware' => ['auth:sanctum']], function () {
    Route::get('/user', [UserController::class, 'profile']);
    Route::post('/logout', [UserController::class, 'logout']);

    /*** Type Stage ***/
    Route::group(['prefix' => 'typeStages'], function () {
        Route::get('/', [TypeStageController::class, 'index']);
        Route::get('/{id}', [TypeStageController::class, 'show']);
        Route::post('/add', [TypeStageController::class, 'add']);
        Route::put('/update/{id}', [TypeStageController::class, 'update']);
        Route::delete('/delete/{id}', [TypeStageController::class, 'delete']);
    });


    /*** Stagiaire ***/
    Route::group(['prefix' => 'stagiaires'], function () {
        Route::get('/', [StagiaireController::class, 'index']);
        Route::get('/{id}', [StagiaireController::class, 'show']);
        Route::post('/add', [StagiaireController::class, 'add']);
        Route::put('/update/{id}', [StagiaireController::class, 'update']);
        Route::delete('/delete/{id}', [StagiaireController::class, 'delete']);
    });

    /*** Comments ***/
    Route::group(['prefix' => 'comments'], function () {
        Route::get('stagiaire/{idStagiaire}', [CommentsController::class, 'comments_stagiaire']);
        Route::get('/{id}', [CommentsController::class, 'show']);
        Route::post('/add', [CommentsController::class, 'add']);
        Route::put('/update/{id}', [CommentsController::class, 'update']);
        Route::delete('/delete/{id}', [CommentsController::class, 'delete']);
    });


    //Quiz generate
    Route::group(['prefix' => 'quiz'], function () {
        Route::post('/generate', [QuestionController::class, 'generateQuiz']);
    });


    /****************************************** Quiz *******************************************/
    /*** theme_quiz ***/
    Route::group(['prefix' => 'themes'], function () {
        Route::get('/', [QuestionThemeController::class, 'index']);
        Route::get('/{id}', [QuestionThemeController::class, 'show']);
        Route::post('/add', [QuestionThemeController::class, 'add']);
        Route::put('/update/{id}', [QuestionThemeController::class, 'update']);
        Route::delete('/delete/{id}', [QuestionThemeController::class, 'delete']);
    });

    /*** niveau_quiz ***/
    Route::group(['prefix' => 'niveau'], function () {
        Route::get('/', [NiveauQuestionController::class, 'index']);
        Route::get('/{id}', [NiveauQuestionController::class, 'show']);
        Route::post('/add', [NiveauQuestionController::class, 'add']);
        Route::put('/update/{id}', [NiveauQuestionController::class, 'update']);
        Route::delete('/delete/{id}', [NiveauQuestionController::class, 'delete']);
    });

    /* choix */
    Route::group(['prefix' => 'choix'], function () {
        Route::get('/', [QuestionChoixController::class, 'index']);
        Route::get('/{id}', [QuestionChoixController::class, 'show']);
        Route::post('/add', [QuestionChoixController::class, 'add']);
        Route::put('/update/{id}', [QuestionChoixController::class, 'update']);
        Route::delete('/delete/{id}', [QuestionChoixController::class, 'delete']);
    });


    /*** question ***/
    Route::prefix('questions')->group(function () {

        Route::get('/cat_ques', [QuestionController::class, 'getQuestionsForEachCategory']);
        Route::get('/', [QuestionController::class, 'index']);
        Route::get('/{id}', [QuestionController::class, 'show']);
        Route::post('/add', [QuestionController::class, 'add']);
        Route::put('/update/{id}', [QuestionController::class, 'update']);
        Route::delete('/delete/{id}', [QuestionController::class, 'delete']);
        Route::post('/insert', [QuestionController::class, 'insert']);
    });



    /*les reponses des questions */
    Route::group(['prefix' => 'reponses'], function () {
        Route::get('/', [QuizQuestionsReponseController::class, 'index']);
        Route::get('/{id}', [QuizQuestionsReponseController::class, 'show']);
        Route::post('/add', [QuizQuestionsReponseController::class, 'add']);
        Route::put('/update/{id}', [QuizQuestionsReponseController::class, 'update']);
        Route::delete('/delete/{id}', [QuizQuestionsReponseController::class, 'delete']);
    });

    // filter par niveau et|ou theme
    Route::get('questions/f', [QuestionController::class, 'filter']);




    // upload files
    Route::post('/upload-file', [FileController::class, 'uploadFile']);
    // get files
    Route::get('/cv/uploads/{filename}', [FileController::class, 'show']);
    // send invitation
    Route::post('/send-invitation', [sendInvitation::class, 'sendInvitation']);
});




//Route::group(['middleware'=>['auth:sanctum']],function(){











//});




// Quiz pour stagiaire
Route::get('/quiz/{urlQuiz}', [QuestionController::class, 'getQuestionForQuiz']);
Route::get('/quiz/show/{urlQuiz}', [QuizController::class, 'show']);
Route::post('/quiz/reponses/insert', [QuizQuestionChoiceController::class, 'insert']);










/*** Responsable **
Route::group(['prefix' => 'responsables'], function () {
    Route::get('/', [ResponsableController::class, 'index']);
    Route::get('/{id}', [ResponsableController::class, 'show']);
    Route::post('/add', [ResponsableController::class, 'add']);
    Route::put('/update/{id}', [ResponsableController::class, 'update']);
    Route::delete('/delete/{id}', [ResponsableController::class, 'delete']);
});

 */
