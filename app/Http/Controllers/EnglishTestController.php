<?php

namespace App\Http\Controllers;
use App\Models\EnglishTest;
use App\Models\Loc\Country;
use Validator;
use Session;
use Auth;

use Illuminate\Http\Request;

class EnglishTestController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $englishTests = EnglishTest::get();
        return view('admin.studentEnglishTest.englishTest',compact('englishTests'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::all();
        return view('admin.studentEnglishTest.addEnglishTest',compact('countries'));
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
        ['country_id' => 'required',
        'name' => 'required',
        ]
        );
        EnglishTest::create([
            'country_id'=>$request->country_id,  
            'name'=>$request->name,  
            ]);
            Session::flash('success','New English test created');
            return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = base64_decode($id);
        $englishTest =EnglishTest::where('id',$id)->first();
        $countries = Country::all();
        return view('admin.studentEnglishTest.editEnglishTest',compact('englishTest','countries'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator =  $this->validate($request,
        ['country_id' => 'required',
        'name' => 'required',
        ]
        );
        EnglishTest::where('id',$id)->update([
            'country_id'=>$request->country_id,  
            'name'=>$request->name,  
            ]);
            Session::flash('success','English Score updated');
            return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
