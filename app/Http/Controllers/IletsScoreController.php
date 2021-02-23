<?php

namespace App\Http\Controllers;

use App\Models\IletsScore;
use App\Models\EnglishTest;
use Illuminate\Http\Request;
use App\Models\Loc\Country;
use Validator;
use Session;

class IletsScoreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $iletsScores = IletsScore::all();
        return view('admin.iletsScores.IletsScoresList',compact('iletsScores'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::where('applyFor',1)->get();
        return view('admin.iletsScores.addIletsScore',compact('countries'));
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
        [
            'name' => 'required|min:2|max:200',
            'country' => 'required',
        ]
        );
        IletsScore::create([
            'name'=>$request->name,  
            'country'=>$request->country,  
            ]);
            Session::flash('success','New IletsScore created');
            return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\IletsScore  $iletsScore
     * @return \Illuminate\Http\Response
     */
    public function show(IletsScore $iletsScore)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IletsScore  $iletsScore
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = base64_decode($id);
        $iletsScore =IletsScore::where('id',$id)->first();
        $countries = Country::where('applyFor',1)->get();
        $englishTests = EnglishTest::where('country_id',$iletsScore['country'])->get();
        
        return view('admin.iletsScores.editIletsScore',compact('iletsScore','countries','englishTests'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\IletsScore  $iletsScore
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $validator =  $this->validate($request,
        [
            'name' => 'required|min:2|max:200',
            'english_test' => 'required',
            'country' => 'required',
        ]
        );
        IletsScore::where('id',$id)->update([
            'name'=>$request->name,  
            'english_test'=>$request->english_test,  
            'country'=>$request->country,  
            ]);
            Session::flash('success','IletsScore updated');
            return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IletsScore  $iletsScore
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        IletsScore::where('id',$id)->delete();
        Session::flash('success','Ilets Score deleted');
        return back();
    }
}
