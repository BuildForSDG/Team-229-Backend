<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RegisterController;

class RegisterCollectorController extends Controller
{
    // Collector controller
    public function get(){
        return response()->json(RegisterController::get());
    }
    public function delete($id){
        return response()->json(RegisterController::destroy($id));
        
    }
    public function put(Request $request, $id){
        $controllers = RegisterController::find($id);
        $controllers->fname = $request->input('fname');
        $controllers->lname = $request->input('lname');
        $controllers->contact = $request->input('contact');
        $controllers->address_one = $request->input('address_one');
        $controllers->address_two = $request->input('address_two');
        $controllers->email = $request->input('email');
        $controllers->pass1 = $request->input('pass1');
        $controllers->gender = $request->input('gender');
        $controllers->save();
        return response()->json($controllers);
        
    }
    public function post(Request $request){
        $controllers = new RegisterController();
        $controllers->fname = $request->input('fname');
        $controllers->lname = $request->input('lname');
        $controllers->contact = $request->input('contact');
        $controllers->address_one = $request->input('address_one');
        $controllers->address_two = $request->input('address_two');
        $controllers->email = $request->input('email');
        $controllers->pass1 = $request->input('pass1');
        $controllers->gender = $request->input('gender');
        $controllers->save();
        return response()->json($controllers);
        
    }
}
