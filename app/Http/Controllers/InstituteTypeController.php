<?php

namespace App\Http\Controllers;

use App\Models\InstituteType;
use Illuminate\Http\Request;
use Validator;
use Session;

class InstituteTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $instituteTypes = InstituteType::all();
       return view('admin.instituteType.instituteTypeList',compact('instituteTypes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.instituteType.addInstituteType');
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
        ['name' => 'required|min:2',
        ]
        );
        InstituteType::create([
            'name'=>$request->name,  
            ]);
            Session::flash('success','New InstituteType created');
            return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\InstituteType  $instituteType
     * @return \Illuminate\Http\Response
     */
    public function show(InstituteType $instituteType)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\InstituteType  $instituteType
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = base64_decode($id);
        $instituteType =InstituteType::where('id',$id)->first();
        
        return view('admin.instituteType.editinstituteType',compact('instituteType'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\InstituteType  $instituteType
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator =  $this->validate($request,
        ['name' => 'required|min:2',
        ]
        );
        InstituteType::where('id',$id)->update([
            'name'=>$request->name,  
            ]);
            Session::flash('success','InstituteType updated');
            return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\InstituteType  $instituteType
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        InstituteType::where('id',$id)->delete();
        Session::flash('success','InstituteType deleted');
        return back();
    }
}
