<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;
use App\Models\Qualification;
use Validator;
use Session;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subjects = Subject::all();
        $qualifications = Qualification::all();
        return view('admin.subjects.subjectsList',compact('subjects','qualifications'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $qualifications = Qualification::all();
        return view('admin.subjects.addSubject',compact('qualifications'));
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
            'qualification' => 'required',
        ]
        );
        Subject::create([
            'qualification'=>$request->qualification,  
            'name'=>$request->name,  
            ]);
            Session::flash('success','New Subject created');
            return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function show(Subject $subject)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = base64_decode($id);
        $subject =Subject::where('id',$id)->first();
        $qualifications = Qualification::all();
        
        return view('admin.subjects.editSubject',compact('subject','qualifications'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator =  $this->validate($request,
        [
            'name' => 'required|min:2|max:200',
            'qualification' => 'required',
        ]
        );
        Subject::where('id',$id)->update([
            'name'=>$request->name,  
            'qualification'=>$request->qualification,  
            ]);
            Session::flash('success','Subject updated');
            return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Subject  $subject
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Subject::where('id',$id)->delete();
        Session::flash('success','Subject deleted');
        return back();
    }
}
