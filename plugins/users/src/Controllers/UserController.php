<?php

namespace Leo\Users\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Leo\Users\Jobs\SendUserCreateMail;
use Leo\Users\Mail\createUser;
use Leo\Users\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Firebase\JWT\JWT;

class UserController 
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'email'=>'required|email',
            'phone'=>'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['check'=>false,'msg'=>$validator->errors()->first()]);
        }else if (!preg_match('/^(84|0[3|5|7|8|9])[0-9]{8}$/', $request->phone)) {
          return response()->json(['check'=>false,'msg'=>'Phone number is invalid']);
        } 
        $user=User::where('email',$request->emai)->first();
        if($user){
            return response()->json(['check'=>true,'data'=>$user->id]);
        }else{
            $password=random_int(1000,9999);
            $data= $request->all();
            $data['password']=Hash::make($password);
            $id= User::insertGetId($data);
            $data = [
                'email' => $request->email,
                'password' => $password,
                'phone' => $request->phone,
            ];
            Mail::to($data['email'])->send(new createUser($data));
        }
        return response()->json(['check'=>true,'data'=>$id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
