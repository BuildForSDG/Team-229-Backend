<?php

namespace App\Http\Controllers;

use JWTAuth;
use App\Participant;
use Illuminate\Http\Request;

class ParticipantController extends Controller
{
    public function storeResponse(Request $request){
        // When saving a survey add the id of the dataCollector conducting the interview
        $data = Participant::create($request->all());
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
        $participant=Participant::all();
        return $participants;
    }

    public function show($id)
    {
        $participant = Participant::find($id);
    
        if (!$participant) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, participant with id ' . $id . ' cannot be found.'
            ], 400);
        }
    
        return $participant;
    }
}
