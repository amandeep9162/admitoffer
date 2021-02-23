<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TeamProcessor;
use App\Models\Agent\AppliedStudentFile;
use App\Models\Agent\Student;
use App\Models\Notification;
use Validator;
use Session;
use Auth;

class TeamProcessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $hasApplication = TeamProcessor::where('application_id',$request->application_id)->first();
        // if($hasApplication){
        //     Session::flash('error','Application Already Assign To Other Processor');
        // } 

       $teamProcess = TeamProcessor::where('application_id',$request->application_id)->where('preprocess_id',$request->preprocess_id)->first();
       $appliedStudentFile = AppliedStudentFile::where('id',$request->application_id)->first();
       if($teamProcess){
        TeamProcessor::where('id',$teamProcess['id'])->delete();
        
       } 
      
       TeamProcessor::create([
                                'student_id' => $appliedStudentFile['student_id'],
                                'application_id' => $request->application_id,
                                'preprocess_id' => $request->preprocess_id,
                                'process_id' => $request->process_id,
                            ]);
       $user =Auth::guard('admin')->user();
        $application = AppliedStudentFile::where('id',$request->application_id)->first();
             $student = Student::where('id',$application['student_id'])->first();
            Notification::create([
                'type' =>'admin',
                'user' =>$request->process_id,
                'link' =>route('application.show',base64_encode($application['id'])),
                'agent_id' =>'',
                'application_id' =>$application['id'],
                'admin_role' => 'preprocess',
                'student_id' => $student['id'],
                'message' =>'A new Application for '.$student['firstName'].' for '.$application->course['name'] .' in '.$application->course->college['name'] .' assigned by '.$user['name'].'.',
                'application_status' =>'',
                'status' =>0,
            ]);
        Session::flash('success','New Application Assign To Processor');
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
        //
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
        //
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
