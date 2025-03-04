<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\AnswerController;

Route::get('/', function () {
    $questionaire = \App\Questionaire::latest()->first();
    if (!$questionaire) {
        $questionaire = new \App\Questionaire();
        $questionaire->obfuscator = 'initial-survey';
        $questionaire->survey_id = 1;
        $questionaire->validity = true;
        $questionaire->target_audience = 1;
        $questionaire->save();
    }
    return view('forms.survey-form')->with([
        'questionaire' => $questionaire,
        'survey_id' => $questionaire->survey_id,
        'questionaire_id' => $questionaire->obfuscator
    ]);
})->name('survey.welcome');

Route::get('/survey/{surveyId}/departments/{audienceType}', [SurveyController::class, 'showDepartments'])->name('survey.departments');
Route::get('/survey/{surveyId}/questions/{audienceType}/{department}', [SurveyController::class, 'getSurveyQuestions'])->name('survey.questions');
Route::get('/survey/{surveyId}/{questionaireId}/{audienceType}', function ($surveyId, $questionaireId, $audienceType) {
    return redirect()->route('survey.departments', ['surveyId' => $surveyId, 'audienceType' => $audienceType]);
})->name('survey.audience');

// Route::get('/answers/{submission}', [AnswerController::class, 'show'])->name('answers.show');

// Original guest form route (for back office links)
Route::get('/survey/{survey_id}/fill/{questionaire_id}/ucaa', 'GuestController@get_form')->name('guest.form');
// Route::post('/survey/{survey_id}/fill/{questionaire_id}/ucaa', 'GuestController@post_form')->name('guest.form.post');
Route::post('/survey/{survey_id}/fill/{questionaire_id}/ucaa', [SurveyController::class, 'fill'])->name('guest.form.post');

// Jurisdiction-specific survey routes
Route::get('/survey/{survey_id}/{questionaire_id}/passenger', function ($survey_id, $questionaire_id) {
    return app('App\Http\Controllers\GuestController')->get_form($survey_id, $questionaire_id, 'passenger');
})->name('survey.passenger');
Route::get('/survey/{survey_id}/{questionaire_id}/staff', function ($survey_id, $questionaire_id) {
    return app('App\Http\Controllers\GuestController')->get_form($survey_id, $questionaire_id, 'staff');
})->name('survey.staff');

Route::get('/survey/{surveyId}/check-published', [SurveyController::class, 'checkPublished'])->name('survey.checkPublished');

Auth::routes();

// Authenticated routes
Route::group(['middleware' => 'auth'], function () {
    // Route::get('/home', 'HomeController@home')->name('new-home');
    Route::get('/home', 'HomeController@index')->name('new-home');
    Route::get('/dashboard', 'HomeController@index')->name('home');

    Route::group(['middleware' => 'admin'], function () {

        Route::get('/answers/{submission}', [AnswerController::class, 'show'])->name('answers.show');
        Route::post('/staff/{staff}/restore', 'UsersController@restore')->name('restore_user');
        Route::post('/staff/change-password', 'UsersController@postChangePassword')->name('user.postchangePassword');
        Route::put('/staff/block/{obfuscator}/asuser/{firstname}-{lastname}', 'UsersController@block_user')->name('block_user');
        Route::patch('/staff/unblock/{obfuscator}/foruser/{firstname}-{lastname}', 'UsersController@unblock_user')->name('unblock_user');
        Route::delete('/staff/{staff}/remove_user_account', 'UsersController@permanentely_delete')->name('remove_user');

        Route::get('/qna', [App\Http\Controllers\QuestionFormController::class, 'index'])->name('qna.index');
        Route::post('/qna', [App\Http\Controllers\QuestionFormController::class, 'create_answer'])->name('create-question');

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
    });
});

// Debug routes
Route::get('/drugqty', 'HomeController@drugqty')->middleware('auth');
Route::get('/no-cache', function () {
    $exitCode = Artisan::call('config:clear');
    echo 'Cache cleared';
});