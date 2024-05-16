<?php

namespace Leo\Users\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Leo\Users\Jobs\SendUserCreateMail;
use Leo\Users\Mail\createUser;
use Leo\Users\Models\User;
use Tymon\JWTAuth\Facades\JWTAuth;
use Firebase\JWT\JWT;
use Illuminate\Support\Facades\Auth;
use Leo\Users\Exports\UserExport;
use Leo\Users\Mail\sendMailExport;
use Leo\Users\Role;
use Maatwebsite\Excel\Facades\Excel;

class UserController 
{
    /**
     * Display a listing of the resource.
     */
    public function get_scores(Request $request)
    {
        $idRole = Role::where('name','players')->value('id');
        $players = User::where('idRole', $idRole)->with('scores')->get();
        return response()->json($players);
    }

    public function export_link (){
        return Excel::download(new UserExport, 'users.xlsx');
    }
    
    public function export_mail (Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);
        if ($validator->fails()) {
            return response()->json(['check'=>false,'msg'=>$validator->errors()->first()]);
        }
        $fileName = 'users_' . Carbon::now()->format('Ymd_His') . '.xlsx';
        $filePath = 'public/excel/' . $fileName;
        Excel::store(new UserExport, $filePath);
    
        $fileFullPath = storage_path('app/' . $filePath);
    
        $data = [
            'email' => $request->email,
            'file' => $fileFullPath
        ];
    
        Mail::to($data['email'])->send(new sendMailExport($data));
        if (file_exists($fileFullPath)) {
            unlink($fileFullPath);
        }
        return response()->json(['check'=>true]);
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
        $user=User::where('email',$request->email)->first();
        if($user){
            return response()->json(['check'=>true,'data'=>$user->id]);
        }else{
            $password=random_int(1000,9999);
            $data= $request->all();
            $data['password']=Hash::make($password);
            $idRole=Role::where('name','players')->value('id');
            $data['idRole']=$idRole;
            $id= User::insertGetId($data);
            $data = [
                'email' => $request->email,
                'password' => $password,
                'phone' => $request->phone,
            ];
            Mail::to($data['email'])->send(new createUser($data));
            return response()->json(['check'=>true,'data'=>$id]);
        }
    }

    /**
     * Display the specified resource.
     */
    public function checkLogin(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email'=>'required|email',
            'password'=>'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['check'=>false,'msg'=>$validator->errors()->first()]);
        }
        $validator = Validator::make($request->all(), [
            'email'=>'required|email|exists:users,email',
            'password'=>'required'
        ]);
        if ($validator->fails()) {
            return response()->json(['check'=>false,'msg'=>$validator->errors()->first()]);
        }
        $credentials = $request->only('email', 'password');
        $idRole=Role::where('name','admin')->value('id');
        $credentials['idRole']=$idRole;
        $token = Auth::attempt($credentials);
        if (!$token) {
            return response()->json([
                'check' => 'error',
                'msg' => 'Unauthorized',
            ], 401);
        }
        $token = JWTAuth::fromUser(Auth::user());
        return response()->json([
            'check' => true,
            'token' => $token,
        ]);
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
