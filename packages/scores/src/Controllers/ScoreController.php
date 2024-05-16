<?php

namespace Leo\Scores\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Leo\Scores\Scores;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Leo\Scores\Exports\ScoreExport;
use Leo\Scores\Mail\sendMailExport;

class ScoreController extends Controller
{
    /**
     * Store a newly created score.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'idUser' => 'required|exists:users,id',
            'score' => 'required|integer|min:0|max:10',
        ]);
        if ($validator->fails()) {
            return response()->json(['check'=>false,'msg'=>$validator->errors()->first()]);
        }
        Scores::create([
            'idUser' => $request->idUser,
            'score' => $request->score,
        ]);
        return response()->json(['check' =>true], 200);
    }

    public function export (){
        return Excel::download(new ScoreExport, 'scores.xlsx');
    }
    
    public function export_mail (Request $request){
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
        ]);
        if ($validator->fails()) {
            return response()->json(['check'=>false,'msg'=>$validator->errors()->first()]);
        }
        $fileName = 'scores_' . Carbon::now()->format('Ymd_His') . '.xlsx';
        $filePath = 'public/excel/' . $fileName;
        Excel::store(new ScoreExport, $filePath);
    
        $fileFullPath = storage_path('app/' . $filePath);
    
        $data = [
            'email' => $request->email,
            'file' => $fileFullPath
        ];
    
        Mail::to($data['email'])->send(new sendMailExport($data));
        return response()->json(['check'=>true]);
    }
}
