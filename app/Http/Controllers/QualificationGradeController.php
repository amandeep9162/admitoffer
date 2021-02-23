<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Qualification;
use App\Models\QualificationGrade;
use Validator;
use Session;

class QualificationGradeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $qualificationGrades = QualificationGrade::with('qualification')->get();
        return view('admin.qualificationGrade.qualificationGrade',compact('qualificationGrades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $qualifications = Qualification::all();
        return view('admin.qualificationGrade.addQualificationGrade',compact('qualifications'));
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
        'qualificationGrade' => 'required',
        ]
        );
        QualificationGrade::create([
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
        $qualificationGrade =QualificationGrade::where('id',$id)->first();
        $qualifications = Qualification::all();

        return view('admin.qualificationGrade.editQualificationGrade',compact('qualificationGrade','qualifications'));
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
        'qualificationGrade' => 'required',
        ]
        );
        QualificationGrade::where('id',$id)->update([
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
