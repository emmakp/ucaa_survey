<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Questionaire;
use App\Response;

class GuestController2 extends Controller
{
    //
    // public function get_form($survey_id, $questionaire_id){
    //     $questionaire = Questionaire::where('obfuscator', $questionaire_id)->first();

    //     return view('forms.survey-form')->with(['questionaire' => $questionaire]);
    // }
    public function get_form($survey_id, $questionaire_id, $jurisdiction = null)
{
    $questionaire = Questionaire::where('obfuscator', $questionaire_id)->first();
    if (!$questionaire) {
        $questionaire = new Questionaire();
        $questionaire->obfuscator = $questionaire_id;
        $questionaire->survey_id = $survey_id;
    }
    // dd($survey_id, $questionaire_id, $jurisdiction, $questionaire); // Debug
    return view('forms.survey-form')->with([
        'questionaire' => $questionaire,
        'jurisdiction' => $jurisdiction ?? 'passenger'
    ]);
}

    public function post_form($survey_id, $questionaire_id){
        $response = new Response();
        $response->questionaire_id = 3;
        $response->question_id = 8;
        $response->response = 'yes';
        $response->save();
        return view('forms.thank-you');
    }
}
