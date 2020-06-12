<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function store(Request $request)
        {
            $data = new Question();
            $data = $request->all(); 
            $data->save();
            if($data)
                $message = ["message"=>"inserted successfully"];
                return response()->json($message);
        }

        public function index()
        {
            $question = new Question();
            $questions=$question->all();
            return $questions;
        }

        public function check($_id)
        {
            $question_ = new Question();
            $question = $question_->find($_id);
            return $question;
        }

        public function updateQuestion(Request $request, $_id)
            {
                $question = new Question();
                $data= $question->find($_id);
                $data = $request->all();    
                $data->save();
                if($data)
                    $message = ["message"=>"Updated successfully"];
                    return response()->json($message);
            }

            public function destroyQuestion(Request $request, $_id)
            {
                $question = new Question();
                $question = $request->find($_id);
                $question->delete();
                if($question)
                    $message = ["message"=>"Question has been deleted"];
                    return response()->json($message);
            }
}
