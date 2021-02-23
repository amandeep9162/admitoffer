<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\College;
use App\Models\Loc\Country;
use App\Models\University;
use Bitfumes\Multiauth\Model\Admin;
use Bitfumes\Multiauth\Model\Role;
use Validator;
use Session;

class UniversityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $universities = University::with('preProcess')->get();
        return view('admin.university.list',compact('universities'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::all();
        $universities = University::get();
        $roles = Role::with('admins')->where('name','preprocess')->first();
        return view('admin.university.add',compact('countries','universities','roles'));
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
            'name' => 'required',
            'country_id' => 'required',
            'preProcessBy' => 'required',
        ]
        );
        $question = University::create([
            'name'=>$request->name,  
            'country_id'=>$request->country_id,  
            'preProcessBy'=>$request->preProcessBy,  
            ]);
        $question->save();
        Session::flash('success','New University created');
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
        $id = base64_decode($id);
        $colleges =College::with('InstituteType','country')->where('university_id',$id)->orderBy('id','DESC')->get();
        return view('admin.colleges.collegesList',compact('colleges'));
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
        $university =University::where('id',$id)->first();
        $countries = Country::all();
        $roles = Role::with('admins')->where('name','preprocess')->first();
        return view('admin.university.edit',compact('countries','university','roles'));
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
        [
            'name' => 'required',
            'country_id' => 'required',
        ]
        );
        University::where('id',$id)->update([
            'name'=>$request->name,  
            'country_id'=>$request->country_id,
            'preProcessBy'=>$request->preProcessBy,   
            ]);
        // CountryQuestion::where('id',$id)->update([
        //     'country_id'=>$request->country_id,  
        //     'question_id'=>$request->question_id,  
        //     ]);    
            Session::flash('success','University updated');
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
