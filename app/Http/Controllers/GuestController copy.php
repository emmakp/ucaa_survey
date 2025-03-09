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

    // public function post_form($survey_id, $questionaire_id){
    //     $response = new Response();
    //     $response->questionaire_id = 3;
    //     $response->question_id = 8;
    //     $response->response = 'yes';
    //     $response->save();
    //     return view('forms.thank-you');
    // }

    public function post_form(Request $request, $survey_id, $questionaire_id)
{
    try {
        $answers = $request->all();
        $jurisdiction = $request->input('jurisdiction', 'unknown');

        foreach ($answers as $questionKey => $answer) {
            if (strpos($questionKey, 'question_') === 0) {
                $questionId = str_replace('question_', '', $questionKey);
                $response = new Response();
                $response->survey_id = $survey_id;
                $response->questionaire_id = $questionaire_id;
                $response->question_id = $questionId;
                $response->answer = $answer;
                $response->audience_type = $jurisdiction;
                $response->submitted_at = now();
                $response->save();
            }
        }

        // return response()->json(['message' => 'Survey submitted successfully'], 200);
        return view('forms.thank-you');
    } catch (\Exception $e) {
        \Log::error('Survey submission failed: ' . $e->getMessage());
        return response()->json(['error' => 'Failed to submit survey'], 500);
    }
}
}
