<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Agent\AppliedStudentFile;
use App\Models\ApplicationStatus;
use App\Models\Agent\Student;
use App\Models\TeamProcessor;
use App\Models\ApplicationDocument;
use App\Models\PendancyAttachment;
use App\Models\Sop_pendency;
use App\Models\Notification;
use App\Models\ApplicationStatusTimeline;
use App\Models\College;
use App\Models\Course;
use App\Models\MergeIntake;
use Bitfumes\Multiauth\Model\Role;
use App\Agent;
use Validator;
use Session;
use Carbon;
use Auth;
use Mail;

class ApplicationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        ini_set('memory_limit', '-1');
        $user = auth('admin')->user()->roles()->pluck('name');
        $preProcess = auth('admin')->user();
        // dd($user[0]);
        if($user[0] == 'preprocess'){

            $allApplyStudents = AppliedStudentFile::with('college')->where('preProcessBy_id',(string)$preProcess['id'])->get();
                
            $getStudent = [];
            foreach($allApplyStudents as $allApplyStudent){
                $getStudent[] = $allApplyStudent['student_id'];
            }
            
            $appliedStudentFiles = Student::with(['appliedStudentFiles','country','agent'])->whereIn('id',$getStudent)->where('lock_status','1')->orderBy('id','DESC')->get();
        }elseif($user[0] == 'process'){
            $teamProcessors = TeamProcessor::where('process_id',(string)$preProcess['id'])->get();
            $allProcessApplication = [];
            foreach($teamProcessors as $teamProcessor){
                $allProcessApplication[] = $teamProcessor['application_id'];
            }

            $allApplyStudents = AppliedStudentFile::with('college')->whereIn('id',$allProcessApplication)->get();
                
            $getStudent = [];
            foreach($allApplyStudents as $allApplyStudent){
                $getStudent[] = $allApplyStudent['student_id'];
            }
            
            $appliedStudentFiles = Student::with(['appliedStudentFiles','country','agent'])->whereIn('id',$getStudent)->where('lock_status',1)->orderBy('id','DESC')->get();
        }elseif($user[0] == 'account manager'){
               $agents =  Agent::where('account_manager',$preProcess['id'])->pluck('id')->toArray();
               $getAppliedStudentFiles = AppliedStudentFile::with(['student','course','country'])->whereIn('agent_id',$agents)->get();
                $appliedStudentFiles = [];
                foreach ($getAppliedStudentFiles as $key => $value) {
                    if($value->student['lock_status'] == 1){

                        $appliedStudentFiles[] =  $value;
                    }
                }

           }else{
            $getAppliedStudentFiles = AppliedStudentFile::with(['student','course','country'])->get();
                $appliedStudentFiles = [];
            foreach ($getAppliedStudentFiles as $key => $value) {
                if($value->student['lock_status'] == 1){

                    $appliedStudentFiles[] =  $value;
                }
            }
        }
        
        return view('admin.applications.list',compact('appliedStudentFiles'));
    }
    public function pendingApplications()
    {
        $user = auth('admin')->user()->roles()->pluck('name');
        $preProcess = auth('admin')->user();
        // dd($user[0]);
        if($user[0] == 'preprocess'){

            $allApplyStudents = AppliedStudentFile::with('college')->where('preProcessBy_id',(string)$preProcess['id'])->where('file_status','1')->get();
                
            $getStudent = [];
            foreach($allApplyStudents as $allApplyStudent){
                $getStudent[] = $allApplyStudent['student_id'];
            }
            
            $appliedStudentFiles = Student::with(['appliedStudentFiles','country','agent'])->whereIn('id',$getStudent)->where('lock_status','1')->orderBy('id','DESC')->get();
        }elseif($user[0] == 'process'){
            $teamProcessors = TeamProcessor::where('process_id',(string)$preProcess['id'])->get();
            $allProcessApplication = [];
            foreach($teamProcessors as $teamProcessor){
                $allProcessApplication[] = $teamProcessor['application_id'];
            }

            $allApplyStudents = AppliedStudentFile::with('college')->whereIn('id',$allProcessApplication)->where('file_status','1')->get();
                
            $getStudent = [];
            foreach($allApplyStudents as $allApplyStudent){
                $getStudent[] = $allApplyStudent['student_id'];
            }
            
            $appliedStudentFiles = Student::with(['appliedStudentFiles,function($q){}','country','agent'])->whereIn('id',$getStudent)->where('lock_status',1)->orderBy('id','DESC')->get();
        }else{
            $appliedStudentFiles = AppliedStudentFile::with(['student','course','country'])->where('file_status','1')->get();
        }
        $appliedStudentFiles = $this->getPendingApplications($appliedStudentFiles);        
        return view('admin.applications.pendinglist',compact('appliedStudentFiles'));
    }

    public function getPendingApplications($applications)
    {
        $lastFiveDays =  Carbon\Carbon::now()->subDays(5);
        $resultApplications = [];
        foreach ($applications as $key => $value) {
            if($value['file_status_'] != 10 && $value['file_status_'] != 11 && $value['file_status_'] != 12){
            if($value['updated_at'] < $lastFiveDays){
                $resultApplications[] = $value; 
            }
            }
        }
        
        return $resultApplications;
    }
    public function todayAppltToUni()
    {
        $todaySentToUni =  ApplicationStatusTimeline::with('application')->where('status_id',2)->whereDate('status_date',Carbon\Carbon::now())->get();
            
        $appliedStudentFiles =  $todaySentToUni;

        return view('admin.applications.todayApplylist',compact('appliedStudentFiles'));
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
    public function statusApplications($id)
    {
        $id = base64_decode($id);
            $applys = AppliedStudentFile::with(['applicationStatus','college','student'=>function($qual){
                $qual->with(['qualificationLevel'])->get();
            },'course'=>function($q){
                $q->with(['intakes','course_levels','college'])->get();
            },'pendencies','offerLettr'])->where('file_status',$id)->get();

        
        $applications = [];
        foreach($applys as $application){
            if($application){
                if($application->student){
                    if($application->student['lock_status'] == '1'){
                        $applications[] = $application;
                    }
                }
            }
        }
        
        
        return view('admin.applications.statusList',compact('applications'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }
    public function updateApplicationStatus(Request $request)
    {
        
        AppliedStudentFile::where('id',$request->applicationId)->update([
            'file_status' => $request->status,
            ]);
       

        $hasStatus = ApplicationStatusTimeline::where('application_id',$request->applicationId)->where('status_id',$request->status)->first();
        if(!$hasStatus){
            ApplicationStatusTimeline::create([
                'application_id' =>$request->applicationId,
                'status_id' =>$request->status,
                'status_date' => date('Y-m-d H:i:s'),
                ]);
                    
        }
        $applicationSts = ApplicationStatus::where('id',$request->status)->first();
        $application = AppliedStudentFile::where('id',$request->applicationId)->first();
        $student = Student::where('id',$application['student_id'])->first();
                $admin = Auth::guard('admin')->user();
                $role = Role::where('id',$admin['id'])->first();
        if($role == '4'){

            Notification::create([
                'type' =>'admin',
                'user' =>$admin['id'],
                'link' =>route('application.show',base64_encode($request->applicationId)),
                'agent_id' =>$application['agent_id'],
                'student_id' =>$application['student_id'],
                'application_id' =>$request->applicationId,
                'message' =>'Application of '.$student['firstName'].' '.$student['lastName'].' for '.$application->course['name'].' in '.$application->course->college['name'].' status updated '.$applicationSts['name'],
                'application_status' =>'',
                'status' =>0,
                ]);

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
        
        Session::flash('success','Application status Updated');
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
        
        $id = base64_decode($id);
        $studentCourseApplyFors= AppliedStudentFile::with(['course'=>function($q){
            $q->with('college');
        },'student','country'])->where('id',$id)->first();
        $student = Student::with(['studentImage','studentDocument','GraduationDocument','passport','country','countryAddress','qualificationLevel'])->where('id',$studentCourseApplyFors['student_id'])->first();
        $applicationStatus = ApplicationStatus::get();
        $casDocument = ApplicationDocument::where('application_id',$id)->where('type','casDoc')->first();
        $visaDocument = ApplicationDocument::where('application_id',$id)->where('type','visa')->first();
        $applicationDocument = ApplicationDocument::where('application_id',$id)->where('type','offerletter')->first();
        $applicationLOAOfferDocument = ApplicationDocument::where('application_id',$id)->where('type','loaOfferLetter')->first();
        $applicationCASDocument = ApplicationDocument::where('application_id',$id)->where('type','clearCasDocument')->first();
        $applicationFee = ApplicationDocument::with('applicationFee')->where('application_id',$id)->where('type','tutionFee')->first();
        $sopDoc = Sop_pendency::where('application_id',$id)->first();
        $pendancyAttachments = PendancyAttachment::with('qualification','applicationCourse')->where('student_id',$student['id'])->where('application_id',$id)->where('type','!=','sopDocument')->get();
        $applicationStatusTimelines = ApplicationStatusTimeline::with(['status','application'])->where('application_id',$id)->get();
           $colleges =  College::get();
           $mergeIntakes =  MergeIntake::get();
        return view('admin.applications.view',compact('mergeIntakes','colleges','sopDoc','applicationStatusTimelines','applicationCASDocument','pendancyAttachments','visaDocument','casDocument','applicationFee','studentCourseApplyFors','student','applicationStatus','applicationDocument','applicationLOAOfferDocument'));
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

    public function getCourses($intake_id,$institute_id)
    {
        $courses = Course::where('college_id',$institute_id)->where('merge_intake_id',$intake_id)->get();
        return $courses;
    }
    public function UpdateChangeCourses(Request $request)
    {
        $validator =  $this->validate($request,
        [        
            'course_id' => 'required',
            ]
        );

        $applyStudentUpdate = AppliedStudentFile::where('id',(int)$request->application_id)->update(['course_id'=>$request->course_id,'file_status'=>'1','college_id'=>$request->institute]);
        Session::flash('success','Program Update');
        return back();
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
