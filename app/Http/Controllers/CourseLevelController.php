<?php

namespace App\Http\Controllers;

use App\Models\CourseLevel;
use Illuminate\Http\Request;
use Validator;
use Session;

class CourseLevelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
     
        $courseLevels = CourseLevel::all();
        return view('admin.courseLevel.courseLevelList',compact('courseLevels'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.courseLevel.addCourseLevel');
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
        ['name' => 'required|min:2|max:200',
        ]
        );
        CourseLevel::create([
            'name'=>$request->name,  
            ]);
            Session::flash('success','New Course Level created');
            return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CourseLevel  $courseLevel
     * @return \Illuminate\Http\Response
     */
    public function show(CourseLevel $courseLevel)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CourseLevel  $courseLevel
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = base64_decode($id);
        $courseLevel =CourseLevel::where('id',$id)->first();
        
        return view('admin.courseLevel.editCourseLevel',compact('courseLevel'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CourseLevel  $courseLevel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator =  $this->validate($request,
        ['name' => 'required|min:2|max:200',
        ]
        );
        CourseLevel::where('id',$id)->update([
            'name'=>$request->name,  
            ]);
            Session::flash('success','Course Level updated');
            return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CourseLevel  $courseLevel
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        CourseLevel::where('id',$id)->delete();
        Session::flash('success','Course Level deleted');
        return back();
    }
}
