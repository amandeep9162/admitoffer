<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Agent\AppliedStudentFile;
use App\Models\StudentQualification;
use App\Models\QualificationGrade;
use App\Models\StudentEnglishTest;
use App\Models\StudentWorkExperiance;
use App\Models\StudentQualificationGap;
use App\Models\StudentQuestionAnswers;
use App\Models\PendancyAttachment;
use App\Models\StudentAttachment;
use App\Models\Agent\Student;
use App\Models\Qualification;
use App\Models\EnglishTest;
use App\Models\EnglishScore;
use App\Models\MathScore;
use App\Models\IletsScore;
use App\Models\Loc\Country;
use App\Models\StudentQualificationTotal;
use App\Models\Loc\State;
use App\Models\Loc\City;
use App\Models\PreviousQualification;
use App\Models\QualificationBoard;
use App\Models\CountryQuestion;
use App\Models\Subject;
Use App\Helpers\ImageUpload;
use App\Models\Attachment;
use App\Models\Intake;
use App\Models\TeamPreProcess;
use App\Models\Notification;
use App\Models\TeamProcessor;
use App\Models\College;
use App\Models\ApplicationStatus;
use Bitfumes\Multiauth\Model\Role;
use App\Agent;
use Validator;
use Session;
use Carbon;

class AppliedStudentFileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $user = auth('admin')->user()->roles()->pluck('name');
        $preProcess = auth('admin')->user();
        // dd($user[0]);
        
        if($user[0] == 'preprocess'){
            $allApplyStudents = AppliedStudentFile::with('college')->where('preProcessBy_id',(string)$preProcess['id'])->get();
                
            $getStudent = [];
            foreach($allApplyStudents as $allApplyStudent){
                $getStudent[] = $allApplyStudent['student_id'];
            }
            
            $appliedStudentFiles = Student::with(['appliedStudentFiles','country','agent','appliedStudentFilesByAdmin'])->whereIn('id',$getStudent)->where('shortlisting','0')->orWhere('shortlisting',NULL)->where('lock_status',1)->get();
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
            
            $appliedStudentFiles = Student::with(['appliedStudentFiles','country','agent','appliedStudentFilesByAdmin'])->whereIn('id',$getStudent)->where('shortlisting','0')->orWhere('shortlisting',NULL)->where('lock_status',1)->get();
        }elseif($user[0] == 'account manager'){
               $agents =  Agent::where('account_manager',$preProcess['id'])->pluck('id')->toArray();

            $appliedStudentFiles = Student::with(['appliedStudentFiles','country','agent','appliedStudentFilesByAdmin'])->where('lock_status',1)->whereIn('agent_id',$agents)->get();

        }else{
            $appliedStudentFiles = Student::with(['appliedStudentFiles','country','agent','appliedStudentFilesByAdmin'])->where('shortlisting','0')->orWhere('shortlisting',NULL)->where('lock_status',1)->get();

        }
        // $appliedStudentFiles = AppliedStudentFile::where('lock_status',1)->get();
    
        return view('admin.appliedStudentFiles.list',compact('appliedStudentFiles'));
    }
    public function pendenciesApplications()
    {
        
        $user = auth('admin')->user()->roles()->pluck('name');
        $preProcess = auth('admin')->user();
        // dd($user[0]);
        
        if($user[0] == 'preprocess'){
            $allApplyStudents = AppliedStudentFile::with('college')->where('preProcessBy_id',(string)$preProcess['id'])->get();
                
            $getStudent = [];
            foreach($allApplyStudents as $allApplyStudent){
                $getStudent[] = $allApplyStudent['student_id'];
            }
            
            $appliedStudentFiles = Student::with(['appliedStudentFiles','country','agent','appliedStudentFilesByAdmin'])->whereIn('id',$getStudent)->where('shortlisting','0')->orWhere('shortlisting',NULL)->where('lock_status',1)->get();
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
            
            $appliedStudentFiles = Student::with(['appliedStudentFiles','country','agent','appliedStudentFilesByAdmin'])->whereIn('id',$getStudent)->where('shortlisting','0')->orWhere('shortlisting',NULL)->where('lock_status',1)->get();
        }elseif($user[0] == 'account manager'){
               $agents =  Agent::where('account_manager',$preProcess['id'])->pluck('id')->toArray();

            $appliedStudentFiles = Student::with(['appliedStudentFiles','country','agent','appliedStudentFilesByAdmin'])->where('lock_status',1)->whereIn('agent_id',$agents)->get();

        }else{
            $appliedStudentFiles = Student::with(['appliedStudentFiles','country','agent','appliedStudentFilesByAdmin'])->where('shortlisting','0')->orWhere('shortlisting',NULL)->where('lock_status',1)->get();

        }
        // $appliedStudentFiles = AppliedStudentFile::where('lock_status',1)->get();
    
        return view('admin.appliedStudentFiles.pendencieslist',compact('appliedStudentFiles'));
    }
    public function todayApplication()
    {
        $user = auth('admin')->user()->roles()->pluck('name');
        $preProcess = auth('admin')->user();
        // dd($user[0]);
        $today = Carbon\Carbon::now()->format('d-m-Y');

        if($user[0] == 'preprocess'){
            $allApplyStudents = AppliedStudentFile::with('college')->where('preProcessBy_id',(string)$preProcess['id'])->get();
                
            $getStudent = [];
            foreach($allApplyStudents as $allApplyStudent){
                $getStudent[] = $allApplyStudent['student_id'];
            }
            
            $appliedStudentFiles = Student::with(['appliedStudentFiles','country','agent','appliedStudentFilesByAdmin'])->whereIn('id',$getStudent)->where('lock_status',1)->where('applied_at',$today)->get();
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
            
            $appliedStudentFiles = Student::with(['appliedStudentFiles','country','agent','appliedStudentFilesByAdmin'])->whereIn('id',$getStudent)->where('lock_status',1)->where('applied_at',$today)->get();
        }elseif($user[0] == 'account manager'){
               $agents =  Agent::where('account_manager',$preProcess['id'])->pluck('id')->toArray();

            $appliedStudentFiles = Student::with(['appliedStudentFiles','country','agent','appliedStudentFilesByAdmin'])->where('lock_status',1)->whereIn('agent_id',$agents)->where('applied_at',$today)->get();

        }else{
            $appliedStudentFiles = Student::with(['appliedStudentFiles','country','agent','appliedStudentFilesByAdmin'])->where('lock_status',1)->where('applied_at',$today)->get();

        }
        // $appliedStudentFiles = AppliedStudentFile::where('lock_status',1)->get();
    
        return view('admin.appliedStudentFiles.list',compact('appliedStudentFiles'));
    }
     public function TotalShortlist()
    {
        $user = auth('admin')->user();
        if($user->roles[0]['name'] == 'shortlisting'){
        $getAppliedStudentFiles = Student::with(['appliedStudentFiles','country','agent','appliedStudentFilesByAdmin'])->where('applingForCountry',$user['country'])->where('IsShortlisting','yes')->get();
        }else{
         $getAppliedStudentFiles = Student::with(['appliedStudentFiles','country','agent','appliedStudentFilesByAdmin'])->where('IsShortlisting','yes')->get();

        }

     $appliedStudentFiles = $getAppliedStudentFiles;
    
        return view('admin.appliedStudentFiles.shortliststudent',compact('appliedStudentFiles'));
    }
    public function Shortlist()
    {
        
        $user = auth('admin')->user();
        if($user->roles[0]['name'] == 'shortlisting'){

        $getAppliedStudentFiles = Student::with(['appliedStudentFiles','country','agent','appliedStudentFilesByAdmin'])->where('applingForCountry',$user['country'])->where('student_status',NULL)->where('shortlisting','1')->get();
        }else{
            $getAppliedStudentFiles = Student::with(['appliedStudentFiles','country','agent','appliedStudentFilesByAdmin'])->where('student_status',NULL)->where('shortlisting','1')->get();
        }


        $appliedStudentFiles = [];

        foreach($getAppliedStudentFiles as $key => $value) {
            if($value->appliedStudentFiles->count() == 0){
            $appliedStudentFiles[] = $value;
            }
        }
    
        return view('admin.appliedStudentFiles.shortliststudent',compact('appliedStudentFiles'));
    }
     public function TodayShortlist()
    {
        
        $user = auth('admin')->user();
        
        if($user->roles[0]['name'] == 'shortlisting'){

        $getAppliedStudentFiles = Student::with(['appliedStudentFiles','country','agent','appliedStudentFilesByAdmin'])->where('applingForCountry',$user['country'])->where('IsShortlisting','yes')->where('applied_at',Carbon\Carbon::now()->format('d-m-Y'))->get();

        }else{

        $getAppliedStudentFiles = Student::with(['appliedStudentFiles','country','agent','appliedStudentFilesByAdmin'])->where('IsShortlisting','yes')->where('applied_at',Carbon\Carbon::now()->format('d-m-Y'))->get();
        }

        $appliedStudentFiles = [];

        foreach($getAppliedStudentFiles as $key => $value) {
            if($value->appliedStudentFiles->count() == 0 || $value['IsShortlisting'] == 'yes'){
            $appliedStudentFiles[] = $value;
            }
        }
    
        return view('admin.appliedStudentFiles.shortliststudent',compact('appliedStudentFiles'));
    }
    public function pendingFinalSubmit()
    {
        $user = auth('admin')->user()->roles()->pluck('name');
        $preProcess = auth('admin')->user();
        // dd($user[0]);
        if($user[0] == 'preprocess'){
            $allApplyStudents = AppliedStudentFile::with('college')->where('preProcessBy_id',(string)$preProcess['id'])->get();
                
            $getStudent = [];
            foreach($allApplyStudents as $allApplyStudent){
                $getStudent[] = $allApplyStudent['student_id'];
            }
            
            $appliedStudentFiles = Student::with(['appliedStudentFiles','country','agent'])->whereIn('id',$getStudent)->where('lock_status',0)->get();
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
            
            $appliedStudentFiles = Student::with(['appliedStudentFiles','country','agent'])->whereIn('id',$getStudent)->where('lock_status',0)->get();
        }else{
            $allApplyStudents = AppliedStudentFile::with('college')->get();
                  
                    $students = [];
            foreach ($allApplyStudents as $key => $value) {
                if($value->student['lock_status'] == 0){
                    $students[] = (int)$value['student_id'];
                }
            
            }
                
            $appliedStudentFiles = Student::with(['appliedStudentFiles','country','agent'])->whereIn('id',$students)->get();

        }
        // $appliedStudentFiles = AppliedStudentFile::where('lock_status',1)->get();
        return view('admin.appliedStudentFiles.pendingFinalSubmitlist',compact('appliedStudentFiles'));
    }
    public function addMoreProgram($id)
    {

        $id = base64_decode($id);
       
        Session::put('studentID',$id);
        $id = Session::get('studentID');

        $qualifications = Qualification::get();
        $englishTests = EnglishTest::get();
        $englishScores = EnglishScore::all();
        $iletsScores = IletsScore::get();
        $mathScores = MathScore::all();
        $countries = Country::all();
        $qualificationPercentages = StudentQualificationTotal::where('type','percentage')->get();
        $qualificationDivisions = StudentQualificationTotal::where('type','division')->get();
        $qualificationGpas = StudentQualificationTotal::where('type','gpa')->get();
        $data = Student::with(['studentImage','passport','lor','moi','sop'])->where('id',$id)->first();
        
        $states = State::where('country_id',$data['country_id'])->get();
        $cities = City::where('state_id',$data['state_id'])->get();
        if($data['applingForCountry'] && $data['applingForLevel'] && $data['status'] && $data['title'] && $data['dateOfBirth'] && $data['email'] && $data['firstName'] && $data['lastName'] && $data['mobileNo'] && $data['maritalStatus'] && $data['gender'] && $data['englishScore']){

            Session::put('openNext','openNextSession');
        }
        $isEdit = 'yes';
        Session::put('edit','yes');
        Session::put('isUpdate','no');
        $questions = CountryQuestion::with('question')->where('country_id',$data['applingForCountry'])->get();
        
        $studentQualifications = StudentQualification::with(['student','qualification','country','state','city','totals','documents','boards'])->where('student_id',$id)->get();
        $studentEnglishTests = StudentEnglishTest::with(['student','englishTests','totalScores','documents'])->where('student_id',$id)->get();
        $studentWorkExperiances = StudentWorkExperiance::with('documents')->where('student_id',$id)->get();
        $studentQualificationGaps = StudentQualificationGap::with('documents')->where('student_id',$id)->get();
        $subjects = Subject::all();
        $studentQuestionAnswers = StudentQuestionAnswers::with(['questions'=>function($query){
            $query->with(['question'])->get();
        }])->where('student_id',$id)->get();
        $PreviousQualifications = PreviousQualification::all();
        $boards = QualificationBoard::orderBy('name')->get();
         $student = Student::with(['studentImage','appliedStudentFiles'])->where('id',$id)->first();
          Session::put('Fcategory',$student['category']);
        Session::put('FstudentId',$student['id']);
        Session::put('student',$student['id']);
        Session::put('FcountryId',$student['applingForCountry']);
        Session::put('FstudentName',$student['firstName']);
        Session::put('FapplingForLevel',$student['applingForLevel']);   
        Session::put('student',$student);
        return redirect()->route('search.index',compact('student'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.appliedStudentFiles.addNewFile');
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
            'title' => 'required|max:255',
            'qualification' => 'required',
            'student' => 'required',
            'country_id' => 'required',
            'college_id' => 'required',
            'subject_id' => 'required',
            'course_id' => 'required',
            ]
        );
        $applyStudent = AppliedStudentFile::create([
            'title' => $request->title,
            'description' => $request->description,
            'student_id' => $request->student,
            'country_id' => $request->country_id,
            'qualification' => $request->qualification,
            'college_id' => $request->college_id,
            'subject_id' => $request->subject_id,
            'course_id' => $request->course_id,
            
            ]);
        Session::flash('success','New File Request Submitted');
        return back()->withInput($request->all());
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
        // dd($id);
        $user = auth('admin')->user()->roles()->pluck('name');
        $preProcess = auth('admin')->user();
        
        $student = Student::with(['studentImage','studentDocument','GraduationDocument','passport','country','countryAddress','qualificationLevel'])->where('id',$id)->first();
        $studentLor = StudentAttachment::where('student_id',$id)->where('type','lor')->first();
        $studentMoi = StudentAttachment::where('student_id',$id)->where('type','moi')->first();
        $studentSop = StudentAttachment::where('student_id',$id)->where('type','sop')->first();
        $studentQualifications = StudentQualification::with(['student','qualification','country','state','city','totals','documents','qualificationDocuments','boards'])->where('student_id',$id)->get();
        $qualificationGrades = QualificationGrade::get();
        $studentEnglishTests = StudentEnglishTest::with(['student','englishTests','totalScores','documents','englishTestDocuments'])->where('student_id',$id)->get();
        $studentWorkExperiances = StudentWorkExperiance::with('documents')->where('student_id',$id)->get();
        $studentQualificationGaps = StudentQualificationGap::with(['documents','gapDocument'])->where('student_id',$id)->get();
        if($user[0] == 'preprocess'){
            $studentCourseApplyFors= AppliedStudentFile::with(['course'=>function($q){
                $q->with('college');
            },'student','country','applicationStatus','university','country'])->where('preProcessBy_id',(string)$preProcess['id'])->where('student_id',$id)->get();
            
            $teamPreProcess = TeamPreProcess::with('admins')->where('preProcess_id',(string)$preProcess['id'])->get();
        }elseif($user[0] == 'process'){
            
            $teamProcessors = TeamProcessor::where('student_id',$id)->where('process_id',(string)$preProcess['id'])->get();
            $allProcessApplication = [];
            foreach($teamProcessors as $teamProcessor){
                $allProcessApplication[] = (int)$teamProcessor['application_id'];
            }
            
            $studentCourseApplyFors= AppliedStudentFile::with(['course'=>function($q){
                $q->with('college');
            },'student','country','applicationStatus','university','country'])->whereIn('id',$allProcessApplication)->get();
            
            $teamPreProcess = [];
            
            
        }else{
            $teamPreProcess = TeamPreProcess::with('admins')->get();
            $studentCourseApplyFors= AppliedStudentFile::with(['course'=>function($q){
                $q->with('college');
            },'student','country','applicationStatus','university','country'])->where('student_id',$id)->get();
        }
        
        $studentQuestionAnswers = StudentQuestionAnswers::with(['questions'=>function($query){
            $query->with(['question'])->get();
        }])->where('student_id',$id)->get();
        $pendancyAttachments = PendancyAttachment::with('qualification','applicationCourse')->where('student_id',$id)->where('application_id',null)->where('type','!=','other')->where('type','!=','otherAdminDoc')->where('type','!=','sopDocument')->get();
        $otherAttachments = PendancyAttachment::with('applicationCourse')->where('student_id',$id)->where('application_id',null)->where('type','other')->where('type','!=','sopDocument')->get();
        $otherAdminDocAttachments = PendancyAttachment::with('applicationCourse')->where('student_id',$id)->where('application_id',null)->where('type','otherAdminDoc')->where('type','!=','sopDocument')->get();
        return view('admin.appliedStudentFiles.viewStudentFile',compact('studentLor','studentMoi','studentSop','student','studentQualifications','studentEnglishTests','studentWorkExperiances','studentQualificationGaps','studentCourseApplyFors','studentQuestionAnswers','qualificationGrades','pendancyAttachments','teamPreProcess','otherAttachments','otherAdminDocAttachments'));
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
        $applyStudent = AppliedStudentFile::where('id',$id)->first();
        return view('admin.appliedStudentFiles.editFile',compact('applyStudent'));
    }
    /**
     * Show the form for updateAcceptStatus the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateAcceptStatus($id)
    {
        $applyStudent = StudentAttachment::where('id',$id)->update(['status'=>'1']);
        $document = StudentAttachment::where('id',$id)->first();
        $Student = Student::where('id',$document['student_id'])->first();
        Notification::create([
            'type' =>'status student document accepted',
            'link' =>route('student.show',base64_encode($Student['id'])),
            'agent_id' =>$Student['agent_id'],
            'application_id' =>'',
            'message' =>$document['type'].' Document of Student '.$Student['firstName'].' is accepted',
            'application_status' =>'',
            'status' =>0,
            ]);
        return back();
    }
    public function updateStudentComment(Request $request)
    {
        
        $applyStudent = Student::where('id',$request->studentId)->update(['comment'=>$request->comment]);
        
        Session::flash('success','comment added');
        return back();
    }
    public function updateRejectStatus($id)
    {
        $applyStudent = StudentAttachment::where('id',$id)->update(['status'=>'2']);
        
        $document = StudentAttachment::where('id',$id)->first();
        $Student = Student::where('id',$document['student_id'])->first();
        Notification::create([
            'type' =>'status student document rejected',
            'link' =>route('student.show',base64_encode($Student['id'])),
            'agent_id' =>$Student['agent_id'],
            'application_id' =>'',
            'message' =>$document['type'].' Document of Student '.$Student['firstName'].' is rejected',
            'application_status' =>'',
            'status' =>0,
            ]);
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
        $validator =  $this->validate($request,
        [        
            'title' => 'required|max:255',
            'qualification' => 'required',
            'student' => 'required',
            'country_id' => 'required',
            'college_id' => 'required',
            'subject_id' => 'required',
            'course_id' => 'required',
        ]
        );
        $student = AppliedStudentFile::where('id',$id)->update([
            'title' => $request->title,
            'description' => $request->description,
            'student_id' => $request->student,
            'country_id' => $request->country_id,
            'course_id' => $request->course_id,
            'qualification' => $request->qualification,
            'college_id' => $request->college_id,
            'subject_id' => $request->subject_id,
            
            ]);
            Session::flash('success','File Updated');
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
        AppliedStudentFile::where('id',$id)->delete();
        Session::flash('success','File deleted');
        return back();
    }
    public function getApplications()
    {
        $agents = Agent::get();
        $intakes = Intake::get();
        $colleges = College::get();
        $applicationStatus = ApplicationStatus::get();
        $user = auth('admin')->user()->roles()->pluck('name');
        $preProcess = auth('admin')->user();
        // dd($user[0]);
        if($user[0] == 'preprocess'){
            $appliedStudentFiles = AppliedStudentFile::with(['course'=>function($q){
                $q->with(['college','intakes']);
            },'student','country','applicationStatus','agent'])->where('preProcessBy_id',(string)$preProcess['id'])->get();
                
            // $getStudent = [];
            // foreach($allApplyStudents as $allApplyStudent){
            //     $getStudent[] = $allApplyStudent['student_id'];
            // }
            
            // $appliedStudentFiles = Student::with(['appliedStudentFiles','country','agent'])->whereIn('id',$getStudent)->where('lock_status',1)->orderBy('id','DESC')->get();
        }elseif($user[0] == 'process'){
            $teamProcessors = TeamProcessor::where('process_id',(string)$preProcess['id'])->get();
            $allProcessApplication = [];
            foreach($teamProcessors as $teamProcessor){
                $allProcessApplication[] = $teamProcessor['application_id'];
            }

            $appliedStudentFiles = AppliedStudentFile::with(['course'=>function($q){
                $q->with(['college','intakes']);
            },'student','country','applicationStatus','agent'])->whereIn('id',$allProcessApplication)->get();
                
            // $getStudent = [];
            // foreach($allApplyStudents as $allApplyStudent){
            //     $getStudent[] = $allApplyStudent['student_id'];
            // }
            
            // $appliedStudentFiles = Student::with(['appliedStudentFiles','country','agent'])->whereIn('id',$getStudent)->where('lock_status',1)->orderBy('id','DESC')->get();
        }else{
        $appliedStudentFiles = AppliedStudentFile::with(['course'=>function($q){
            $q->with(['college','intakes']);
        },'student','country','applicationStatus','agent'])->get();
        }
        return  ['appliedStudentFiles'=>$appliedStudentFiles,'agents'=>$agents,'intakes'=>$intakes,'colleges'=>$colleges,'applicationStatus'=>$applicationStatus];
    }
     public function getpendingApplications()
    {
        $agents = Agent::get();
        $intakes = Intake::get();
        $colleges = College::get();
        $applicationStatus = ApplicationStatus::get();
        $user = auth('admin')->user()->roles()->pluck('name');
        $preProcess = auth('admin')->user();
        // dd($user[0]);
        if($user[0] == 'preprocess'){
            $appliedStudentFiles = AppliedStudentFile::with(['course'=>function($q){
                $q->with(['college','intakes']);
            },'student','country','applicationStatus','agent'])->where('preProcessBy_id',(string)$preProcess['id'])->where('file_status','1')->get();
                
            // $getStudent = [];
            // foreach($allApplyStudents as $allApplyStudent){
            //     $getStudent[] = $allApplyStudent['student_id'];
            // }
            
            // $appliedStudentFiles = Student::with(['appliedStudentFiles','country','agent'])->whereIn('id',$getStudent)->where('lock_status',1)->orderBy('id','DESC')->get();
        }elseif($user[0] == 'process'){
            $teamProcessors = TeamProcessor::where('process_id',(string)$preProcess['id'])->get();
            $allProcessApplication = [];
            foreach($teamProcessors as $teamProcessor){
                $allProcessApplication[] = $teamProcessor['application_id'];
            }

            $appliedStudentFiles = AppliedStudentFile::with(['course'=>function($q){
                $q->with(['college','intakes']);
            },'student','country','applicationStatus','agent'])->whereIn('id',$allProcessApplication)->where('file_status','1')->get();
                
            $getStudent = [];
            foreach($allApplyStudents as $allApplyStudent){
                $getStudent[] = $allApplyStudent['student_id'];
            }
            
            // $appliedStudentFiles = Student::with(['appliedStudentFiles','country','agent'])->whereIn('id',$getStudent)->where('lock_status',1)->orderBy('id','DESC')->get();
        }else{
        $appliedStudentFiles = AppliedStudentFile::with(['course'=>function($q){
            $q->with(['college','intakes']);
        },'student','country','applicationStatus','agent'])->where('file_status','1')->get();
        }
        return  ['appliedStudentFiles'=>$appliedStudentFiles,'agents'=>$agents,'intakes'=>$intakes,'colleges'=>$colleges,'applicationStatus'=>$applicationStatus];
    }
}
