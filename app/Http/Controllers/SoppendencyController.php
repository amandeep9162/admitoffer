<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Sop_pendency;
use App\Models\PendancyAttachment;
use App\Models\Agent\AppliedStudentFile;
use App\Models\Agent\Student;
use App\Models\Notification;
use Session;
use Auth;

class SoppendencyController extends Controller
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
        $validator =  $this->validate($request,
        [
            
            'sop' => 'mimes:pdf|required',
            'is_uni_sop' => 'required',
            'is_course_sop' => 'required',
            'sop_background' => 'required',
            'does_sop_clear_student_course_uni' => 'required',
            'does_sop_clear_student_career_goal' => 'required',
            'define_why_student_to_study_uk' => 'required',
            'is_your_content_original' => 'required',
        ]
        );
        if($request->sop){
            $file = $request->sop;
            $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
            $destinationPath = 'uploads/sop/'.$id;
            $file->move($destinationPath, $fileName);    
        }else{
            $fileName = '';
            $destinationPath ='';
        }
        $attachment = PendancyAttachment::where('application_id',$id)->where('student_id',$request->studentId)->where('type','sopDocument')->update([
            'name' => $fileName,
            'path' => $destinationPath,
            'status' => 1,
            ]);

        Sop_pendency::where('application_id',$id)->update([
            'student_id' => $request->studentId,
            'status' => 1,
            'sop_name' => $fileName,
            'sop_path' => $destinationPath,
            'is_uni_sop' => $request->is_uni_sop,
            'is_course_sop' => $request->is_course_sop,
            'sop_background' => $request->sop_background,
            'does_sop_clear_student_course_uni' => $request->does_sop_clear_student_course_uni,
            'does_sop_clear_student_career_goal' => $request->does_sop_clear_student_career_goal,
            'define_why_student_to_study_uk' => $request->define_why_student_to_study_uk,
            'is_your_content_original' => $request->is_your_content_original,
            ]);
             $user =Auth::guard('agent')->user();
             $application = AppliedStudentFile::where('id',$id)->first();
             $student = Student::where('id',$request->studentId)->first();
            Notification::create([
                'type' =>'admin',
                'user' =>$application->course->college['preProcessBy'],
                'link' =>route('application.show',base64_encode($id)),
                'agent_id' =>'',
                'from' =>$application['agent_id'],
                'to' =>$application->course->college['preProcessBy'],
                'application_id' =>$id,
                'student_id' => $request->studentId,
                'message' =>'SOP Uploaded by '.$user['name'].' for '.$application->course['name'] .' for '.$student['firstName'].'.',
                'application_status' =>'',
                'status' =>0,
            ]);
            Session::flash('success','SOP Pendency Uploaded');
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

    public function updateAcceptStatus($id)
    {
        
        $attachmentDoc = Sop_pendency::where('id',$id)->first();
        $attachment = Sop_pendency::where('id',$id)->update([
            'status' => 2,
            ]);
          
           $application = AppliedStudentFile::where('id',$attachmentDoc['application_id'])->first();
             $student = Student::where('id',$application['student_id'])->first();
            Notification::create([
                'type' =>'agent',
                'link' =>route('student.application.View',base64_encode($application['id'])),
                'agent_id' =>$application['agent_id'],
                'application_id' =>$application['id'],
                'student_id' => $student['id'],
                'message' =>'SOP for '.$student['firstName'].' for '.$application->course['name'] .' Accepted.',
                'application_status' =>'',
                'status' =>0,
            ]);

        Session::flash('success','Document Accepted');
        return back();
    }
            
    public function updateRejectStatus(Request $request, $id)
    {
        $attachmentDoc = Sop_pendency::where('id',$id)->first();
        $attachment = Sop_pendency::where('id',$id)->update([
            'status' => 3,
            'reason' => $request->reason,
            ]);
         $application = AppliedStudentFile::where('id',$attachmentDoc['application_id'])->first();
             $student = Student::where('id',$application['student_id'])->first();
            Notification::create([
                'type' =>'agent',
                'link' =>route('student.application.View',base64_encode($application['id'])),
                'agent_id' =>$application['agent_id'],
                'application_id' =>$application['id'],
                'student_id' => $student['id'],
                'message' =>'SOP for '.$student['firstName'].' for '.$application->course['name'] .' Rejected.',
                'application_status' =>'',
                'status' =>0,
            ]);
        
       
        Session::flash('success','Document Updated');
        return back();
    }
}
