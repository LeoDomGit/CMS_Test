<?php

namespace Leo\Scores\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Leo\Scores\Scores;
use Illuminate\Support\Facades\Validator;
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
}
