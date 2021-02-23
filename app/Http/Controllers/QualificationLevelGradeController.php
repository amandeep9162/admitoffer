<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Qualification;
use App\Models\QualificationGrade;
use App\Models\QualificationLevelGrade;
use Validator;
use Session;

class QualificationLevelGradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $qualificationGrades = QualificationLevelGrade::with(['qualification','qualificationGrade'])->get();
        
        return view('admin.qualificationLevelGrade.qualificationGrade',compact('qualificationGrades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $qualifications = Qualification::all();
        $qualificationGrades = QualificationGrade::all();
        return view('admin.qualificationLevelGrade.addQualificationGrade',compact('qualifications','qualificationGrades'));
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
        ['qualification' => 'required',
        'qualificationGrade' => 'required',
        ]
        );
        QualificationLevelGrade::create([
            'qualification_level'=>$request->qualification,  
            'qualification_grade'=>$request->qualificationGrade,  
            ]);
            Session::flash('success','New Qualification Grade created');
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
        $qualifications = Qualification::all();
        $qualificationGrades  = QualificationGrade::get();
        $qualificationLevelGrade =QualificationLevelGrade::where('id',$id)->first();
        return view('admin.qualificationLevelGrade.editQualificationGrade',compact('qualificationLevelGrade','qualificationGrades','qualifications'));
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
        ['qualification' => 'required',
        'qualificationGrade' => 'required',
        ]
        );
        QualificationLevelGrade::where('id',$id)->update([
            'qualification_level'=>$request->qualification,  
            'qualification_grade'=>$request->qualificationGrade, 
            ]);
            Session::flash('success','Qualification Grade updated');
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
