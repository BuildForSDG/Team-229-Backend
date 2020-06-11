<?php

namespace App\Http\Controllers;

use App\Question;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function store(Request $request)
        {
            $data = Question::create($request->all()); 
            $data->save();
            if($data){
                $message = ["message"=>"inserted successfully"];
                return response()->json($message);
            }else{
                $message = ["message"=>"Failed to insert data"];
                return response()->json($message);
            }
        }

        public function index()
        {
            $questions=Question::all();
            return $questions;
        }

        public function check($id)
        {
            $question = Question::find($id);
            return $question;
        }

        public function updateQuestion(Request $request, $id)
            {
                $dataCollector= Question::find($id);
                $data = Question::create($request->all());    
                $data->save();
                if($data){
                    $message = ["message"=>"Updated successfully"];
                    return response()->json($message);
                }else{
                    $message = ["message"=>"Failed to update data"];
                    return response()->json($message);
                }
            }

            public function destroyQuestion(Request $request, $id)
            {
                $dataCollector = Question::find($id);
                $dataCollector->delete();
                if($dataCollector){
                    $message = ["message"=>"Question has been deleted"];
                    return response()->json($message);
                }else{
                    $message = ["message"=>"Failed to delete data"];
                    return response()->json($message);
                }
            }
}
