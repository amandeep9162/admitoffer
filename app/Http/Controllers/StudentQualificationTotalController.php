<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\StudentQualificationTotal;
use Validator;
use Session;

class StudentQualificationTotalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $qualificationTotals = StudentQualificationTotal::all();
        return view('admin.masterStudentQualificationTotal.qualificationTotals',compact('qualificationTotals'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.masterStudentQualificationTotal.addQualificationTotal');
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
        'type' => 'required',
        'name' => 'required',
        ]
        );
        StudentQualificationTotal::create([
            'type'=>$request->type,  
            'name'=>$request->name,  
            ]);
            Session::flash('success','New Qualification Total created');
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
        $qualificationTotals =StudentQualificationTotal::where('id',$id)->first();
        return view('admin.masterStudentQualificationTotal.editQualificationTotal',compact('qualificationTotals'));
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
            'type' => 'required',
            'name' => 'required',
        ]
        );
        StudentQualificationTotal::where('id',$id)->update([
            'type'=>$request->type,  
            'name'=>$request->name,  
            ]);
            Session::flash('success','Student Qualification Total updated');
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
