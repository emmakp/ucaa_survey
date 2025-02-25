<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Questionaire;
use App\Response;

class GuestController extends Controller
{
    //
    public function get_form($survey_id, $questionaire_id){
        $questionaire = Questionaire::where('obfuscator', $questionaire_id)->with(['survey','target_audience_rq','questions'])->first();
        // print_r($questionaire->questions);exit;

        return view('forms.survey-form')->with(['questionaire' => $questionaire]);
    }

    public function post_form($survey_id, $questionaire_id){
        $response = new Response();
        $response->questionaire_id = 1;
        $response->question_id = 8;
        $response->response = 'yes';
        $response->save();

        return json_encode(["save" => "true"]);
        // return view('forms.thank-you');
    }

    public function get_questions() {
         $questionaire = Questionaire::with(['survey','target_audience_rq','questions'])->get();
         return response()->json($questionaire);
    }
}
