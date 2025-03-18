<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SurveyController;
use App\Http\Controllers\AnswerController;

// Route::get('/', function () {
//     $questionaire = \App\Questionaire::latest()->first();
//     if (!$questionaire) {
//         $questionaire = new \App\Questionaire();
//         $questionaire->obfuscator = 'initial-survey';
//         $questionaire->survey_id = 1;
//         $questionaire->validity = true;
//         $questionaire->target_audience = 1;
//         $questionaire->save();
//     }
//     return view('forms.survey-form')->with([
//         'questionaire' => $questionaire,
//         'survey_id' => $questionaire->survey_id,
//         'questionaire_id' => $questionaire->obfuscator
//     ]);
// })->name('survey.welcome');




// Route::get('/', function () {
//     // Find the latest active, published survey’s questionnaire
//     $questionaire = \App\Questionaire::whereHas('survey', function ($query) {
//         $query->where('status', 'active')->where('published', true);
//     })->latest()->first();

//     if (!$questionaire) {
//         $survey = \App\Survey::create([
//             'title' => 'Passenger Survey',
//             'obfuscator' => \Illuminate\Support\Str::random(10),
//             'created_by' => 1,
//             'status' => 'active',
//             'published' => true,
//         ]);

//         $questionaire = \App\Questionaire::create([
//             'obfuscator' => 'initial-survey',
//             'survey_id' => $survey->id,
//             'validity' => true,
//             'target_audience' => 1,
//         ]);
//     }

//     return view('forms.survey-form')->with([
//         'questionaire' => $questionaire,
//         'survey_id' => $questionaire->survey_id,
//         'questionaire_id' => $questionaire->obfuscator
//     ]);
// })->name('survey.welcome');

Route::get('/', function () {
    // Get the latest published survey
    $survey = \App\Survey::where('published', true)
                         ->orderBy('id', 'desc')
                         ->first();

    if (!$survey) {
        return view('forms.no-survey')->with([
            'message' => 'No survey is currently published. Please check back later or contact support.'
        ]);
    }

    // Fetch valid audiences for the survey from the back office
    $audiences = $survey->audiences()
                       ->where('validity', true)
                       ->pluck('name')
                       ->toArray();

    if (empty($audiences)) {
        return view('forms.no-survey')->with([
            'message' => 'The published survey has no valid audiences assigned.'
        ]);
    }

    // Get the first questionnaire for this survey (or adjust based on your JS logic)
    $questionaire = \App\Questionaire::where('survey_id', $survey->id)
                                    ->where('validity', true)
                                    ->first();

    if (!$questionaire) {
        return view('forms.no-survey')->with([
            'message' => 'The published survey has no valid questionnaires assigned.'
        ]);
    }

    \Illuminate\Support\Facades\Log::info("Root route: survey_id = {$survey->id}, audiences = " . implode(', ', $audiences));

    return view('forms.survey-form')->with([
        'questionaire' => $questionaire,
        'survey_id' => $survey->id,
        'audiences' => $audiences, // Pass all valid audiences for JS to handle
    ]);
})->name('survey.welcome');

// Route::get('/', function () {
//     // Get the latest published survey
//     $survey = \App\Survey::where('published', true)
//                          ->orderBy('id', 'desc')
//                          ->first();

//     if (!$survey) {
//         // No published survey exists - show a placeholder or error
//         return view('forms.no-survey')->with([
//             'message' => 'No survey is currently published. Please check back later or contact support.'
//         ]);
//     }

//     // Fetch audiences for the survey
//     $audiences = $survey->audiences()->where('validity', true)->pluck('name')->toArray();

//     // Redirect to department selection with the first audience (or handle multi-audience choice)
//     if (empty($audiences)) {
//         return view('forms.no-survey')->with([
//             'message' => 'The published survey has no valid audiences assigned.'
//         ]);
//     }

//     $firstAudience = $audiences[0]; // Default to the first audience
//     return redirect()->route('survey.departments', [
//         'surveyId' => $survey->id,
//         'audienceType' => $firstAudience
//     ]);
// })->name('survey.welcome');


Route::get('/survey/{surveyId}/departments/{audienceType}', [SurveyController::class, 'showDepartments'])->name('survey.departments');
Route::get('/survey/{surveyId}/questions/{audienceType}/{department}', [SurveyController::class, 'getSurveyQuestions'])->name('survey.questions');
Route::get('/survey/{surveyId}/{questionaireId}/{audienceType}', function ($surveyId, $questionaireId, $audienceType) {
    return redirect()->route('survey.departments', ['surveyId' => $surveyId, 'audienceType' => $audienceType]);
})->name('survey.audience');

// Route::get('/answers/{submission}', [AnswerController::class, 'show'])->name('answers.show');

// Original guest form route (for back office links)
// Route::get('/survey/{survey_id}/fill/{questionaire_id}/ucaa', 'GuestController@get_form')->name('guest.form');
Route::get('/survey/{survey_id}/fill/{questionaire_id}/ucaa', [SurveyController::class, 'getGuestForm'])->name('guest.form');
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

Route::post('/jurisdictions/store', [JurisdictionController::class, 'store'])->name('jurisdictions.store');

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
        Route::get('/surveys/{survey}/questionnaires', [SurveyController::class, 'manageQuestionnaires'])->name('surveys.questionnaires');
        Route::resource('questionaires', 'QuestionaireController');
        Route::resource('question-type', 'QuestionTypeController');
        Route::resource('questions', 'QuestionController');
        Route::resource('answers', 'AnswerController');
        Route::resource('jurisdictions', 'JurisdictionController');
    });
});


// Debug routes. need auth for access
Route::group(['middleware' => 'auth'], function () {
    Route::group(['middleware' => 'admin'], function () {
        // With supperuser access
        
        // Debug routes
        Route::get('/drugqty', 'HomeController@drugqty')->middleware('auth');
        Route::get('/no-cache', function () {
            $exitCode = Artisan::call('config:clear');
            echo 'Cache cleared';
        });
        
        Route::get('/db-fresh-cuts-lol', function() {
            $freshdb = Artisan::call('migrate:fresh');
            $seed_data = Artisan::call('db:seed');
            echo 'Freshly done, seeded data';
            // return what you want
        });
        
        Route::get('/cls-conf', function() {
            $seed_data = Artisan::call('cache:clear');
            $fresh_db = Artisan::call('config:clear');
            $seed_data = Artisan::call('config:cache');
            echo 'Config and cache data clear and reconfigured';
            // return what you want
        });
    });
});