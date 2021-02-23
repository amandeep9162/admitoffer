<?php

namespace App\Http\Controllers\Agent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Agent\Student;
use App\Models\Agent\AppliedStudentFile;
use App\Models\StudentQualification;
use App\Models\StudentQualificationGap;
use App\Models\QualificationBoard;
use App\Models\StudentQuestionAnswers;
use Bitfumes\Multiauth\Model\Admin;
use App\Models\Payment;
use Bitfumes\Multiauth\Model\Role;
use App\Models\StudentEnglishTest;
use App\Models\Sop_pendency;
use App\Models\AllowCountryAgent;
use App\Models\StudentWorkExperiance;
use App\Models\ApplicationStatus;
use App\Models\PendancyAttachment;
use App\Models\Question;
use App\Models\Subject;
use App\Models\Loc\Country;
use App\Models\Loc\State;
use App\Models\Loc\City;
Use App\Helpers\ImageUpload;
use App\Models\Attachment;
use App\Models\StudentQualificationTotal;
use App\Models\PreviousQualification;
use App\Models\StudentAttachment;
use App\Models\Qualification;
use App\Models\QualificationGrade;
use App\Models\QualificationLevelGrade;
use App\Models\EnglishTest;
use App\Models\EnglishScore;
use App\Models\MathScore;
use App\Models\IletsScore;
use App\Models\CountryQuestion;
use App\Models\ApplicationDocument;
use App\Models\ApplicationStatusTimeline;
use App\Models\Notification;
use Response;
use Validator;
use Session;
use Carbon;
use Auth;
use Mail;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        // dd('dsfdsf');
        // $this->middleware('agent.auth:agent');
    }
    public function index($id='null')
    { 
       
        $user =Auth::guard('agent')->user();
        Session::forget('document');
        Session::forget('studentID');
        Session::forget('hasFinanceDocument');
        Session::forget('openNext');
        Session::forget('student');
        $students = Student::with(['previousQualifications','studentImage','appliedStudentFiles','country','pendeciesStudentFiles','countryAddress','grade10'=>function($g){
            $g->with(['totals','boards'])->get();
        },'grade12'=>function($g){
            $g->with(['totals','boards'])->get();
        }])->where('agent_id',$user['id'])->orderBy('id','desc')->get();
        return view('agent.student.students',compact('students'));
    }
    public function pendency($id='null')
    { 
        $user =Auth::guard('agent')->user();
        Session::forget('document');
        Session::forget('studentID');
        Session::forget('hasFinanceDocument');
        Session::forget('openNext');
        Session::forget('student');
        $Pendstudents = Student::with(['previousQualifications','studentImage','appliedStudentFiles','country','pendeciesStudentFiles','countryAddress','grade10'=>function($g){
            $g->with(['totals'])->get();
        },'grade12'=>function($g){
            $g->with(['totals'])->get();
        }])->where('agent_id',$user['id'])->orderBy('id','desc')->get();
        $students = [];
        foreach($Pendstudents as $Pendstudent){
            if($Pendstudent->pendeciesStudentFiles){
                if($Pendstudent->pendeciesStudentFiles->count() > 0){
                    $students[] = $Pendstudent;
                }
            }
        }
        return view('agent.student.studentsPendencies',compact('students'));
    }
    public function Applicationpendency($id='null')
    { 
        
        $user =Auth::guard('agent')->user();
        Session::forget('document');
        Session::forget('studentID');
        Session::forget('hasFinanceDocument');
        Session::forget('openNext');
        Session::forget('student');
     

        $students = Student::where('agent_id',$user['id'])->get();
        $studentsArray = [];
            foreach($students as $student){
                $studentsArray[] = $student['id'];
            }

        $Pendstudents = PendancyAttachment::with(['applicationCourse'=>function($q){
            $q->with(['intakes','college'=>function($uni){
                $uni->with(['university'])->get();
            }])->get();
        },'student'])->whereIn('student_id',$studentsArray)->where('status',0)->get();
        // $students = '';

        $applications = AppliedStudentFile::with(['student'=>function($qual){
            $qual->with(['qualificationLevel'])->get();
        },'course'=>function($q){
            $q->with(['intakes','college'=>function($uni){
                $uni->with(['university'])->get();
            }])->get();
        },'pendencies'])->where('agent_id',$user['id'])->get();

        $Pendstudents = [];
        foreach($applications as $application){
            if($application->pendencies){
                if($application->pendencies->count() > 0){
                    $Pendstudents[] = $application;
                }
            }
        }
        return view('agent.student.studentsApplPendencies',compact('Pendstudents'));
    }
    public function ApplicationOffers($id='null')
    { 
        $user =Auth::guard('agent')->user();
        Session::forget('document');
        Session::forget('studentID');
        Session::forget('hasFinanceDocument');
        Session::forget('openNext');
        Session::forget('student');
     

        $students = Student::where('agent_id',$user['id'])->get();
        $studentsArray = [];
            foreach($students as $student){
                $studentsArray[] = $student['id'];
            }

        $Pendstudents = PendancyAttachment::with(['applicationCourse'=>function($q){
            $q->with(['intakes','college'=>function($uni){
                $uni->with(['university'])->get();
            }])->get();
        },'student'])->whereIn('student_id',$studentsArray)->where('status',0)->get();
        // $students = '';

        $applications = AppliedStudentFile::with(['applicationStatus','college','student'=>function($qual){
            $qual->with(['qualificationLevel'])->get();
        },'course'=>function($q){
            $q->with(['intakes','course_levels','college'=>function($uni){
                $uni->with(['university'])->get();
            }])->get();
        },'pendencies','offerLettr'])->where('agent_id',$user['id'])->get();

        $Pendstudents = [];
        foreach($applications as $application){
            if($application){
                if($application['file_status'] > 2 && $application['file_status'] < 5 ){
                    $Pendstudents[] = $application;
                }
            }
        }
        return view('agent.student.studentsApplOffers',compact('Pendstudents'));
    }
    public function AllVisaReceived($id='null')
    { 
        $user =Auth::guard('agent')->user();
        Session::forget('document');
        Session::forget('studentID');
        Session::forget('hasFinanceDocument');
        Session::forget('openNext');
        Session::forget('student');
     

        $students = Student::where('agent_id',$user['id'])->get();
        $studentsArray = [];
            foreach($students as $student){
                $studentsArray[] = $student['id'];
            }

        $Pendstudents = PendancyAttachment::with(['applicationCourse'=>function($q){
            $q->with(['intakes','college'=>function($uni){
                $uni->with(['university'])->get();
            }])->get();
        },'student'])->whereIn('student_id',$studentsArray)->where('status',0)->get();
        // $students = '';

        $applications = AppliedStudentFile::with(['applicationStatus','college','student'=>function($qual){
            $qual->with(['qualificationLevel'])->get();
        },'course'=>function($q){
            $q->with(['intakes','course_levels','college'=>function($uni){
                $uni->with(['university'])->get();
            }])->get();
        },'pendencies','offerLettr'])->where('agent_id',$user['id'])->get();

        $Pendstudents = [];
        foreach($applications as $application){
            if($application){
                if($application['file_status'] == 10 ){
                    $Pendstudents[] = $application;
                }
            }
        }
        return view('agent.student.studentsApplOffers',compact('Pendstudents'));
    }
    public function AllApplications($id='null')
    { 
        $user =Auth::guard('agent')->user();
        Session::forget('document');
        Session::forget('studentID');
        Session::forget('hasFinanceDocument');
        Session::forget('openNext');
        Session::forget('student');
     

        $students = Student::where('agent_id',$user['id'])->get();
        $studentsArray = [];
            foreach($students as $student){
                $studentsArray[] = $student['id'];
            }

        $Pendstudents = PendancyAttachment::with(['applicationCourse'=>function($q){
            $q->with(['intakes','college'=>function($uni){
                $uni->with(['university'])->get();
            }])->get();
        },'student'])->whereIn('student_id',$studentsArray)->where('status',0)->get();
        // $students = '';

        if(Auth::guard('student')->check() === true){

            $studentUser = Auth::guard('student')->user();
            $applications = AppliedStudentFile::with(['applicationStatus','college','student'=>function($qual){
                $qual->with(['qualificationLevel'])->get();
            },'course'=>function($q){
                $q->with(['intakes','course_levels','college'])->get();
            },'pendencies','offerLettr'])->where('student_id',$studentUser['id'])->where('agent_id',NULL)->get();
           
            
        }else{
            
            $applications = AppliedStudentFile::with(['applicationStatus','college','student'=>function($qual){
                $qual->with(['qualificationLevel'])->get();
            },'course'=>function($q){
                $q->with(['intakes','course_levels','college'])->get();
            },'pendencies','offerLettr'])->where('agent_id',$user['id'])->get();

        }
        $Pendstudents = [];
        foreach($applications as $application){
            if($application){
                if($application['file_status'] >= 1 ){
                    $Pendstudents[] = $application;
                }
            }
        }
        
        return view('agent.student.allApplications',compact('Pendstudents'));
    }
    public function AllApplicationsStatus($id='null')
    { 
        $id = base64_decode($id);
            $user =Auth::guard('agent')->user();
            $applications = AppliedStudentFile::with(['applicationStatus','college','student'=>function($qual){
                $qual->with(['qualificationLevel'])->get();
            },'course'=>function($q){
                $q->with(['intakes','course_levels','college'])->get();
            },'pendencies','offerLettr'])->where('agent_id',$user['id'])->where('file_status',$id)->get();

            $Pendstudents = $applications;
        return view('agent.student.allApplications',compact('Pendstudents'));
    }
    public function PendingTTCopy($id='null')
    { 
        $id = base64_decode($id);
            $user =Auth::guard('agent')->user();
            
            $applications = AppliedStudentFile::with(['applicationStatus','college','student'=>function($qual){
                $qual->with(['qualificationLevel'])->get();
            },'course'=>function($q){
                $q->with(['intakes','course_levels','college'])->get();
            },'pendencies','offerLettr'])->where('agent_id',$user['id'])->where('file_status','>',2)->where('file_status','<',5)->get();
            
            $Pendstudents = $applications;
        return view('agent.student.allApplications',compact('Pendstudents'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id='null')
    {
        // if($id != 'null'){
        //     $id = $id;
        //     Session::forget('studentID');
        //     Session::put('studentID',$id);
        // //    $route = \Request::route()->getName();
        // //    dd($route);
        // }

        // dd(app('request')->create(app('url')->previous()->getName()));
        // @if(app('router')->getRoutes()->match(app('request')->create(URL::previous()))->getName() == 'student.edit')
        //     Session::forget('studentID');
        // @endif
        $edit = Session::get('edit');
        if($edit == 'yes'){
            Session::forget('openNext');
            Session::forget('student');
            Session::forget('studentID');
            Session::forget('edit');
        }
        $id = Session::get('studentID');
        
        $englishTests = EnglishTest::get();
        $englishScores = EnglishScore::all();
        $mathScores = MathScore::all();
        $iletsScores = IletsScore::where('english_test','IELTS')->get();
        $boards = QualificationBoard::orderBy('name')->get();
        $countries = Country::all();
        $qualificationPercentages = StudentQualificationTotal::where('type','percentage')->get();
        $qualificationDivisions = StudentQualificationTotal::where('type','division')->get();
        $qualificationGpas = StudentQualificationTotal::where('type','gpa')->get();
        $data = Student::with(['studentImage','passport'])->where('id',$id)->first();
        if($data['applingForCountry']){

        $qualifications = Qualification::where('country',$data['applingForCountry'])->orWhere('country',NULL)->get();
        }else{
        $qualifications = [];

        }
        $states = State::where('country_id',$data['country_id'])->get();
        $cities = City::where('state_id',$data['state_id'])->get();
        $isEdit = 'no';
        $questions = CountryQuestion::with('question')->where('country_id',$data['applingForCountry'])->get();
        
        $studentQualifications = StudentQualification::with(['student','qualification','country','state','city','totals','documents'])->where('student_id',$id)->get();
        $studentEnglishTests = StudentEnglishTest::with(['student','englishTests','totalScores','documents'])->where('student_id',$id)->get();
        $studentWorkExperiances = StudentWorkExperiance::with('documents')->where('student_id',$id)->get();
        $studentQualificationGaps = StudentQualificationGap::with('documents')->where('student_id',$id)->get();
        $subjects = Subject::all();

        $agentAllowCountry = AllowCountryAgent::where('agent_id',Auth::guard('agent')->user()->id)->pluck('country_id')->toArray();
        $studentQuestionAnswers = StudentQuestionAnswers::with(['questions'=>function($query){
            $query->with(['question'])->get();
        }])->where('student_id',$id)->get();
        $PreviousQualifications = PreviousQualification::all();
            
        return view('agent.student.addStudent',compact('agentAllowCountry','boards','englishScores','mathScores','qualificationGpas','qualificationDivisions','qualificationPercentages','qualifications','data','countries','englishTests','iletsScores','isEdit','studentQualifications','studentEnglishTests','studentWorkExperiances','studentQualificationGaps','states','cities','questions','studentQuestionAnswers','subjects','PreviousQualifications'));
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function saveStudent(Request $request)
    {   
        $user =Auth::guard('agent')->user();
        if($request->has('image')){
            $request->validate([
                'image' => '|mimes:jpeg,jpg,png|max:2200',
            ]);
        }
        if($request->mobile){
            $request->validate([
                'mobile' => 'required|digits:10',
            ]);
        }
        if(!$request->studentId){
        $student = Student::create([
            'title' => $request->title,
            'address' => $request->address,
            'applingForCountry' => $request->apply_country_id,
            'applingForLevel' => $request->apply_qualification_level,
            'category' => $request->category,
            'countryOfBirth' => $request->birth_country_id,
            'dateOfBirth' => $request->dateOfBirth,
            'detail' => $request->detail,
            'email' => $request->email,
            'firstLanguage' => $request->firstLanguage,
            'firstName' => $request->firstName,
            'middleName' => $request->middleName,
            'lastName' => $request->lastName,
            'city_id' => $request->mailing_city_id,
            'country_id' => $request->mailing_country_id,
            'state_id' => $request->mailing_state_id,
            'mobileNo' => $request->mobile,
            'nationality' => $request->nationality_country_id,
            'passportExpiryDate' => $request->passportExpiryDate,
            'passportIssueDate' => $request->passportIssueDate,
            'previousQualification' => $request->previousQualification,
            'englishScore' => $request->englishScores,
            'mathScore' => $request->mathScore,
            'passportNo' => $request->passportNo,
            'phoneNo' => $request->phone,
            'skypeId' => $request->skypeId,
            'studentId' => $request->studentId,
            'zipCode' => $request->zipCode,
            'maritalStatus' => $request->maritalStatus,
            'status' => $request->status,
            'gender' => $request->gender,
            'agent_id' => $user['id'],
            ]);
            $student->save();
            
            $agentName = substr($user['name'],0,2);
            $agentId = substr($user['id'],0,1);
            $studentName = substr($request['firstName'],0,2);

            $studentUniqueId = 'ST'.$student['id'].strtoupper($agentName).$agentId;
            $studentUp = Student::where('id',$student['id'])->update([
                'student_unique_id' => $studentUniqueId,
            ]);
            $attachmentId  = $student['id'];
            Session::put('studentID',$student['id']);
            if($request->image){
                $studentId = Session::get('studentID');
            
                $file = $request->image;
                $studentSaveDocument = ImageUpload::uploadStudentDocuments($file,'StudentImage',$studentId,$comment=Null);
                
            }
            Session::flash('success','New Student created');
            return ['status'=>'true','studentId'=>$student['id'],'studentUniqueId'=>$studentUniqueId];
        }else{
            $studentOnChange = Student::where('id',$request->studentId)->first();
            if(!array_key_exists('apply_country_id',$request->all())){
                $request['apply_country_id'] = $studentOnChange['applingForCountry'];
            }
            if(!array_key_exists('apply_qualification_level',$request->all())){
                $request['apply_qualification_level'] = $studentOnChange['applingForLevel'];
            }
            if(!array_key_exists('status',$request->all())){
                $request['status'] = $studentOnChange['status'];
            }
            if(!array_key_exists('category',$request->all())){
                $request['category'] = $studentOnChange['category'];
            }


            $student = Student::where('id',$request->studentId)->update([
                'title' => $request->title,
                'address' => $request->address,
                'applingForCountry' => $request->apply_country_id,
                'applingForLevel' => $request->apply_qualification_level,
                'category' => $request->category,
                'countryOfBirth' => $request->birth_country_id,
                'dateOfBirth' => $request->dateOfBirth,
                'detail' => $request->detail,
                'email' => $request->email,
                'firstLanguage' => $request->firstLanguage,
                'firstName' => $request->firstName,
                'middleName' => $request->middleName,
                'lastName' => $request->lastName,
                'city_id' => $request->mailing_city_id,
                'country_id' => $request->mailing_country_id,
                'state_id' => $request->mailing_state_id,
                'mobileNo' => $request->mobile,
                'nationality' => $request->nationality_country_id,
                'passportExpiryDate' => $request->passportExpiryDate,
                'passportIssueDate' => $request->passportIssueDate,
                'previousQualification' => $request->previousQualification,
                'englishScore' => $request->englishScores,
                'mathScore' => $request->mathScore,
                'passportNo' => $request->passportNo,
                'phoneNo' => $request->phone,
                'skypeId' => $request->skypeId,
                'zipCode' => $request->zipCode,
                'maritalStatus' => $request->maritalStatus,
                'status' => $request->status,
                'gender' => $request->gender,
                'agent_id' => $user['id'],
                ]);
                $attachmentId  = $student['id'];
                if(Auth::guard('student')->check()){
                    $studentUniqueId = 'ST'.$request->studentId.'#S';
                    $studentUp = Student::where('id',$request->studentId)->update([
                        'student_unique_id' => $studentUniqueId,
                    ]);
                }

                if($request->image){
                    $studentId = Session::get('studentID');
                    $comment ='';
                    $file = $request->image;
                    $Hasattachment = StudentAttachment::where('student_id',$studentId)->where('type','StudentImage')->first();
                    if($Hasattachment){
                        
                        $attachmentId = $studentId;
                        $studentSaveDocument = ImageUpload::updateStudentDocumentsProfile($file,'profile','StudentImage',$studentId,$attachmentId);
                    }else{
                        $studentSaveDocument = ImageUpload::uploadStudentDocuments($file,'profile','StudentImage',$studentId,$attachmentId);
                    }
                    
                }
                $studentUnqID = Student::where('id',$request->studentId)->first();
                Session::flash('success','New Student created');
                return ['status'=>'update','studentUniqueId'=>$studentUnqID['student_unique_id']];
        }
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
   
    public function saveStudentQualification(Request $request)
    {

        // dd($request->all());
        // return $request->all();
        $rules = array(
            'qualificationGrade' => 'required',
            'qualification_from_date' => 'required',
            'qualification_to_date' => 'required',
            'qualification_total' => 'required',
        
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails())
            {
                return Response::json(array(
                    'status' => false,
                    'errors' => $validator->getMessageBag()->toArray()

                ), 400); // 400 being the HTTP code for an invalid request.
            }
        
            $checkQualification = StudentQualification::where('qualificationName',$request->qualificationGrade)->where('student_id',Session::get('studentID'))->first();
            if($checkQualification){
                $rules = array(
                    'qualificationGrade' => 'required|unique:student_qualifications,qualificationName,',
                );
                $validator = Validator::make($request->all(), $rules);
                if ($validator->fails())
                    {
                        return Response::json(array(
                            'status' => false,
                            'errors' => $validator->getMessageBag()->toArray()
        
                        ), 400); // 400 being the HTTP code for an invalid request.
                    }
            }
            $studentQ = StudentQualification::create([
            'qualificationName' => $request->qualificationGrade,
            'student_id' => Session::get('studentID'),
            'board' => $request->board,
            'subject' => $request->subject,
            'instituteName' => $request->institute,
            'country_id' => $request->qualificationCountry_id,
            'state_id' => $request->qualificationState_id,
            'city_id' => $request->qualificationCity_id,
            'from' => $request->qualification_from_date,
            'to' => $request->qualification_to_date,
            'total' => $request->qualification_total,
            ]);
            $studentQ->save();
            $qualificationGrade = QualificationGrade::where('id',$request->qualificationGrade)->first();
            // Session::put('studentID',$studentQ['id']);
            $allqualification = StudentQualification::with(['boards','student','qualification','country','state','city','totals','documents'])->where('student_id',Session::get('studentID'))->get();
            Session::flash('success','New Student created');
            return ['status'=>'true','studentQualification'=>$studentQ['id'],'nameType'=>$qualificationGrade['qualification_grade'],'allqualification'=>$allqualification];
        
    }
    public function deleteQualification($id)
    {
    
        $stdQual = StudentQualification::where('id',$id)->first();
        $qualificationGrade = QualificationGrade::where('id',$stdQual['qualificationName'])->first();
        $hasAttach = StudentAttachment::where('student_id',$stdQual['student_id'])->where('attachment_name',$qualificationGrade['qualification_grade'])->where('type','qualification')->delete();


        $stdQual = StudentQualification::where('id',$id)->delete();
        
        return ['status'=>'true'];
    }
    public function StudentRejectionStatus(Request $request)
    {
    
        Student::where('id',$request->student_id)->update(['student_status' =>$request->student_status,'reason' => $request->reason]);
        $Student = Student::where('id',$request->student_id)->first();
         Notification::create([
            'type' =>'agent',
            'link' =>route('student.show',base64_encode($Student['id'])),
            'agent_id' =>$Student['agent_id'],
            'application_id' =>'',
            'message' => 'Admit Offer team Reject application of Student '.$Student['firstName'].' '.$Student['lastName'],
            'application_status' =>'',
            'status' =>0,
            ]);
        Session::flash('success','Student rejected and reason saved');
        return back();
    }
    public function StudentShortlisting($id)
    {
    
        $Student = Student::where('id',$id)->first();
        if($Student['lock_status'] != 1){
            Student::where('id',$id)->update(['shortlisting' =>1,'IsShortlisting' =>'yes','applied_at' => Carbon\Carbon::now()->format('d-m-Y'),]);
        
            $Admins = Admin::where('country',$Student['applingForCountry'])->get();

            $adminId = [];
            foreach ($Admins as $key => $admin) {
                if($admin->roles[0]['name'] == 'shortlisting'){

                $adminId[] = $admin['id'];
                }
            }
            $shortlistingAdmin = Admin::whereIn('id',$adminId)->inRandomOrder()->first();
            Notification::create([
                'type' =>'admin',
                'link' =>route('studentfiles.show',base64_encode($Student['id'])),
                'agent_id' =>'',
                'application_id' =>'',
                'to' =>$shortlistingAdmin['id'],
                'student_id' => $id,
                'admin_role' => 'shortlisting',
                'message' =>'ShortListing : - A new student '.$Student['firstName'].' '.$Student['lastName'].' sent application for shortlisting at '.$Student['applied_at'].'.',
                'application_status' =>'',
                'status' =>0,
                ]);
            Session::flash('success','Application sent for shortlisting ,please keep a check on your notifications, we will update the selected programs on student profile');
        }else{
        Session::flash('error','Application already final submited');

        }
        return back();
    }
    public function applicationSignedDocument(Request $request){
        
        $file = $request->clgSignedDoc;
        $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
        
            $destinationPath = 'uploads/clgSignedDoc/'.$request->applicationId;
         $file->move($destinationPath, $fileName);
        $hasAttachment = ApplicationDocument::where('student_id',$request->sign_student_id)->where('college_id',$request->college_id)->where('type','clgSignedDoc')->first();    
        if($hasAttachment){
            $attachment = ApplicationDocument::where('id',$hasAttachment['id'])->update([
                'name' => $fileName,
                'path' => $destinationPath,
                'type' => 'clgSignedDoc',
                'application_status_id' => 0,
                'application_id' => $request->applicationId,
                'student_id' => $request->sign_student_id,
                'college_id' => $request->college_id,
                ]);
        }else{
            $attachment = ApplicationDocument::create([
                'name' => $fileName,
                'path' => $destinationPath,
                'type' => 'clgSignedDoc',
                'application_status_id' => 0,
                'application_id' => $request->applicationId,
                'student_id' => $request->sign_student_id,
                'college_id' => $request->college_id,
                ]);
            $attachment->save();
        }
        Session::flash('success','Application Offer Letter Uploaded');
        return 'true';


    }
    public function studentDocuments(Request $request)
    {
        // dd($request->all());
        $studentId = Session::get('studentID');
        if($request->applicationFormDocument){
            $attachmentId = '';
            $file = $request->applicationFormDocument;
            $studentSaveDocument = ImageUpload::uploadStudentDocuments($file,'form','applicationFormDocument',$studentId,$attachmentId);
        }
        if($request->otherFormDocument){
            $attachmentId = '';
            $file = $request->otherFormDocument;
            $studentSaveDocument = ImageUpload::uploadStudentDocuments($file,'form','otherFormDocument',$studentId,$attachmentId);
        }
        if($request->passport){
            if($request->has('passport')){
                $request->validate([
                    'passport' => '|mimes:pdf|max:5500',
                ]);
            }
            $attachmentId = 'passport';
            $file = $request->passport;
            $hasAttach = StudentAttachment::where('student_id',$studentId)->where('attachment_id',$attachmentId)->first();
            if($hasAttach['attachment_id']){
                $studentSaveDocument = ImageUpload::updateStudentDocuments($file,'passport','passport',$studentId,$attachmentId);
            }else{
                 $studentSaveDocument = ImageUpload::uploadStudentDocuments($file,'passport','passport',$studentId,$attachmentId);
            }
        }
         if($request->dobDoc){
            if($request->has('dobDoc')){
                $request->validate([
                    'dobDoc' => '|mimes:pdf|max:5500',
                ]);
            }
            $attachmentId = 'dobDoc';
            $file = $request->dobDoc;
            $hasAttach = StudentAttachment::where('student_id',$studentId)->where('attachment_id',$attachmentId)->first();
            if($hasAttach['attachment_id']){
                $studentSaveDocument = ImageUpload::updateStudentDocuments($file,'dobDoc','dobDoc',$studentId,$attachmentId);
            }else{
                 $studentSaveDocument = ImageUpload::uploadStudentDocuments($file,'dobDoc','dobDoc',$studentId,$attachmentId);
            }
        }
        if($request->lor){
            // if($request->has('lor')){
            //     $request->validate([
            //         'lor' => '|mimes:pdf|max:5500',
            //     ]);
            // }
            $attachmentId = 'lor';
            $file = $request->lor;
            $hasAttach = StudentAttachment::where('student_id',$studentId)->where('attachment_id',$attachmentId)->first();
            if($hasAttach['attachment_id']){
                $studentSaveDocument = ImageUpload::updateStudentDocuments($file,'lor','lor',$studentId,$attachmentId);
            }else{
                 $studentSaveDocument = ImageUpload::uploadStudentDocuments($file,'lor','lor',$studentId,$attachmentId);
            }
        }
        if($request->moi){
            if($request->has('moi')){
                $request->validate([
                    'moi' => '|mimes:pdf|max:5500',
                ]);
            }
            $attachmentId = 'moi';
            $file = $request->moi;
            $hasAttach = StudentAttachment::where('student_id',$studentId)->where('attachment_id',$attachmentId)->first();
            if($hasAttach['attachment_id']){
                $studentSaveDocument = ImageUpload::updateStudentDocuments($file,'moi','moi',$studentId,$attachmentId);
            }else{
                 $studentSaveDocument = ImageUpload::uploadStudentDocuments($file,'moi','moi',$studentId,$attachmentId);
            }
        }
        // if($request->sop){
        //     if($request->has('sop')){
        //         $request->validate([
        //             'sop' => '|mimes:pdf|max:2100',
        //         ]);
        //     }
        //     $attachmentId = 'sop';
        //     $file = $request->sop;
        //     $hasAttach = StudentAttachment::where('student_id',$studentId)->where('attachment_id',$attachmentId)->first();
        //     if($hasAttach['attachment_id']){
        //         $studentSaveDocument = ImageUpload::updateStudentDocuments($file,'sop','sop',$studentId,$attachmentId);
        //     }else{
        //          $studentSaveDocument = ImageUpload::uploadStudentDocuments($file,'sop','sop',$studentId,$attachmentId);
        //     }
        // }
        if($request->test){
            $lastKey = array_key_last($request->test);
                $request->validate([
                    'test.*' => 'mimes:pdf|max:5500',
                ]);
            foreach($request->test as $key => $value){
                if($lastKey == $key){
                    $file = $value;
                    $attachmentId = $request->testId[$key];
                    $hasAttach = StudentAttachment::where('student_id',$studentId)->where('attachment_id',$attachmentId)->where('type','test')->first();
                    if($hasAttach['attachment_id']){
                        $studentSaveDocument = ImageUpload::updateStudentDocuments($file,$key,'test',$studentId,$attachmentId);
                    }else{
                        $hasAttach = StudentAttachment::where('student_id',$studentId)->where('type','test')->delete();
                         $studentSaveDocument = ImageUpload::uploadStudentDocuments($file,$key,'test',$studentId,$attachmentId);
                    }
                }
              
            }
            
        }
        if($request->qualificationDocument){
            $lastKey = array_key_last($request->qualificationDocument);
            $request->validate([
                'qualificationDocument.*' => 'mimes:pdf|max:5500',
            ]);
            foreach($request->qualificationDocument as $key => $value){
                
                if($lastKey == $key){
                    $attachmentId = $request->qualificationDocumentId[$key];
                    $file = $value;
                    $hasAttach = StudentAttachment::where('student_id',$studentId)->where('attachment_id',$attachmentId)->where('type','qualification')->first();
                    if($hasAttach['attachment_id']){
                        $studentSaveDocument = ImageUpload::updateStudentDocuments($file,$key,'qualification',$studentId,$attachmentId);
                    }else{
                        $studentSaveDocument = ImageUpload::uploadStudentDocuments($file,$key,'qualification',$studentId,$attachmentId);
                    }
                }
            }
        }
     
        if($request->work){
            $lastKey = array_key_last($request->work);
            $request->validate([
                'work.*' => 'mimes:pdf|max:5500',
            ]);
            foreach($request->work as $key => $value){
                if($lastKey == $key){
                    $file = $value;
                    $attachmentId = $request->workId[$key];
                    // dd($request->workId[$key]);
                    $hasAttach = StudentAttachment::where('student_id',$studentId)->where('attachment_id',$attachmentId)->where('type','work')->first();
                    // dd($hasAttach);
                    if($hasAttach['attachment_id']){
                        $studentSaveDocument = ImageUpload::updateStudentDocuments($file,$key,'work',$studentId,$attachmentId);
                    }else{
                       $studentSaveDocument = ImageUpload::uploadStudentDocuments($file,$key,'work',$studentId,$attachmentId);
                   }
                }
            }
            
        }
        if($request->Gap){
            
            $lastKey = array_key_last($request->Gap);
            $request->validate([
                'Gap.*' => 'mimes:pdf|max:5500',
                ]);
            foreach($request->Gap as $key => $value){
                $attachmentId = $request->GapId[$key];
                if($lastKey == $key){
                    $file = $value;
                    $hasAttach = StudentAttachment::where('student_id',$studentId)->where('attachment_id',$attachmentId)->where('type','gap')->first();
                    if($hasAttach['attachment_id']){
                        $studentSaveDocument = ImageUpload::updateStudentDocuments($file,$key,'gap',$studentId,$attachmentId);
                    }else{
                    $studentSaveDocument = ImageUpload::uploadStudentDocuments($file,$key,'gap',$studentId,$attachmentId);
                    }
                }
            }
        }
        if($request->RecieptDocument){
            $comment = $request->RecieptDocumentComment;
            $file = $request->RecieptDocument;
            $studentSaveDocument = ImageUpload::uploadStudentDocuments($file,'finance','RecieptDocument',$studentId,$comment);
        }
        if($request->FinanceMatrixDocument){
            $comment = $request->FinanceMatrixDocumentComment;
            $file = $request->FinanceMatrixDocument;
            $studentSaveDocument = ImageUpload::uploadStudentDocuments($file,'finance','FinanceMatrixDocument',$studentId,$comment);
        }
        if($request->StudentFinanceDocument){
            $comment = $request->StudentFinanceDocumentComment;
            $file = $request->StudentFinanceDocument;
            $studentSaveDocument = ImageUpload::uploadStudentDocuments($file,'finance','StudentFinanceDocument',$studentId,$comment);
        }
            Session::flash('success','New Student docments created');
            return back();
        }


    public function saveStudentQualificationGap(Request $request)
    {

        // dd($request->all());
        // return $request->all();
        $rules = array(
            'gapFromDate' => 'required',
            'gapToDate' => 'required',
            'gapOrganization' => 'required',
        
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails())
            {
                return Response::json(array(
                    'status' => false,
                    'errors' => $validator->getMessageBag()->toArray()

                ), 400); // 400 being the HTTP code for an invalid request.
            }
            $studentG = StudentQualificationGap::create([
            'fromDate' => $request->gapFromDate,
            'toDate' => $request->gapToDate,
            'organization' => $request->gapOrganization,
            'student_id' => Session::get('studentID'),
            ]);
            $studentG->save();
           
            // Session::put('studentID',$studentG['id']);
            
            Session::flash('success','New Student created');
            return ['status'=>'true','studentQualificationGap'=>$studentG['id'],'gapOrganization'=>$request->gapOrganization];
        
    }

    public function deleteQualificationGap($id)
    {
    
        StudentQualificationGap::where('id',$id)->delete();
        return ['status'=>'true'];
    }
    public function saveStudentQualificationTests(Request $request)
    {

        $hasTest = StudentEnglishTest::where('student_id',Session::get('studentID'))->first();
        if($hasTest){
            
            return Response::json(array(
                'status' => false,
                'errors' => ['English test already added'],
                
            ), 400); 
            
        }else{
        if($request->testName == '3'){
            $rules = array(
                'testName' => 'required',
                'overall' => 'required',
                
            );
            $validator = Validator::make($request->all(), $rules);
        }else{
            $rules = array(
                'testName' => 'required',
                
                'overall' => 'required',
            
            );

            $validator = Validator::make($request->all(), $rules);
        }
        if ($validator->fails())
            {
                return Response::json(array(
                    'status' => false,
                    'errors' => $validator->getMessageBag()->toArray()

                ), 400); // 400 being the HTTP code for an invalid request.
            }


            $checkTest = StudentEnglishTest::where('testName',$request->testName)->where('student_id',Session::get('studentID'))->first();
            if($checkTest){
                $rules = array(
                    'testName' => 'required|unique:student_english_tests,testName,',
                );
                $validator = Validator::make($request->all(), $rules);
                if ($validator->fails())
                    {
                        return Response::json(array(
                            'status' => false,
                            'errors' => $validator->getMessageBag()->toArray()
        
                        ), 400); // 400 being the HTTP code for an invalid request.
                    }
            }
            $studentTest = StudentEnglishTest::create([
            'testName' => $request->testName,
            'dateOfTest' => $request->dateOfTest,
            'reading' => $request->reading,
            'writing' => $request->writing,
            'speaking' => $request->speaking,
            'listening' => $request->listening,
            'overAll' => $request->overall,
            'totalScore' => $request->totalIletsScore,
            'student_id' => Session::get('studentID'),
            ]);
            $studentTest->save();
           
            // Session::put('studentID',$studentG['id']);
            $getEnglishTest = EnglishTest::where('id',$request->testName)->first();
            $studentEnglishTests = StudentEnglishTest::with(['student','englishTests','totalScores','documents'])->where('student_id',Session::get('studentID'))->get();
            Session::flash('success','New Student created');
            return ['status'=>'true','studentTest'=> $studentTest->id,'name'=>$getEnglishTest['name'],'studentEnglishTests'=>$studentEnglishTests];
        
         }
    }

    public function deleteQualificationTest($id)
    {
        $test = StudentEnglishTest::where('id',$id)->first();
        $studentTestAttachment = StudentAttachment::where('student_id',$test['student_id'])->where('type','test')->delete();
        StudentEnglishTest::where('id',$id)->delete();
        return ['status'=>'true'];
    }
    public function updateSkypeID(Request $request)
    {
        Student::where('id',$request->studentId)->update([
            'skypeId'=>$request->skypeId,
        ]);
        Session::flash('success','Skype Id Updated');
        return back();
    }
    public function saveStudentWorkExperiance(Request $request)
    {

        // dd($request->all());
        // return $request->all();
        $rules = array(
            'organization' => 'required',
            'designation' => 'required',
            'work_from_date' => 'required',
            'work_to_date' => 'required',
        
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails())
            {
                return Response::json(array(
                    'status' => false,
                    'errors' => $validator->getMessageBag()->toArray()

                ), 400); // 400 being the HTTP code for an invalid request.
            }
            $studentTest = StudentWorkExperiance::create([
            'organization' => $request->organization,
            'designation' => $request->designation,
            'fromDate' => $request->work_from_date,
            'toDate' => $request->work_to_date,
            'student_id' => Session::get('studentID'),
            ]);
            $studentTest->save();
            // Session::put('studentID',$studentG['id']);
            $allStudentExp = StudentWorkExperiance::where('student_id',Session::get('studentID'))->get();
            Session::flash('success','New Student created');
            return ['status'=>'true','studentWork'=>$studentTest->id,'allStudentExp'=>$allStudentExp,'name'=>$request->organization];
        
    }

    public function deleteQualificationWork($id)
    {
        StudentWorkExperiance::where('id',$id)->delete();
        return ['status'=>'true'];
    }
    public function saveStudentQuestions(Request $request)
    {
        StudentQuestionAnswers::where('student_id',Session::get('studentID'))->delete();
        foreach ($request->questionId as $key => $value) {
            
            $studentTest = StudentQuestionAnswers::create([
                'question' => $value,
                'answer' => $request->question[$key],
                'detail' => $request->questionText[$key],
                'student_id' => Session::get('studentID'),
                ]);
            $studentTest->save();
            
        }
           
        // Session::put('studentID',$studentG['id']);
        // dd($request->$questionId);
        Session::flash('success','New Student created');
        return ['status'=>'true'];
        
    }
    public function studentCheck(Request $request)
    {
        
        $hStd = Session::get('studentID');
        if(!$hStd){
            Session::put('studentID',$request->studentId);

        }
        $studentOnChange = Student::where('id',$request->studentId)->first();
        if(!array_key_exists('apply_country_id',$request->all())){
            $request['apply_country_id'] = $studentOnChange['applingForCountry'];
        }
        if(!array_key_exists('apply_qualification_level',$request->all())){
            $request['apply_qualification_level'] = $studentOnChange['applingForLevel'];
        }
        if(!array_key_exists('status',$request->all())){
            $request['status'] = $studentOnChange['status'];
        }
        
        $rules = array(
            'title' => 'required',
            // 'address' => 'required',
            'apply_country_id' => 'required',
            'apply_qualification_level' => 'required',
            // 'birth_country_id' => 'required',
            'dateOfBirth' => 'required',
            'email' => 'email|required',
            // 'firstLanguage' => 'required',
            'firstName' => 'required',
            'lastName' => 'required',
            // 'mailing_city_id' => 'required',
            // 'mailing_country_id' => 'required',
            // 'mailing_state_id' => 'required',
            'mobile' => 'required|digits:10',
            // 'nationality_country_id' => 'required',
            // 'passportExpiryDate' => 'required',
            // 'passportIssueDate' => 'required',
            // 'passportNo' => 'required',
            // 'zipCode' => 'required',
            'maritalStatus' => 'required',
            'status' => 'required',
            'gender' => 'required',
            
        );
        $validator = Validator::make($request->all(), $rules);
        if ($validator->fails())
        {
            return Response::json(array(
                'status' => false,
                'errors' => $validator->getMessageBag()->toArray()

            ), 400); // 400 being the HTTP code for an invalid request.
        }
        if($request['apply_country_id'] == '230'){

            $rules = array(
                
                'englishScores' => 'required',
            
            );
        $validator = Validator::make($request->all(), $rules);
            if ($validator->fails())
            {
                return Response::json(array(
                    'status' => false,
                    'errors' => $validator->getMessageBag()->toArray()

                ), 400); // 400 being the HTTP code for an invalid request.
            }
        }
        Session::put('openNext','openNextSession');
        // dd($request->$questionId);
        Session::flash('success','New Student created');
        return ['status'=>'true'];
    }
    public function ApplyFor(Request $request)
    {
        $studentPassport = StudentAttachment::where('student_id',$request->studentId)->where('type','passport')->first();
        if(!$studentPassport){
            Session::flash('error','Provide Student Passport Document');
            return back();
        }
        $studentOnChange = Student::where('id',$request->studentId)->first();
        if($studentOnChange->applingForCountry == '38'){
            $studentEnglishTest = StudentEnglishTest::where('student_id',$request->studentId)->get();
            if($studentEnglishTest->count() == 0){
                Session::flash('error','Provide Student English Test Details');
                return back();
            }

             $studentIeltste = StudentAttachment::where('student_id',$request->studentId)->where('type','test')->first();
            if(!$studentIeltste){
                Session::flash('error','Provide Student English Test Document');
                return back();
            }


        }
        if($studentOnChange->applingForCountry == '230'){
            $studentLor = StudentAttachment::where('student_id',$request->studentId)->where('type','lor')->first();
            // if(!$studentLor){
            //     Session::flash('error','Provide Student LOR Document');
            //     return back();
            // }
            // $studentMoi = StudentAttachment::where('student_id',$request->studentId)->where('type','moi')->first();
            // if(!$studentMoi){
            //     Session::flash('error','Provide Student MOI Document');
            //     return back();
            // }
            // $studentSop = StudentAttachment::where('student_id',$request->studentId)->where('type','sop')->first();
            // if(!$studentSop){
            //     Session::flash('error','Provide Student SOP Document');
            //     return back();
            // }
        }
        
        $studentQualifications = StudentQualification::where('student_id',$request->studentId)->get();
        $studentQualificationsArray = StudentQualification::where('student_id',$request->studentId)->pluck('qualificationName')->toArray();

        $studentQualificationAttachment = StudentAttachment::where('student_id',$request->studentId)->where('type','qualification')->get();
                                                               
        $studentQualificationAttachmentArray = StudentAttachment::where('student_id',$request->studentId)->where('type','qualification')->pluck('attachment_name')->toArray();
        if($studentQualifications->count() == 0){
            Session::flash('error','Provide Matric and Senior Secondary qualification documents according to Appling Level');
            return back();
        }
        if($studentOnChange['applingForLevel'] == '1'){
            if($studentQualifications->count() >= 2){
                if(!in_array(1, $studentQualificationsArray)){

                    Session::flash('error','Provide Matric qualification detail according to Appling Level');
                    return back();
                }
                if(!in_array(2, $studentQualificationsArray)){

                    Session::flash('error','Provide Senior Secondar qualification detail according to Appling Level');
                    return back();
                }
            }

            if($studentQualifications->count() < 2){
                
                Session::flash('error','Provide Matric and Senior Secondary qualification according to Appling Level');
                return back();
                
            }

             if($studentQualificationAttachment->count() >= 2){
                if(!in_array('Grade10', $studentQualificationAttachmentArray)){
                    Session::flash('error','Provide Matric qualification documents according to Appling Level');
                    return back();
                }
                if(!in_array('Grade12', $studentQualificationAttachmentArray)){
                    Session::flash('error','Provide Senior Secondary qualification documents according to Appling Level');
                    return back();
                }
            }
            if($studentQualificationAttachment->count() < 2){
              
                Session::flash('error','Provide Matric and Senior Secondary qualification documents according to Appling Level');
                    return back();
            }
        }
        if($studentOnChange['applingForLevel'] == '2'){
             if($studentQualifications->count() >= 3){
                if(!in_array(1, $studentQualificationsArray)){

                    Session::flash('error','Provide Matric qualification detail according to Appling Level');
                    return back();
                }
                if(!in_array(2, $studentQualificationsArray)){

                    Session::flash('error','Provide Senior Secondar qualification detail according to Appling Level');
                    return back();
                }
            }
            if($studentQualifications->count() < 3){
               
                    Session::flash('error','Provide Matric and Senior Secondary qualification according to Appling Level');
                    return back();
                
            }
             if($studentQualificationAttachment->count() >= 3){

                if(!in_array('Grade10', $studentQualificationAttachmentArray)){
                    Session::flash('error','Provide Matric qualification documents according to Appling Level');
                    return back();
                }
                if(!in_array('Grade12', $studentQualificationAttachmentArray)){
                    Session::flash('error','Provide Senior Secondary qualification documents according to Appling Level');
                    return back();
                }
                
            }
            if($studentQualificationAttachment->count() < 3){
               
                Session::flash('error','Provide Matric and Senior Secondary qualification documents according to Appling Level');
                return back();
            }
        }else{
            if($studentQualifications->count() < 2){
                Session::flash('error','Provide Matric and Senior Secondary qualification according to Appling Level');
                return back();
            }
            if($studentQualificationAttachment->count() < 2){
                Session::flash('error','Provide Matric and Senior Secondary qualification documents according to Appling Level');
                return back();
            }
        }

        $studentEnglishTest = StudentEnglishTest::where('student_id',$request->studentId)->get();
        $studentTestAttachment = StudentAttachment::where('student_id',$request->studentId)->where('type','test')->get();
    
        if($studentEnglishTest->count() > 0){
            // dd($studentTestAttachment);
            if($studentTestAttachment->count() != $studentEnglishTest->count()){
                Session::flash('error','Add English Test Documents');
                return back();
            }
        }
     
        $studentQuestionAnswers = StudentQuestionAnswers::where('student_id',$request->studentId)->get();
        if(!$studentQuestionAnswers){
            Session::flash('error','Question are required');
            return back();
        }
        Session::put('Fcategory',$studentOnChange['category']);
        Session::put('FstudentId',$studentOnChange['id']);
        Session::put('student',$studentOnChange['id']);
        Session::put('FcountryId',$studentOnChange['applingForCountry']);
        Session::put('FstudentName',$studentOnChange['firstName']);
        Session::put('FapplingForLevel',$studentOnChange['applingForLevel']);
        

        $student = Student::with(['studentImage','appliedStudentFiles'])->where('id',$studentOnChange['id'])->first();
        Session::put('student',$student);
        
        return redirect()->route('search.index',compact('student'));
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     
     */
     public function changeCourse($id,$course_id)
    {
        $student = Student::with(['studentImage','appliedStudentFiles'])->where('id',$id)->first();
        Session::put('Fcategory',$student['category']);
        Session::put('FstudentId',$student['id']);
        Session::put('student',$student['id']);
        Session::put('FcountryId',$student['applingForCountry']);
        Session::put('FstudentName',$student['firstName']);
        Session::put('FapplingForLevel',$student['applingForLevel']);
        

        Session::put('isChangeCourse','yes');
        Session::put('isUpdate','yes');
        Session::put('changeCourse_id',$course_id);
        Session::put('studentID',$student['id']);
        Session::put('student',$student);
        return redirect()->route('search.index',compact('student'));
    }
        
    public function show($id)
    {
        $id = base64_decode($id);
        
        $student = Student::with(['studentImage','studentDocument','GraduationDocument','passport','country','qualificationLevel'])->where('id',$id)->first();
      
        $studentQualifications = StudentQualification::with(['student','qualification','country','state','city','totals','documents','qualificationDocuments','boards'])->where('student_id',$id)->get();
        $studentEnglishTests = StudentEnglishTest::with(['student','englishTests','totalScores','documents','englishTestDocuments'])->where('student_id',$id)->get();
        $studentWorkExperiances = StudentWorkExperiance::with('documents')->where('student_id',$id)->get();
        $studentQualificationGaps = StudentQualificationGap::with(['documents','gapDocument'])->where('student_id',$id)->get();
        $studentCourseApplyFors= AppliedStudentFile::with(['pendencies','course'=>function($q){
            $q->with(['college'=>function($uni){
                $uni->with('university')->get();
            }]);
        },'student','country','applicationStatus'])->where('student_id',$id)->get();
        $studentQuestionAnswers = StudentQuestionAnswers::with(['questions'=>function($query){
            $query->with(['question'])->get();
        }])->where('student_id',$id)->get();
        $pendancyAttachments = PendancyAttachment::with('qualification','applicationCourse')->where('student_id',$id)->where('application_id',null)->where('type','!=','other')->where('type','!=','otherAdminDoc')->get();
        $studentLor = StudentAttachment::where('student_id',$id)->where('type','lor')->first();
        $studentMoi = StudentAttachment::where('student_id',$id)->where('type','moi')->first();
        $studentSop = StudentAttachment::where('student_id',$id)->where('type','sop')->first();
        $otherAttachments = PendancyAttachment::with('applicationCourse')->where('student_id',$id)->where('application_id',null)->where('type','other')->get();
        $otherAdminDocAttachments = PendancyAttachment::with('applicationCourse')->where('student_id',$id)->where('application_id',null)->where('type','otherAdminDoc')->get();
        $applicationDocuments = ApplicationDocument::where('student_id',$id)->where('type','offerletter')->get();
        $applicationclgSignedDocDocuments = ApplicationDocument::where('student_id',$id)->where('type','clgSignedDoc')->pluck('college_id')->toArray();
        return view('agent.student.viewStudent',compact('studentSop','studentMoi','studentLor','student','studentQualifications','studentEnglishTests','studentWorkExperiances','studentQualificationGaps','studentCourseApplyFors','studentQuestionAnswers','pendancyAttachments','otherAttachments','applicationclgSignedDocDocuments','applicationDocuments','otherAdminDocAttachments'));
    }
    public function applicationView($id)
    {
        $id = base64_decode($id);
        // dd($id);
        $studentCourseApplyFors = AppliedStudentFile::with(['course','sopPendency'])->where('id',$id)->first();
        $student = Student::with(['studentImage','studentDocument','GraduationDocument','passport','country','qualificationLevel'])->where('id',(int)$studentCourseApplyFors['student_id'])->first();
        $applicationStatus = ApplicationStatus::get();
        $pendancyAttachments = PendancyAttachment::with('qualification','applicationCourse')->where('application_id',$id)->where('type','!=','other')->where('type','!=','sopDocument')->where('type','!=','otherAdminDoc')->get();
        
        $otherAttachments = PendancyAttachment::with('applicationCourse')->where('application_id',$id)->where('type','other')->where('type','!=','sopDocument')->get();
        $otherAdminDocAttachments = PendancyAttachment::with('applicationCourse')->where('application_id',$id)->where('type','otherAdminDoc')->where('type','!=','sopDocument')->get();

        $applicationDocuments = ApplicationDocument::where('application_id',$id)->where('type','offerletter')->get();
        $applicationLOAOfferDocument = ApplicationDocument::where('application_id',$id)->where('type','loaOfferLetter')->first();
        $casDocument = ApplicationDocument::where('application_id',$id)->where('type','casDoc')->first();
        $visaDocument = ApplicationDocument::where('application_id',$id)->where('type','visa')->first();
        $applicationFee = ApplicationDocument::with('applicationFee')->where('application_id',$id)->where('type','tutionFee')->first();
        $applicationCASDocument = ApplicationDocument::where('application_id',$id)->where('type','clearCasDocument')->first();
        $applicationStatusTimelines = ApplicationStatusTimeline::with(['status','application'])->where('application_id',$id)->get();
        $sopDoc = Sop_pendency::where('application_id',$id)->first();
        return view('agent.student.viewStudentApplication',compact('sopDoc','applicationStatusTimelines','applicationCASDocument','visaDocument','casDocument','applicationFee','studentCourseApplyFors','applicationStatus','student','pendancyAttachments','otherAttachments','applicationDocuments','applicationLOAOfferDocument','otherAdminDocAttachments'));
    }
    public function ViewApplicationpendency($id)
    {
        $id = base64_decode($id);
        // dd($id);
        
        $studentCourseApplyFors = AppliedStudentFile::with(['course'])->where('id',$id)->first();
        $student = Student::with(['studentImage','studentDocument','GraduationDocument','passport','country','qualificationLevel'])->where('id',(int)$studentCourseApplyFors['student_id'])->first();
        $pendancyAttachments = PendancyAttachment::with('qualification','applicationCourse')->where('application_id',$id)->where('type','!=','other')->where('type','!=','otherAdminDoc')->get();
        $applicationStatus = ApplicationStatus::get();

        $otherAttachments = PendancyAttachment::with('applicationCourse')->where('application_id',$id)->where('type','other')->get();
        $otherAdminDocAttachments = PendancyAttachment::with('applicationCourse')->where('application_id',$id)->where('type','otherAdminDoc')->get();
        $applicationDocuments = ApplicationDocument::where('application_id',$id)->where('type','offerletter')->get();
        $sopDoc = Sop_pendency::where('application_id',$id)->first();
        return view('agent.student.viewApplicationPendencies',compact('sopDoc','studentCourseApplyFors','applicationStatus','student','pendancyAttachments','otherAttachments','applicationDocuments','otherAdminDocAttachments'));
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
       
        Session::put('studentID',$id);
        $id = Session::get('studentID');
        $englishScores = EnglishScore::all();
        $iletsScores = IletsScore::where('english_test','IELTS')->get();
        $mathScores = MathScore::all();
        $countries = Country::all();
        $qualificationPercentages = StudentQualificationTotal::where('type','percentage')->get();
        $qualificationDivisions = StudentQualificationTotal::where('type','division')->get();
        $qualificationGpas = StudentQualificationTotal::where('type','gpa')->get();
        $data = Student::with(['studentImage','passport','lor','moi','sop'])->where('id',$id)->first();
        if($data['lock_status'] == 1){
            return back();
        }
        if($data['applingForCountry']){

        $qualifications = Qualification::where('country',$data['applingForCountry'])->orWhere('country',NULL)->get();
        $englishTests = EnglishTest::where('country_id',$data['applingForCountry'])->get();
        }else{
        $qualifications = [];
        $englishTests = [];

        }
        $states = State::where('country_id',$data['country_id'])->get();
        $cities = City::where('state_id',$data['state_id'])->get();
        if($data['applingForCountry'] && $data['applingForLevel'] && $data['status'] && $data['title'] && $data['dateOfBirth'] && $data['email'] && $data['firstName'] && $data['lastName'] && $data['mobileNo'] && $data['maritalStatus'] && $data['gender']){
            if ($data['applingForCountry'] == 230) {
                if ($data['englishScore']) {
                
                     Session::put('openNext','openNextSession');
                }
            }else{
                     Session::put('openNext','openNextSession');

            }
        }
        $isEdit = 'yes';
        Session::put('edit','yes');
        $questions = CountryQuestion::with('question')->where('country_id',$data['applingForCountry'])->get();
        
        $studentQualifications = StudentQualification::with(['student','qualification','country','state','city','totals','documents','boards'])->where('student_id',$id)->get();
        $studentEnglishTests = StudentEnglishTest::with(['student','englishTests','totalScores','documents'])->where('student_id',$id)->get();
        $studentWorkExperiances = StudentWorkExperiance::with('documents')->where('student_id',$id)->get();
        $studentQualificationGaps = StudentQualificationGap::with('documents')->where('student_id',$id)->get();
        $subjects = Subject::all();
        $studentQuestionAnswers = StudentQuestionAnswers::with(['questions'=>function($query){
            $query->with(['question'])->get();
        }])->where('student_id',$id)->get();
        $agentAllowCountry = AllowCountryAgent::where('agent_id',Auth::guard('agent')->user()->id)->pluck('country_id')->toArray();
        $PreviousQualifications = PreviousQualification::all();
        $boards = QualificationBoard::orderBy('name')->get();
        return view('agent.student.addStudent',compact('boards','mathScores','englishScores','qualificationGpas','qualificationDivisions','agentAllowCountry','qualificationPercentages','qualifications','data','countries','englishTests','iletsScores','isEdit','studentQualifications','studentEnglishTests','studentWorkExperiances','studentQualificationGaps','states','cities','questions','studentQuestionAnswers','subjects','PreviousQualifications'));
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

   
    public function destroy($id)
    {
        Student::where('id',$id)->delete();
        Session::flash('success','Student deleted');
        return back();
    }
    // ajax responce
    public function completeApplication($id)
    {
        $Student = Student::where('id',$id)->first();
        // if($student->pendeciesStudentFiles->count() > 0){

        //     Session::flash('success','Please upload application pendencies before final submit.');
        //     return back();
        // }


        $today = Carbon\Carbon::now()->format('d-m-Y');
        if($Student['applingForCountry'] == '38'){
             $applicationsal = AppliedStudentFile::with(['college'=>function($sq){
                $sq->with('collegeSignedDocuments')->get();
             } ,'course'])->where('student_id',$id)->get();

             $applicationclgSignedDocDocuments = ApplicationDocument::where('student_id',$id)->where('type','clgSignedDoc')->pluck('college_id')->toArray();
             $paymentStudentidArray = Payment::where('student_id',$id)->pluck('student_id')->toArray();

             $stdSignedDoc = [];
             $reqCCardDetails = [];
             $amount = 0;
             foreach($applicationsal as $applicational){
                if($Student['applicationFee_status'] != 'paid'){
                  if($applicational->college['isDocumentRequired'] == 'yes'){
                    if(!in_array($applicational->college['id'], $applicationclgSignedDocDocuments)){
                    $stdSignedDoc[] = $applicational;

                    }
                  }
                  if($applicational->college['isCardRequired'] == 'yes'){
                    if(!in_array($id, $paymentStudentidArray)){
                        if(!in_array($applicational->college['id'], $reqCCardDetails)){
                            $reqCCardDetails[] = $applicational->college['id'];
                            $amount += (int)$applicational->college['application_fee'];
                          }
                      }
                  }
                }  
             }
             if(sizeof($stdSignedDoc) > 0 ){

                return ['true' => 'false','stdSignedDoc'=>$stdSignedDoc,'reqCCardDetails'=>$reqCCardDetails,'countryId' => '38'];
             }
             if(sizeof($reqCCardDetails) > 0){
                Session::put('paymentstudent_id',$id);
                Session::put('amount',$amount);
                
                return ['true' => 'false','stdSignedDoc'=>$stdSignedDoc,'reqCCardDetails'=>$reqCCardDetails,'countryId' => '38','amount'=>$amount,'student_id'=>$id];
             }

        }
        Student::where('id',$id)->update([
            'lock_status'=>1,
            'shortlisting'=>0,
            'applied_at'=>$today,
        ]);
           $applications = AppliedStudentFile::where('student_id',$id)->get();
        if($Student['applingForCountry'] == '230'){  
            
           foreach($applications as $application){
                 PendancyAttachment::create([
                   'application_id' => $application['id'],
                   'student_id' => $id,
                   'type' =>'sopDocument',
                   ]);
               Sop_pendency::create([
                   'application_id' => $application['id'],
                   'student_id' => $id,
                   ]);
                Notification::create([
                    'type' =>'agent',
                    'link' =>route('student.application.View',base64_encode($application['id'])),
                    'agent_id' =>$application['agent_id'],
                    'application_id' =>$application['id'],
                    'student_id' => $id,
                    'message' =>'New SOP pendency created by AdmitOffer team on '.$application->course['name'].' of '.$application->course->college['name'].' university for '.$Student['firstName'].' '.$Student['lastName'].' at '.$Student['applied_at'].'' ,
                    'application_status' =>'',
                    'status' =>0,
                    ]);

            }
                $user =Auth::guard('agent')->user()->toArray();
                $data['agent'] = $user; 
                $data['student'] = $Student;
                $data['link'] = route('student.application.View',base64_encode($application['id']));
                if($applications->count() > 0){
                    $mail =  Mail::send('emails.sopPendencyCreated',['data' => $data], function($message) use ($user,$Student) {
                        $message->to($user['email']);
                        $message->subject('New SOP pendency created by AdmitOffer team on '.$Student['firstName'].' '.$Student['lastName'].' application');
                        $message->from('himanshu@admitoffer.com','ADMITOFFER');
                    });
                }
        }

        $user =Auth::guard('agent')->user()->toArray();
        $data['agent'] = $user; 
        $data['student'] = $Student;

        $mails =  Mail::send('emails.newApplicationToAdmin',['data' => $data], function($message) use ($data) {
            $message->to('uk@admitoffer.com');
            $message->subject('New Applicatons sent by '.$data['agent']['name']);
           
        });
        $mail =  Mail::send('emails.newApplication',['data' => $data], function($message) use ($data) {
            $message->to($data['agent']['email']);
            $message->subject('New Applicatons sent ');
            
        });
         $applicationsToPreProcess = AppliedStudentFile::where('student_id',$id)->pluck('preProcessBy_id');
         $uniqueApplToPros = [];
         
        foreach($applicationsToPreProcess as $applicationsToPreProc){
            if(!in_array($applicationsToPreProc,$uniqueApplToPros)){
            $uniqueApplToPros[] =  $applicationsToPreProc;
            Notification::create([
                'type' =>'admin',
                'link' =>route('studentfiles.show',base64_encode($Student['id'])),
                'agent_id' =>'',
                'from' =>$user['id'],
                'to' =>$applicationsToPreProc,
                'application_id' =>'',
                'student_id' => $id,
                'admin_role' => 'preprocess',
                'message' =>'A new student '.$Student['firstName'].' '.$Student['lastName'].' registered with '.$applications->count().' applications by agent '.$user['name'].'  Company name '.$user['company_name']. ' at '.$Student['applied_at'].'.',
                'application_status' =>'',
                'status' =>0,
                ]);
            }
        }
        return ['true'=>'true','countryId' => (String)$Student['applingForCountry']];
    }
    public function getQualificationGrades($id)
    {
        $qualificationGrades = QualificationLevelGrade::with('qualification','qualificationGrade')->where('qualification_level',$id)->get();
        
        return $qualificationGrades;
    }
    public function getEnglishTest($id)
    {
        $getEnglishTest = EnglishTest::where('country_id',$id)->get();
        $qualification = Qualification::where('country',$id)->orWhere('country',NULL)->get();
        $iletsScores = IletsScore::where('country',$id)->get();
        
        return ['getEnglishTest' => $getEnglishTest,'qualification' => $qualification,'iletsScores' => $iletsScores];
    }
    public function testtotalScore($id,$country)
    {
        
        $testtotalScore = IletsScore::where('english_test',$id)->where('country',$country)->get();
        
        return ['testtotalScore' => $testtotalScore];
    }

    public function getQuestions($id)
    {
        $studentQuestions = CountryQuestion::with(['country','question'])->where('country_id',$id)->get();
         return $studentQuestions;
    }
}
