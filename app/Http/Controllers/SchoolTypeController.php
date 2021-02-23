<?php

namespace App\Http\Controllers;

use App\Models\SchoolType;
use Illuminate\Http\Request;
use Validator;
use Session;

class SchoolTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $schoolTypes = SchoolType::all();
        return view('admin.schoolType.schoolTypeList',compact('schoolTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.schoolType.addSchoolType');
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
        SchoolType::create([
            'name'=>$request->name,  
            ]);
            Session::flash('success','New School Type created');
            return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\SchoolType  $schoolType
     * @return \Illuminate\Http\Response
     */
    public function show(SchoolType $schoolType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\SchoolType  $schoolType
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = base64_decode($id);
        $schoolType =SchoolType::where('id',$id)->first();
        
        return view('admin.schoolType.editSchoolType',compact('schoolType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SchoolType  $schoolType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator =  $this->validate($request,
        ['name' => 'required|min:2|max:200',
        ]
        );
        SchoolType::where('id',$id)->update([
            'name'=>$request->name,  
            ]);
            Session::flash('success','SchoolType updated');
            return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SchoolType  $schoolType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        SchoolType::where('id',$id)->delete();
        Session::flash('success','School Type deleted');
        return back();
    }
}
