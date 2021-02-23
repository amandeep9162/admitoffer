<?php

namespace App\Http\Controllers;

use App\Models\EnglishScore;
use Illuminate\Http\Request;
use Validator;
use Session;

class EnglishScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $englishScores = EnglishScore::all();
        return view('admin.englishScore.englishScoreList',compact('englishScores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.englishScore.addEnglishScore');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator =  $this->validate($request,
        ['score' => 'required|min:2|max:200',
        ]
        );
        EnglishScore::create([
            'score'=>$request->score,  
            ]);
            Session::flash('success','New English Score created');
            return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\EnglishScore  $englishScore
     * @return \Illuminate\Http\Response
     */
    public function show(EnglishScore $englishScore)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\EnglishScore  $englishScore
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = base64_decode($id);
        $englishScore =EnglishScore::where('id',$id)->first();
        
        return view('admin.englishScore.editEnglishScore',compact('englishScore'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\EnglishScore  $englishScore
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $validator =  $this->validate($request,
        ['score' => 'required|min:2|max:200',
        ]
        );
        EnglishScore::where('id',$id)->update([
            'score'=>$request->score,  
            ]);
            Session::flash('success','English Score updated');
            return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\EnglishScore  $englishScore
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        EnglishScore::where('id',$id)->delete();
        Session::flash('success','English Score deleted');
        return back();
    }
}
