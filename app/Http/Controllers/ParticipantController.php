<?php

namespace App\Http\Controllers;

use JWTAuth;
use App\Participant;
use Illuminate\Http\Request;

class ParticipantController extends Controller
{
    public function storeResponse(Request $request){
        // When saving a survey add the id of the dataCollector conducting the interview
        $data = new Participant();
        $data = $request->all();
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
        $getAll = new Participant();
        $participant= $getAll->all();
        return $participant;
    }

    public function show($_id)
    {
        $getData = new Participant();
        $participant = $getData->find($_id);
    
        if (!$participant) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, participant with id ' . $_id . ' cannot be found.'
            ], 400);
        }
    
        return $participant;
    }
}
