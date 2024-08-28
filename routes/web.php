<?php

use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\AudienceController;
// use App\Http\Controllers\SurveyController;
// use App\Http\Controllers\QuestionaireController;
// use App\Http\Controllers\QuestionTypeController;
// use App\Http\Controllers\QuestionController;
// use App\Http\Controllers\AnswerController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();


Route::group(['middleware' => 'auth'], function(){
    Route::get('/home', 'HomeController@home')->name('new-home');
    // Route::get('/dashboard', 'HomeController@index')->name('home');

    // Only varified emails can access these controllers or routes
    // Route::group(['middleware' => 'verified'], function(){

        Route::get('/dashboard', 'HomeController@index')->name('home');
        //
        Route::group(['middleware' => 'admin'], function(){

            // Post
            Route::post('/staff/{staff}/restore', 'UsersController@restore')->name('restore_user');
            Route::post('/staff/change-password', 'UsersController@postChangePassword')->name('user.postchangePassword');

            // Get
            Route::get('/qna', [App\Http\Controllers\QuestionFormController::class, 'index']);
            Route::post('/qna', [App\Http\Controllers\QuestionFormController::class, 'create_answer'])->name('create-question');
            
            
            Route::get('/api/questions', [App\Http\Controllers\QuestionController::class, 'get_questions']);


            // PATCH / PUT,
            Route::put('/staff/block/{obfuscator}/asuser/{firstname}-{lastname}', 'UsersController@block_user')->name('block_user');
            Route::patch('/staff/unblock/{obfuscator}/foruser/{firstname}-{lastname}', 'UsersController@unblock_user')->name('unblock_user');

            // DELETE
            Route::delete('/staff/{staff}/remove_user_account', 'UsersController@permanentely_delete')->name('remove_user');


            // Resources
            Route::resource('audit-trail', 'AuditTrailController');
            Route::resource('staff', 'UsersController');
            Route::resource('titles', 'TitlesController');
            Route::resource('user-roles', 'UserRolesController');
            Route::resource('employees', 'EmployeesController');
            Route::resource('departments', 'DepartmentsController');
            Route::resource('audiences', 'AudienceController');
            Route::resource('surveys', 'SurveyController');
            Route::resource('questionaires', 'QuestionaireController');
            Route::resource('question-type', 'QuestionTypeController');
            Route::resource('questions', 'QuestionController');
            Route::resource('answers', 'AnswerController');
            // Route::resource('qna', 'QuestionFormController');

            // Route::resources([
            //     'audiences' => AudienceController::class,
            //     'surveys' => SurveyController::class,
            //     'questionaires' => QuestionaireController::class,
            //     'question-types' => QuestionTypeController::class,
            //     'questions' => QuestionController::class,
            //     'answers' => AnswerController::class,
            // ]);


        });
    // });
});

Route::get('/survey/{survey_id}/fill/{questionaire_id}/ucaa', 'GuestController@get_form')->name('guest.form');
Route::post('/survey/{survey_id}/fill/{questionaire_id}/ucaa', 'GuestController@post_form')->name('guest.form.post');

// Debug
Route::get('drugqty', 'HomeController@drugqty');

Route::get('/no-cache', function() {
    $exitCode = Artisan::call('config:clear');
    echo 'Cache cleared';
});
