<?php

namespace App\Http\Controllers;

use JWTAuth;
use App\Participant;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ParticipantController extends Controller
{
    public function storeResponse(Request $request){
        // When saving a survey add the id of the dataCollector conducting the interview
        $data_collector = $request->auth;
        $data = Participant::create($request->all());
        $data = $data_collector; //Get the collectors Id
        $data->save();
        if ($data)
            return response()->json([
                'success' => true,
                'participant' => $data
            ]);
        else
            return response()->json([
                'success' => false,
                'message' => 'Sorry, task could not be added.'
            ], 500);
    }

    public function index()
    {
        $participant= Participant::all();
        return $participant;
    }

    public function show($_id)
    {
        $participant = Participant::find($_id);
    
        if (!$participant) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, participant with id ' . $_id . ' cannot be found.'
            ], 400);
        }
    
        return $participant;
    }
}
