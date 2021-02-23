<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ApplicationStatus;
use App\Models\Loc\Country;
use Validator;
use Session;

class ApplicationStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $applicationStatuses = ApplicationStatus::all();
       return view('admin.applicationStatus.applicationList',compact('applicationStatuses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $countries = Country::where('applyFor',1)->get();
        return view('admin.applicationStatus.addApplicationStatus',compact('countries'));
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
        ApplicationStatus::create([
            'name'=>$request->name,  
            'country'=>$request->country,  
            ]);
            Session::flash('success','New Status created');
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
        $applicationStatus =ApplicationStatus::where('id',$id)->first();
        $countries = Country::where('applyFor',1)->get();
        
        return view('admin.applicationStatus.editApplicationStatus',compact('applicationStatus','countries'));
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
        ApplicationStatus::where('id',$id)->update([
            'name'=>$request->name,  
            'country'=>$request->country,  
            ]);
            Session::flash('success','Status updated');
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
