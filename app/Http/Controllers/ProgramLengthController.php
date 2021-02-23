<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgramLength;
use Validator;
use Session;

class ProgramLengthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $programLengths = ProgramLength::all();
        return view('admin.programLength.programLengthList',compact('programLengths'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.programLength.addProgramLength');
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
        ProgramLength::create([
            'name'=>$request->name,  
            ]);
            Session::flash('success','New ProgramLength created');
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
        $programLength =ProgramLength::where('id',$id)->first();
        
        return view('admin.programLength.editProgramLength',compact('programLength'));
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
        ['name' => 'required|min:2',
        ]
        );
        ProgramLength::where('id',$id)->update([
            'name'=>$request->name,  
            ]);
            Session::flash('success','ProgramLength updated');
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
        ProgramLength::where('id',$id)->delete();
        Session::flash('success','ProgramLength deleted');
        return back();
    }
}
