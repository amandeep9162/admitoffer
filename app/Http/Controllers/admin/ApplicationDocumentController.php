<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ApplicationDocument;
use App\Models\Agent\Student;
use App\Models\Agent\AppliedStudentFile;
use App\Models\ApplicationStatusTimeline;
use App\Models\ApplicationStatus;
use App\Models\Notification;
use App\Agent;
use Mail;
use Validator;
use Session;

class ApplicationDocumentController extends Controller
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
        $validator =  $this->validate($request,
            [
                'offerLetter' => 'required',
                'collegeStudentId' => 'required',
            ]
            );
        $file = $request->offerLetter;
        $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
        
            $destinationPath = 'uploads/offerletter/'.$request->applicationId;
         $file->move($destinationPath, $fileName);
        $hasAttachment = ApplicationDocument::where('application_id',$request->applicationId)->where('type','offerletter')->first();    
        if($hasAttachment){
            $attachment = ApplicationDocument::where('id',$hasAttachment['id'])->update([
                'name' => $fileName,
                'path' => $destinationPath,
                'type' => 'offerletter',
                'application_status_id' => $request->applicationStatusID,
                'application_id' => $request->applicationId,
                'student_id' => $request->studentId,
                'college_student_id' => $request->collegeStudentId,
                ]);
        }else{
            $attachment = ApplicationDocument::create([
                'name' => $fileName,
                'path' => $destinationPath,
                'type' => 'offerletter',
                'application_status_id' => $request->applicationStatusID,
                'application_id' => $request->applicationId,
                'student_id' => $request->studentId,
                'college_student_id' => $request->collegeStudentId,
                ]);
            $attachment->save();
        }
        Session::flash('success','Application Offer Letter Uploaded');  
        return back();
    }
    public function loaOfferLetter(Request $request)
    {
        $validator =  $this->validate($request,
            [
                'loaOfferLetter' => 'required',
                'collegeStudentId' => 'required',
            ]
            );
        $file = $request->loaOfferLetter;
        $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
        
            $destinationPath = 'uploads/loaOfferLetter/'.$request->applicationId;
         $file->move($destinationPath, $fileName);
        $hasAttachment = ApplicationDocument::where('application_id',$request->applicationId)->where('type','loaOfferLetter')->first();   
        $applicationSts = ApplicationStatus::where('id',19)->first();
        $application = AppliedStudentFile::where('id',$request->applicationId)->first();
        $student = Student::where('id',$application['student_id'])->first(); 
        if($hasAttachment){
            $attachment = ApplicationDocument::where('id',$hasAttachment['id'])->update([
                'name' => $fileName,
                'path' => $destinationPath,
                'type' => 'loaOfferLetter',
                'application_status_id' => $request->applicationStatusID,
                'application_id' => $request->applicationId,
                'student_id' => $request->studentId,
                'college_student_id' => $request->collegeStudentId,
                ]);
        }else{
         if(!$hasAttachment){
            ApplicationStatusTimeline::create([
                'application_id' =>$request->applicationId,
                'status_id' =>19,
                'status_date' => date('Y-m-d H:i:s'),
                ]);
                    
        }
            $attachment = ApplicationDocument::create([
                'name' => $fileName,
                'path' => $destinationPath,
                'type' => 'loaOfferLetter',
                'application_status_id' => $request->applicationStatusID,
                'application_id' => $request->applicationId,
                'student_id' => $request->studentId,
                'college_student_id' => $request->collegeStudentId,
                ]);
            $attachment->save();
            $applyStudentUpdate = AppliedStudentFile::where('id',(int)$request->applicationId)->update(['file_status'=>'19']);
        }
              $agent = Agent::where('id',$application['agent_id'])->first()->toArray();
                $data['agent'] = $agent;
                $data['student'] = $student;
                $data['appStatus'] = $applicationSts;
                $mail =  Mail::send('emails.updateStatus',['data' => $data], function($message) use ($data,$application,$student,$applicationSts) {
                    $message->to($data['agent']['email']);
                    $message->subject('Application of '.$student['firstName'].' '.$student['lastName'].' for '.$application->course['name'].' in '.$application->course->college['name'].' status updated '.$applicationSts['name']);
                    $message->from('himanshu@admitoffer.com','ADMITOFFER');
                });
            Notification::create([
                'type' =>'agent',
                'link' =>route('student.application.View',base64_encode($request->applicationId)),
                'agent_id' =>$application['agent_id'],
                'student_id' =>$application['student_id'],
                'application_id' =>$request->applicationId,
                'message' =>'Application of '.$student['firstName'].' '.$student['lastName'].' for '.$application->course['name'].' in '.$application->course->college['name'].' status updated  '.$applicationSts['name'],
                'application_status' =>'',
                'status' =>0,
                ]);
        Session::flash('success','Application Offer Letter Uploaded');  
        return back();
    }
    public function clearCasDocument(Request $request)
    {
        $validator =  $this->validate($request,
            [
                'clearCasDocument' => 'required|mimes:pdf',
              
            ]
            );
        $file = $request->clearCasDocument;
        $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
        
            $destinationPath = 'uploads/clearCasDocument/'.$request->applicationId;
         $file->move($destinationPath, $fileName);
        $hasAttachment = ApplicationDocument::where('application_id',$request->applicationId)->where('type','clearCasDocument')->first();    
        if($hasAttachment){
            $attachment = ApplicationDocument::where('id',$hasAttachment['id'])->update([
                'name' => $fileName,
                'path' => $destinationPath,
                'type' => 'clearCasDocument',
                'application_status_id' => $request->applicationStatusID,
                'application_id' => $request->applicationId,
                'student_id' => $request->studentId,
                ]);
        }else{
            $attachment = ApplicationDocument::create([
                'name' => $fileName,
                'path' => $destinationPath,
                'type' => 'clearCasDocument',
                'application_status_id' => $request->applicationStatusID,
                'application_id' => $request->applicationId,
                'student_id' => $request->studentId,
                ]);
            $attachment->save();
        }
        Session::flash('success','Application clear Cas Document Uploaded');  
        return back();
    }
    public function ApplicationRejection(Request $request)
    {
        $validator =  $this->validate($request,
            [
            'reason' => 'required',
            ]);
       
        $application = AppliedStudentFile::where('id',$request->application_id)->update([
                'reason' => $request->reason,
            ]);
        
        Session::flash('success','Application Rejected');  
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
