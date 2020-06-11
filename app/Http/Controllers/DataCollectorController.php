<?php

namespace App\Http\Controllers;

use JWTAuth;
use App\DataCollector;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterAuthRequest;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;

class DataCollectorController extends Controller
{
    public $loginAfterSignUp = true;
    
    // public function register(Request $request)
    // {
    //     $dataCollector = DataCollector::create($request->all());
    //     if($user = DataCollector::where('email', '=', $dataCollector['email'])->first()){
    //         $dataCollector->save();
    //     }
    //     else
    //         return  response()->json(['error' => 'Email Exists'], 401);
 
    //     if ($this->loginAfterSignUp) {
    //         return $this->login($request);
    //     }
 
    //     return response()->json([
    //         'success' => true,
    //         'data' => $dataCollector
    //     ], Response::HTTP_OK);
    // }

    // public function login(Request $request)
    // {
    //     $credentials = $request->only('email', 'password');
    //     $token = null;

    //     if ( $user = DataCollector::where('email', '=', $credentials['email'])->first() )
    //     {
    //         if (!$user = DataCollector::where('password', '=', $credentials['password'])->first() )
    //             return [ 'error' => true ];
    //         else
    //         {
    //             $token = JWTAuth::fromUser($user);

    //             return [ 'error' => false, $this->respondWithToken($token) ];
    //         }
    //     }
    //     else
    //         return  response()->json(['error' => 'Unauthorized'], 401);

    // }
    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->guard()->factory()->getTTL() * 60
        ]);
    }
    
    public function logout()
    {
        try{

            $this->guard()->logout();
    
            return response()->json(['message' => 'Successfully logged out']);

        } catch (JWTException $exception) {
            return response()->json([
                'success' => false,
                'message' => 'Sorry, the user cannot be logged out'
            ], 500);
        }
    }

    /**
     * Get the authenticated User
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function _me()
    {
        return response()->json($this->guard()->user());
    } 
    
    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken($this->guard()->refresh());
    }

    /**
     * Get the guard to be used during authentication.
     *
     * @return \Illuminate\Contracts\Auth\Guard
     */
    public function guard()
    {
        $auth = new Auth();
        return $auth->guard();
    }


    public function getAuthUser(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);
        $user = new JWTAuth();
        $user = $request->authenticate(token);
 
        return response()->json(['user' => $user]);
    }

    public function index()
    {
        $getData = new DataCollector();
        $dataCollector=$getData->all();
        return $dataCollector;
    }

    public function editCollector(Request $request, $_id)
    {
        $collector = new DataCollector();
        $collector = $request->find($_id);
        return $collector;
    }

    public function updateCollector(Request $request, $_id)
    {
        $dataCollector = new DataCollector();
        $dataCollector= $request->find($_id);
        $dataCollector = $request->all();     
        $dataCollector->save();
        if($dataCollector)
            $message = ["message"=>"Updated successfully"];
            return response()->json($message);
    }

    public function destroyCollector(Request $request, $_id)
    {
        $dataCollector = new DataCollector();
        $dataCollector = $request->find($_id);
        $dataCollector->delete();
        if($dataCollector){
            $message = ["message"=>"Collector has been deleted"];
            return response()->json($message);
        }else{
            $message = ["message"=>"Failed to delete data"];
            return response()->json($message);
        }
    }
}
