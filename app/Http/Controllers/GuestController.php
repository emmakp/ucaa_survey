<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Questionaire;
use App\Response;

class GuestController extends Controller
{
    public function get_form($survey_id, $questionaire_id, $jurisdiction = null)
    {
        $questionaire = Questionaire::where('obfuscator', $questionaire_id)
            ->where('survey_id', $survey_id)
            ->first();
        
        if (!$questionaire) {
            $questionaire = Questionaire::latest()->first();
            if (!$questionaire) {
                $questionaire = new Questionaire();
                $questionaire->obfuscator = $questionaire_id;
                $questionaire->survey_id = $survey_id;
                $questionaire->save(); // Save a default if none exist
            }
            $survey_id = $questionaire->survey_id;
            $questionaire_id = $questionaire->obfuscator;
        }

        return view('forms.survey-form')->with([
            'questionaire' => $questionaire,
            'survey_id' => $survey_id,
            'questionaire_id' => $questionaire_id,
            'jurisdiction' => $jurisdiction // Null for original guest form
        ]);
    }

    public function post_form(Request $request, $survey_id, $questionaire_id)
    {
        $response = new Response();
        $response->questionaire_id = $questionaire_id;
        $response->question_id = $request->input('question_id', 1);
        $response->response = json_encode($request->all());
        $response->save();
        return view('forms.thank-you');
    }
}