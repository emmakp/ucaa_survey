<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Option;
use App\Question;
use Illuminate\Support\Str;


class QuestionFormController extends Controller
{
    public function index()
    {
        return view('questions.thank-you');
    }

    public function create_answer(Request $request){
        // $questions = $request->input('questions');
        // print_r($request->input());exit;
        // Validate the form data
        $request->validate([
            'questions.*.text' => 'required|string',
            'questions.*.type' => 'required|in:text,multiple_choice,yes_no,number_rating,emoji_rating,star_rating,radio_button_gender,radio_button_experience',
            'questions.*.options' => 'sometimes|array',
            'questions.*.options.*' => 'required_with:questions.*.options|string',
            'questions.*.max' => 'required_if:questions.*.type,number_rating|integer|min:1',
        ]);

        // print_r($request->input());exit;
        // Store survey and questions logic here
        foreach ($request->questions as $questionData) {
            // Create a new question
            $question = new Question();
            $question->question = $questionData['text'];
            $question->question_type = $questionData['type'];
            $question->questionaire_id = $request->questionaire_id;
            $question->obfuscator = Str::random(10);
            $question->required = isset($questionData['required']);
            $question->save();

            if (in_array($question->question_type, ['multiple_choice']) && isset($questionData['options'])) {
                foreach ($questionData['options'] as $optionText) {
                    // Create a new option
                    $option = new Option();
                    $option->question_id = $question->id;
                    $option->text = $optionText;
                    $option->save();
                }
            } elseif ($question->question_type === 'number_rating') {
                $question->max = $questionData['max'];
                $question->save();
            }
        }

        return redirect()->back()->with('success', 'Questions have been created successfully.');

    }


}
