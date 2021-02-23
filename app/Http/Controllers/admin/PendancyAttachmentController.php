<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\PendancyAttachment;
use App\Models\ApplicationDocument;
use App\Models\Notification;
use App\Agent;
use App\Models\Agent\AppliedStudentFile;
use App\Models\ApplicationFee;
use App\Models\Agent\Student;
use Validator;
use Session;
use Mail;

class PendancyAttachmentController extends Controller
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
        $user = auth('admin')->user();

       if ($request->other) {
            $validator =  $this->validate($request,
            [
                'title' => 'required',
                'other' => 'required',
            ]
            );
            if($request->has('file')){
                $validator =  $this->validate($request,
            [
                'file' => 'required|mimes:pdf',
            ]
            );
            $studentId = $request->studentId;
            $file = $request->file;
            $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                $destinationPath = 'uploads/student/pendancies/'.$studentId;
            
            $file->move($destinationPath, $fileName);    
    

            $attachment = PendancyAttachment::create([
                'application_id' =>$request->application_id,
                'student_id' =>$request->studentId,
                'comment' =>$request->other,
                'title' =>$request->title,
                'created_by' =>$user['id'],
                'type' =>'otherAdminDoc',
                'name' => $fileName,
                'path' => $destinationPath,
                'status' => 10,
            ]);
            $application = AppliedStudentFile::where('id',$request->application_id)->first();
        }else{
            $application = AppliedStudentFile::where('id',$request->application_id)->first();
                $attachment = PendancyAttachment::create([
                    'application_id' =>$request->application_id,
                    'student_id' =>$request->studentId,
                    'comment' =>$request->other,
                    'title' =>$request->title,
                    'created_by' =>$user['id'],
                    'type' =>'other',
                    
                ]);
            }
            Session::flash('success','Document Request Sent');
       }
       if ($request->qualificationGrade) {
           $validator =  $this->validate($request,
           [
               'qualificationGrade' => 'required',
               'documentText' => 'required',
               ]
            );
            $attachment = PendancyAttachment::create([
                'application_id' =>$request->applicationDoc_id,
                'student_id' =>$request->studentId,
                'created_by' =>$user['id'],
                'comment' =>$request->documentText,
                'type' =>$request->qualificationGrade,
                ]);
            }
            if(!array_key_exists('application_id',$request->all())){

            $student = Student::where('id',$request->studentId)->first();
            
            Notification::create([
                'type' =>'status student pendency',
                'link' =>route('student.show',base64_encode($student['id'])),
                'agent_id' =>$student['agent_id'],
                'application_id' =>$student['id'],
                'message' => 'Dear '.$student->agent['name'].' new pendency created on '.$student['firstName'].' '.$student['lastName'].' Application by ADMITOFFER team',
                'application_status' =>'',
                'status' =>0,
            ]);

            $agent = Agent::where('id',$student['agent_id'])->first()->toArray();
            $data['agent'] = $agent;
            $data['student'] = $student;
            $data['link'] = route('student.show',base64_encode($student['id']));
            $mail =  Mail::send('emails.pendencyCreated', ['data' => $data], function($message) use ($data,$student) {
                $message->to($data['agent']['email']);
                $message->subject('New pendency created by AdmitOffer team on '.$student['firstName'].' '.$student['lastName'].' student');
                $message->from('himanshu@admitoffer.com','ADMITOFFER');
            });
        } else{
            $application = AppliedStudentFile::where('id',$request->application_id)->first();
            Notification::create([
                'type' =>'status pendency',
                'link' =>route('student.application.View',base64_encode($application['id'])),
                'agent_id' =>$application['agent_id'],
                'application_id' =>$application['id'],
                'message' =>'New Pendency Created on '.$application['id'].' Application',
                'application_status' =>'',
                'status' =>0,
            ]);

            $student = Student::where('id',$application['student_id'])->first()->toArray();
            $agent = Agent::where('id',$student['agent_id'])->first()->toArray();

            $data['agent'] = $agent;
            $data['student'] = $student;
            $data['link'] = route('student.application.View',base64_encode($application['id']));

            $mail =  Mail::send('emails.pendencyCreated', ['data' =>$data], function($message) use ($data,$student) {
                $message->to($data['agent']['email']);
                $message->subject('New pendency created by admitoffer on '.$student['firstName'].' '.$student['lastName'].' application');
                $message->from('himanshu@admitoffer.com','ADMITOFFER');
            });
        }
        Session::flash('success','Document Request Sent');
        return back();
    }

    public function tutionFeeReceipt(Request $request,$id)
    {
       if ($request->file) {
            $validator =  $this->validate($request,
            [
                'tutionFee' => 'required',
                'file' => 'required|mimes:pdf',
            ]
            );
            if($request->has('file')){
            $studentId = $request->studentId;
            $file = $request->file;
            $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                $destinationPath = 'uploads/student/tutionFee/'.$studentId;
            
            $file->move($destinationPath, $fileName);    
            ApplicationDocument::where('application_id',$id)->where('type','tutionFee')->delete();

            $attachment = ApplicationDocument::create([
                'application_id' =>$id,
                'student_id' =>$request->studentId,
                'comment' =>$request->other,
                'title' =>'Tution Fee',
                'type' =>'tutionFee',
                'name' => $fileName,
                'path' => $destinationPath,
                'status' => 1,
            ]);
            $fee = ApplicationFee::create([
                'application_id' =>$id,
                'attachment_id' => $attachment->id,
                'student_id' =>$request->studentId,
                'tution_fee' =>$request->tutionFee,
            ]);
            Session::flash('success','Tuition Reciept Saved');
            }
            
            $application = AppliedStudentFile::where('id',$id)->first();
            Notification::create([
                'type' =>'admin',
                'link' =>route('application.show',base64_encode($application['id'])),
                'agent_id' =>'',
                'from' =>$application['agent_id '],
                'to' =>$application['preProcessBy_id'],
                'application_id' =>$application['id'],
                'message' =>'T T copy of ' .$application->student['firstName'].' '.$application->student['lastName'].' Application of '.$application->course['name'].' Uploaded by agent '.$application->agent['name'],
                'application_status' =>'',
                'status' =>0,
                ]);
       }
       return back();
    }
    public function casDocUpload(Request $request,$id)
    {
       if ($request->file) {
            $validator =  $this->validate($request,
            [
                'file' => 'required|mimes:pdf|max:2100',
            ]
            );
            if($request->has('file')){
                $studentId = $request->studentId;
                $file = $request->file;
                $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                $destinationPath = 'uploads/student/casDoc/'.$studentId;
                
                $file->move($destinationPath, $fileName);    
                ApplicationDocument::where('application_id',$id)->where('type','casDoc')->delete();

                $attachment = ApplicationDocument::create([
                    'application_id' =>$id,
                    'student_id' =>$request->studentId,
                    'comment' =>$request->other,
                    'title' =>'CAS Document',
                    'type' =>'casDoc',
                    'name' => $fileName,
                    'path' => $destinationPath,
                    'status' => 1,
                ]);
            
                Session::flash('success','CAS Document Saved');
            }
       }
       $application = AppliedStudentFile::where('id',$id)->first();
       Notification::create([
           'type' =>'admin',
           'link' =>route('application.show',base64_encode($application['id'])),
           'agent_id' =>'',
           'from' =>$application['agent_id'],
           'to' =>$application['preProcessBy_id'],
           'application_id' =>$application['id'],
           'message' =>'CAS Document ' .$application->student['firstName'].' ' .$application->student['lastName'].' Application Uploaded by '.$application->agent['name'],
           'application_status' =>'',
           'status' =>0,
           ]);
       return back();
    }
    public function visaUpload(Request $request,$id)
    {
       if ($request->file) {
            $validator =  $this->validate($request,
            [
                'file' => 'required|mimes:pdf',
            ]
            );
            if($request->has('file')){
                $studentId = $request->studentId;
                $file = $request->file;
                $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
                $destinationPath = 'uploads/student/visa/'.$studentId;
                
                $file->move($destinationPath, $fileName);    
                ApplicationDocument::where('application_id',$id)->where('type','visa')->delete();

                $attachment = ApplicationDocument::create([
                    'application_id' =>$id,
                    'student_id' =>$request->studentId,
                    'comment' =>$request->other,
                    'title' =>'VISA Document',
                    'type' =>'visa',
                    'name' => $fileName,
                    'path' => $destinationPath,
                    'status' => 1,
                ]);
            
                Session::flash('success','visa Document Saved');
                $application = AppliedStudentFile::where('id',$id)->first();
                Notification::create([
                    'type' =>'admin',
                    'link' =>route('application.show',base64_encode($application['id'])),
                    'agent_id' =>'',
                    'from' =>$application['agent_id'],
                    'to' =>$application['preProcessBy_id'],
                    'application_id' =>$application['id'],
                    'message' =>'Visa Document of ' .$application->student['firstName'].' ' .$application->student['lastName'].' Application Uploaded',
                    'application_status' =>'',
                    'status' =>0,
                    ]);
            }
       }
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
        $validator =  $this->validate($request,
        [
            'file' => 'required|mimes:pdf',
            ]
        );
        $studentId = $request->studentId;
        $file = $request->file;
        $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
        $destinationPath = 'uploads/student/pendancies/'.$studentId;
        
        $file->move($destinationPath, $fileName);    
        
        $attachment = PendancyAttachment::where('id',$id)->update([
            'name' => $fileName,
            'path' => $destinationPath,
            'status' => 1,
            ]);
            $attachmentGet = PendancyAttachment::where('id',$id)->first();
        $application = AppliedStudentFile::where('id',$attachmentGet['application_id'])->first();
        
            $student = Student::where('id',$attachmentGet['student_id'])->first();
        if($application){

        Notification::create([
            'type' =>'admin',
            'link' =>route('application.show',base64_encode($application['id'])),
            'agent_id' =>'',
            'from' =>$application['agent_id'],
            'to' =>$attachmentGet['created_by'],
            'application_id' =>$application['id'],
            'message' =>'Pendency of program '.$application->course['name'].' uploaded for '.$application->student['firstName'].''.$application->student['lastName'].' by '.$application->agent['name'],
            'application_status' =>'',
            'status' =>0,
            ]);
      
        }else{
        Notification::create([
                'type' =>'admin',
                'link' =>route('studentfiles.show',base64_encode($student['id'])),
                'agent_id' =>'',
                'from' =>$student['agent_id'],
                'to' =>$attachmentGet['created_by'],
                'application_id' =>'',
                'message' =>'Pendency of program '.$student['firstName'].''.$student['lastName'].' by '.$student->agent['name'],
                'application_status' =>'',
                'status' =>0,
                ]);

        }
        Session::flash('success','Document Updated');
        return back();
    }
 
    public function accepted($id)
    {
        
        $attachmentDoc = PendancyAttachment::where('id',$id)->first();
        $student = Student::where('id',$attachmentDoc['student_id'])->first();
        $attachment = PendancyAttachment::where('id',$id)->update([
            'status' => 2,
            ]);
            $application = AppliedStudentFile::where('id',$attachmentDoc['application_id'])->first();
            if($application){

            Notification::create([
                'type' =>'status pendency document rejected',
                'link' =>route('student.application.View',base64_encode($application['id'])),
                'agent_id' =>$application['agent_id'],
                'application_id' =>$application['id'],
                'message' =>'Pendency Document of '.$application->student['firstName'].' '.$application->student['lastName'].' Application is accepted',
                'application_status' =>'',
                'status' =>0,
                ]);
            }else{

                Notification::create([
                'type' =>'status pendency document rejected',
                'link' =>route('student.show',base64_encode($student['id'])),
                'agent_id' =>$student['agent_id'],
                'application_id' =>'',
                'message' =>'Pendency Document of '.$student['firstName'].' '.$student['lastName'].' Application is accepted',
                'application_status' =>'',
                'status' =>0,
                ]);

            }
                
                
                Session::flash('success','Document Accepted');
                return back();
            }
            
    public function rejected(Request $request, $id)
    {
        $attachmentDoc = PendancyAttachment::where('id',$id)->first();
        $attachment = PendancyAttachment::where('id',$id)->update([
            'status' => 3,
            'reason' => $request->reason,
            ]);
        
        $application = AppliedStudentFile::where('id',$attachmentDoc['application_id'])->first();
        Notification::create([
            'type' =>'status pendency document rejected',
            'link' =>route('student.application.View',base64_encode($application['id'])),
            'agent_id' =>$application['agent_id'],
            'application_id' =>$application['id'],
            'message' =>'Pendency Document of '.$application['id'].' Application is rejected',
            'application_status' =>'',
            'status' =>0,
            ]);
        Session::flash('success','Document Updated');
        return back();
    }
    public function TutionAtachAccepted($id)
    {
        $pendAttach = ApplicationDocument::where('id',$id)->first();
        $attachment = ApplicationDocument::where('id',$id)->update([
            'status' => 2,
        ]);

        $application = AppliedStudentFile::where('id',$pendAttach['application_id'])->first();
        $student = $application->student;
        if ($student['applingForCountry'] == '230') {
            $fielStatus = 5;
        }elseif($student['applingForCountry'] == '38'){
            $fielStatus = 18;

        }
        AppliedStudentFile::where('id',$pendAttach['application_id'])->update([
            'file_status' => $fielStatus,
        ]);
      
        $application = AppliedStudentFile::where('id',$pendAttach['application_id'])->first();
        Notification::create([
            'type' =>'agent',
            'link' =>route('student.application.View',base64_encode($application['id'])),
            'agent_id' =>$application['agent_id'],
            'application_id' =>$application['id'],
            'message' =>'Tuition Reciept for '.$application->student['firstName'].' '.$application->student['lastName'].' Application Accepted',
            'application_status' =>'',
            'status' =>0,
            ]);
      
        Session::flash('success','Document Accepted');
        return back();
    }

    public function TutionAtachRejected(Request $request, $id)
    {
        $attachment = ApplicationDocument::where('id',$id)->update([
            'status' => 3,
            'comment' => $request->reason,
            ]);
        $attachmentDoc = ApplicationDocument::where('id',$id)->first();
        $application = AppliedStudentFile::where('id',$attachmentDoc['application_id'])->first();
        Notification::create([
            'type' =>'status tuition fee accepted',
            'link' =>route('student.application.View',base64_encode($application['id'])),
            'agent_id' =>$application['agent_id'],
            'application_id' =>$application['id'],
            'message' =>'Tuition Fee of '.$application->student['firstName'].' '.$application->student['lastName'].' application is rejected',
            'application_status' =>'',
            'status' =>0,
            ]);
        Session::flash('success','Document Updated');
        return back();
    }
    public function casDocAccepted($id)
    {
        $pendAttach = ApplicationDocument::where('id',$id)->first();
        $attachment = ApplicationDocument::where('id',$id)->update([
            'status' => 2,
        ]);
        $application = AppliedStudentFile::where('id',$pendAttach['application_id'])->first();
        Notification::create([
            'type' =>'status tuition fee accepted',
            'link' =>route('student.application.View',base64_encode($application['id'])),
            'agent_id' =>$application['agent_id'],
            'application_id' =>$application['id'],
            'message' =>'CAS Document of '.$application->student['firstName'].' '.$application->student['lastName'].' Application Accepted',
            'application_status' =>'',
            'status' =>0,
            ]);
      
        Session::flash('success','Document Accepted');
        return back();
    }

    public function casDocRejected(Request $request, $id)
    {
        $attachmentDoc = ApplicationDocument::where('id',$id)->first();
        $attachment = ApplicationDocument::where('id',$id)->update([
            'status' => 3,
            'comment' => $request->reason,
        ]);

        $application = AppliedStudentFile::where('id',$attachmentDoc['application_id'])->first();
        Notification::create([
            'type' =>'status tuition fee accepted',
            'link' =>route('student.application.View',base64_encode($application['id'])),
            'agent_id' =>$application['agent_id'],
            'application_id' =>$application['id'],
            'message' =>'CAS Document of '.$application->student['firstName'].' '.$application->student['lastName'].' Application is rejected',
            'application_status' =>'',
            'status' =>0,
            ]);
        Session::flash('success','Document Updated');
        return back();
    }
    public function visaDocAccepted($id)
    {
        $pendAttach = ApplicationDocument::where('id',$id)->first();
        $attachment = ApplicationDocument::where('id',$id)->update([
            'status' => 2,
        ]);

        $application = AppliedStudentFile::where('id',$pendAttach['application_id'])->first();
        $student = $application->student;
        if ($student['applingForCountry'] == '230') {
            $fielStatus = 10;
        }elseif($student['applingForCountry'] == '38'){
            $fielStatus = 20;

        }

        AppliedStudentFile::where('id',$pendAttach['application_id'])->update([
            'file_status' => $fielStatus,
        ]);
      
        Notification::create([
            'type' =>'status VISA document accepted',
            'link' =>route('student.application.View',base64_encode($application['id'])),
            'agent_id' =>$application['agent_id'],
            'application_id' =>$application['id'],
            'message' =>'VISA Document of '.$application['id'].' Application is accepted',
            'application_status' =>'',
            'status' =>0,
            ]);
      
        Session::flash('success','Document Accepted');
        return back();
    }

    public function visaDocRejected(Request $request, $id)
    {
        $attachmentDoc = ApplicationDocument::where('id',$id)->first();
        $attachment = ApplicationDocument::where('id',$id)->update([
            'status' => 3,
            'comment' => $request->reason,
        ]);
        $application = AppliedStudentFile::where('id',$attachmentDoc['application_id'])->first();
        Notification::create([
            'type' =>'status VISA document rejected',
            'link' =>route('student.application.View',base64_encode($application['id'])),
            'agent_id' =>$application['agent_id'],
            'application_id' =>$application['id'],
            'message' =>'VISA Document of '.$application['id'].' Application is rejected',
            'application_status' =>'',
            'status' =>0,
            ]);
        Session::flash('success','Document Updated');
        return back();
    }

    public function interviewSave(Request $request)
    {
        // dd($request->interviewScheduleDate);
        // dd($request->all());
        AppliedStudentFile::where('id',$request->application_id)->update([
            'interviewSchedule' => $request->interviewSchedule,
            'interviewScheduleDate' => $request->interviewScheduleDate,
            'interviewScheduleTime' => $request->interviewScheduleTime,
        ]);
      
      
        Session::flash('success','Schedule For Interview Saved');
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
       PendancyAttachment::where('id',$id)->delete();
       Session::flash('success','Document Deleted   ');
       return back();
    }
}
