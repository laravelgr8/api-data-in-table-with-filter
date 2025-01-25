<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Validator;
use Hash;
use Auth;
use Http;
class ApiController extends Controller
{
    public function signup(Request $request){
		$validator=Validator::make($request->all(),[
			"name"=>'required',
			"email"=>'required',
			"password"=>'required'
		]);
		if(!$validator->passes()){
			return response()->json(["status"=>false,"errors"=>$validator->errors()]);
		}
		
		$user=new User;
		$user->name=$request->name;
		$user->email=$request->email;
		$user->password=Hash::make($request->password);
		$user->save();
		//$input = $request->all();
        //$input['password'] = bcrypt($input['password']);
		//$user = User::create($input); 
		if($user){
			$success['token']=$user->createToken('plaintext')->plainTextToken;
			$success['data']=$user->name;
			return response()->json(["status"=>true,"success"=>$success]);
		}
	}
	
	
	public function login(Request $request){
		$validator=Validator::make($request->all(),[
			"email"=>'required',
			"password"=>'required'
		]);
		
		if(!$validator->passes()){
			return response()->json(["status"=>true,"errors"=>$validator->errors()]);
		}
		
		if(Auth::attempt(["email"=>$request->email,"password"=>$request->password])){
			$user=Auth::user();
			$success['token']=$user->createToken('plaintext')->plainTextToken;
			$success['message']="Login Successfully";
			return response()->json(["status"=>false,"message"=>$success]);
		}else{
			return response()->json(["status"=>false,"message"=>"Invalid User Detail"]);
		}
	}
	
	public function profile(){
		//return Auth::user()->name;
		$data=User::get();
		if($data){
			return response()->json(["status"=>true,"data"=>$data]);
		}else{
			return response()->json(["status"=>true,"data"=>"No Record Found"]);
		}
	}
	
	
	
	
	
}
