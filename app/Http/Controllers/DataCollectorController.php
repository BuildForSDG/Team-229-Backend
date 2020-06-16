<?php

namespace App\Http\Controllers;

use JWTAuth;
use App\DataCollector;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\RegisterAuthRequest;
use Firebase\JWT\JWT;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Exceptions\JWTException;
use Symfony\Component\HttpFoundation\Response;

class DataCollectorController extends Controller
{
    public $loginAfterSignUp = true;
    
    public function register(Request $request)
    {
        $dataCollector = DataCollector::create($request->all());
        if($user = DataCollector::where('email', '=', $dataCollector['email'])->first()){
            $dataCollector->save();
        }
        else
            return  response()->json(['error' => 'Email Exists'], 401);
 
        if ($this->loginAfterSignUp) {
            return $this->login($request);
        }
 
        return response()->json([
            'success' => true,
            'data' => $dataCollector
        ], Response::HTTP_OK);
    }

    /**
     * Create a new token.
     *
     * @param  \App\User   $user
     * @return string
     */
    protected function jwt(DataCollector $user) {
        $payload = [
            'iss' => "lumen-jwt", // Issuer of the token
            'sub' => $user->id, // Subject of the token
            'iat' => time(), // Time when JWT was issued.
            'exp' => time() + 60*60 // Expiration time
        ];

        // As you can see we are passing `JWT_SECRET` as the second parameter that will
        // be used to decode the token in the future.
        return JWT::encode($payload, env('JWT_SECRET'));
    }


    public function login(Request $request)
    {
        $this->validate($request, 
        [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        // Find the user by email
        $user = DataCollector::where('email', $request->input('email'))->first();
        //dump($user);
        if (!$user) {
            // You wil probably have some sort of helpers or whatever
            // to make sure that you have the same response format for
            // differents kind of responses. But let's return the
                // below respose for now.
                return response()->json([
                'error' => 'Email does not exist.'
            ], 400);
        }
        // Verify the password and generate the token
        if ($request->input('password') == $user->password) {
            return response()->json([
                'token' => $this->jwt($user)
            ], 200);
        }

        // Bad Request response
        return response()->json([
            'error' => 'Email or password is wrong.'
        ], 400);

    }

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
        return Auth::guard();
    }


    public function getAuthUser(Request $request)
    {
        $this->validate($request, [
            'token' => 'required'
        ]);
        $user = JWTAuth::authenticate($request->token);
 
        return response()->json(['user' => $user]);
    }

    public function index()
    {
        $dataCollector=DataCollector::all();
        return $dataCollector;
    }

    public function editCollector(Request $request, $_id)
    {
        $collector = DataCollector::find($_id);
        return $collector;
    }

    public function updateCollector(Request $request, $_id)
    {
        $dataCollector= DataCollector::find($_id);
        $dataCollector = DataCollector::all();     
        $dataCollector->save();
        if($dataCollector)
            $message = ["message"=>"Updated successfully"];
            return response()->json($message);
    }

    public function destroyCollector(Request $request, $_id)
    {   
        $dataCollector = DataCollector::find($_id);
        $dataCollector->delete();
        if($dataCollector)
            $message = ["message"=>"Collector has been deleted"];
            return response()->json($message);
    }
}
