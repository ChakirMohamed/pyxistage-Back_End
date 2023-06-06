<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TypeStageController;
use App\Http\Controllers\StagiaireController;
use App\Http\Controllers\ResponsableController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\QuestionThemeController;
use App\Http\Controllers\NiveauQuestionController;
use App\Http\Controllers\QuestionController;
use App\Http\Controllers\QuestionChoixController;
use App\Http\Controllers\QuizQuestionsReponseController;
use App\Http\Controllers\UserController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::group(['middleware'=>['auth:sanctum']],function(){
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





    /****************************************** Quiz *******************************************/
    /*** theme_quiz ***/
    Route::group(['prefix' => 'theme'], function () {
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



/*les reponses des questions */
Route::group(['prefix' => 'reponses'], function () {
    Route::get('/', [QuizQuestionsReponseController::class, 'index']);
    Route::get('/{id}', [QuizQuestionsReponseController::class, 'show']);
    Route::post('/add', [QuizQuestionsReponseController::class, 'add']);
    Route::put('/update/{id}', [QuizQuestionsReponseController::class, 'update']);
    Route::delete('/delete/{id}', [QuizQuestionsReponseController::class, 'delete']);
});





    Route::get('/profile',[UserController::class,'profile']);
//});

/******** users et login ***************/
Route::post('/register',[UserController::class,'register']);
Route::post('/login',[UserController::class,'login']);









/*** Responsable **
Route::group(['prefix' => 'responsables'], function () {
    Route::get('/', [ResponsableController::class, 'index']);
    Route::get('/{id}', [ResponsableController::class, 'show']);
    Route::post('/add', [ResponsableController::class, 'add']);
    Route::put('/update/{id}', [ResponsableController::class, 'update']);
    Route::delete('/delete/{id}', [ResponsableController::class, 'delete']);
});

*/





/*** question ***/
Route::get('questions',[QuestionController::class,'index']);
Route::get('questions/{id}',[QuestionController::class,'show']);
Route::post('questions/add',[QuestionController::class,'add']);
Route::put('questions/update/{id}',[QuestionController::class,'update']);
Route::delete('questions/delete/{id}',[QuestionController::class,'delete']);
// filter par niveau et|ou theme
Route::delete('questions/f',[QuestionController::class,'filter']);


