<?php

namespace App\Http\Controllers\Search;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\College;
use App\Models\University;
use App\Models\Course;
use App\Models\Loc\Country;
use App\Models\Loc\State;
use App\Models\Loc\City;
use App\Models\Qualification;
use App\Models\ProgramLength;
use App\Models\ProgramTitle;
use App\Models\Subject;
use App\Models\CourseLevel;
use App\Models\IletsScore;
use App\Models\MathScore;
use App\Models\EnglishScore;
use App\Models\QualificationGrade;
use App\Models\StudentQualification;
use App\Models\Agent\AppliedStudentFile;
use App\Models\AllowCountryAgent;
use App\Models\Intake;
use App\Agent;
use App\Models\MergeIntake;
use App\Models\Agent\Student;
use App\Models\StudentEnglishTest;
use App\Models\InstituteType;
use App\Models\SchoolType;
Use App\Helpers\ImageUpload;
use App\Models\Notification;
use Mail;
use Validator;
use Session;
use Auth;

class SearchController extends Controller
{
    // public function __construct()
    // {   
    //     $admin = Auth::guard('admin')->check();
    //     $agent = Auth::guard('agent')->check();
    //     if($admin === false || $agent === false){
    //         return redirect()->route('home');
    //     }
    // }

    public function countries(){
        $agnt = Auth::guard('agent')->user();
        if($agnt){
            $agentAllowCountry = AllowCountryAgent::where('agent_id',$agnt['id'])->pluck('country_id')->toArray();
            $countries =Country::where('applyFor','1')->whereIn('id',$agentAllowCountry)->get();
        }else{

        $countries =Country::where('applyFor','1')->get();
        }
        $qualification =Qualification::all();
        $subjects =Subject::all();
        return response()->json(['countries'=>$countries,'qualification'=>$qualification,'subjects'=>$subjects]);
    }
    
    public function index(Request $request)
    {
        ini_set('memory_limit', '-1');
        $admin = Auth::guard('admin')->check();
        $agent = Auth::guard('agent')->check();
        $studentUser = Auth::guard('student')->check();

        if($admin === false && $agent === false && $studentUser === false){
        
            return redirect('/');
        }
        // Masters
        $qualifications = Qualification::all();
        $programLengths = ProgramLength::all();
        $subjects = Subject::all();
        $courseLevels = CourseLevel::all();
        $iletsScores = IletsScore::all();
        $englishScores = EnglishScore::all();
        
        $allColleges = College::with(['InstituteType','university']);
        $allCourses = Course::with(["college" => function($q){
            $q->with(['city','university'])->get();},'subjects','program_lengths','qualifications','course_levels']);
            $countries =Country::where('applyFor','1')->get();
            // POST Method
            if ($request->isMethod('post')) {
                if ($request->has('country_id')) {
                    if ($request->country_id) {
                        $cities = City::where('country_id',$request->country_id)->get();
                        $allColleges->whereIn('city_id', $cities);
                        $citiesId = [];
                        foreach($cities as $city){
                            $citiesId[] = $city['id'];
                        }
                        $getAllColleges = College::select('id')->whereIn('city_id', $citiesId)->get();
                        $collegeId = [];
                        foreach($getAllColleges as $college){
                            $collegeId[] = $college['id'];
                        }
                        $allCourses->whereIn('college_id',$collegeId);
                    }
                }
                if ($request->has('state_id')) {
                    if ($request->state_id) {
                        $cities = City::where('state_id',$request->state_id)->get();
                        $allColleges->whereIn('city_id', $cities);
                        $citiesId = [];
                        foreach($cities as $city){
                            $citiesId[] = $city['id'];
                        }
                        $getAllColleges = College::select('id')->whereIn('city_id', $citiesId)->get();
                        $collegeId = [];
                        foreach($getAllColleges as $college){
                            $collegeId[] = $college['id'];
                        }
                        $allCourses->whereIn('college_id',$collegeId);
                    }
                }
                if ($request->has('city_id')) {
                    if ($request->city_id) {
                        $allColleges->where('city_id', $request->city_id);
                        $getAllColleges = College::select('id')->where('city_id', $request->city_id)->get();
                        $collegeId = [];
                        foreach($getAllColleges as $college){
                            $collegeId[] = $college['id'];
                        }
                        $allCourses->whereIn('college_id',$collegeId);
                    }
                }
                if ($request->has('college')) {
                    if ($request->college) {
                        $allColleges->where('id', $request->college);
                        $getAllColleges = College::select('id')->where('id', $request->college)->get();
                        $collegeId = [];
                        foreach($getAllColleges as $college){
                            $collegeId[] = $college['id'];
                        }
                        $allCourses->whereIn('college_id',$collegeId);
                    }
                }
                if ($request->has('searchText')) {
                    if ($request->searchText) {
                        $allCourses->where('name','LIKE','%'.$request->searchText.'%');
                    }
                }
                if ($request->has('qualification')) {
                    if ($request->qualification) {
                        $allCourses->whereIn('qualification',$request->qualification);
                    }
                }
                if ($request->has('programLength')) {
                    if ($request->programLength) {
                        $allCourses->whereIn('program_length',$request->programLength);
                    }
                }
                if ($request->has('subject')) {
                    if ($request->subject) {
                        $allCourses->where('subject',$request->subject);
                    }
                }
                if ($request->has('courseLevel')) {
                    if ($request->courseLevel) {
                        $allCourses->whereIn('course_level',$request->courseLevel);
                    }
                }
                if ($request->has('iletsScore')) {
                    if ($request->iletsScore) {
                        $allCourses->where('ilets_score',$request->iletsScore);
                    }
                }
                if ($request->has('programStatus')) {
                    if ($request->programStatus) {
                        $allCourses->where('program_status',$request->programStatus);
                    }
                }
            }
            
            $courses = $allCourses->get();
            $colleges = $allColleges->get();
            $sid = Session::get('student');
            $student = Student::with(['studentImage','appliedStudentFiles'])->where('id',$sid['id'])->first();
        Session::put('student',$student);
        if($admin === true ){
            return view('searchCourse.indexSearchAdmin',compact('colleges','countries','courses','qualifications','programLengths','subjects','courseLevels','iletsScores','englishScores'));    
        }else{

            return view('searchCourse.index',compact('colleges','countries','courses','qualifications','programLengths','subjects','courseLevels','iletsScores','englishScores'));
        }
    }

     public function course_data(){
        $courses = Course::with(["college" => function($q){
            $q->with(['country','city','InstituteType','university','schoolType','attachment'])->get();},'subjects','getenglishScore','getmathScore','program_lengths','iletsScores','qualifications','course_levels','intakes'])->where('country',230)->where('qualification',1)->where('status','0')->orderBy('priority', 'asc')->get();
        return response()->json(['courses'=>$courses]);

     }

    public function getCourses(Request $request)
    {
      ini_set('memory_limit', '-1');
        $courses = Course::with(['intakes','course_levels','countrys'])->select('id','college_id','college_name','name','durationText','programTitle_name','isIlets','ilets_score','subject','state','qualification','isMath','mathScore','application_fee','english_score','merge_intake_id','course_level','intake','country','program_length','academicRequirement','note')->where('verify_by','!=',NULL)->where('country',$request->country_id)->where('qualification',$request->qualifications_id)->where('status','0')->orderBy('priority', 'asc')->get();
       
        $colleges = College::select('id','name','instituteType')->where('country_id',$request->country_id)->where('status','!=','1')->get();
          $coursesStates = Course::where('country',$request->country_id)->where('qualification',$request->qualifications_id)->where('status','0')->orderBy('priority', 'asc')->pluck('state');
        $states = State::whereIn('id',$coursesStates)->get();
          
            $qualifications = Qualification::all();
            $programLengths = ProgramLength::all();
            $subjects = Subject::all();
            $courseLevels = CourseLevel::all();
            $iletsScores = IletsScore::all();
            $mathScore = MathScore::all();
            $englishScores = EnglishScore::all();
            $instituteType = InstituteType::all();
            $schoolTypes = SchoolType::all();
            $intakes = MergeIntake::all();
            $sid = Session::get('studentID');
            $student = Student::with('appliedStudentFiles')->where('id',$sid)->first();
        return response()->json(['colleges'=>$colleges,'intakes'=>$intakes,'schoolTypes'=>$schoolTypes,'instituteTypes'=>$instituteType,'courses'=>$courses,'qualifications'=>$qualifications,'programLengths'=>$programLengths,'subjects'=>$subjects,'courseLevels'=>$courseLevels,'iletsScores'=>$iletsScores,'englishScores'=>$englishScores,'states'=>$states,'student'=>$student,'mathScores'=>$mathScore]);
    }
    
    
    
    
     public function getCourseDetail(Request $request)
    {
         ini_set('memory_limit', '-1');
        $courses =Course::with(["college" => function($q){
            $q->with(['country','city','InstituteType','university','schoolType','attachment'])->get();},'subjects','getenglishScore','getmathScore','program_lengths','states','iletsScores','qualifications','course_levels','intakes'])->where('id',$request->course_id)->first();
       
        
            $sid = Session::get('studentID');
            $student = Student::with('appliedStudentFiles')->where('id',$sid)->first();
        return response()->json(['courses'=>$courses,'student'=>$student]);
    }
    

    // Session check
    public function SessionStatus($prm)
    {
        if($prm == 'search'){
            $student = Session::get('FstudentId');
            $country = Session::get('FcountryId');
            $category = Session::get('Fcategory');
            $isUpdate = Session::get('isUpdate');
            if(!$isUpdate){
                $isUpdate = 'no';
            }
                $studentName = Session::get('FstudentName');
                $FapplingForLevel = Session::get('FapplingForLevel');
                if($student != null && $country != null){
                    $sid = Session::get('studentID');
                    $studentEnglishTests = StudentEnglishTest::where('student_id',$sid)->get();
                    $testCount = $studentEnglishTests->count();
                    $testIelts = '';
                    foreach($studentEnglishTests as $studentEnglishTest){
                        if($studentEnglishTest['testName']){
                            
                            $testIelts = $studentEnglishTest['totalScore'];
                        }
                    } 
                    $studentQualification = '';
                   if($testCount == 0){
                    $qualification_level = QualificationGrade::where('qualification_level',$FapplingForLevel)->where('qualification_grade','Grade12')->first();
                    $studentQualification = StudentQualification::with('totals')->where('student_id',$sid)->where('qualificationName',$qualification_level['id'])->first();
                   } 
                    $students = Student::with('appliedStudentFiles')->where('id',$sid)->first();
            $isChangeCourse = Session::get('isChangeCourse');
            if($isChangeCourse){

            $changeCourse_id = Session::get('changeCourse_id');
            $checkAppliedStudentFile = AppliedStudentFile::with('course')->where('course_id',$changeCourse_id)->where('student_id',$sid)->get();
            }else{

            $checkAppliedStudentFile = AppliedStudentFile::with('course')->where('student_id',$sid)->get();
            }
                            
                   
                     $acourse = $students->appliedStudentFiles->pluck('course_id');
                    return ['isUpdate' => $isUpdate,'acourse'=> $acourse, 'code'=> true,'studentId'=>$student,'countryId'=>$country,'studentName'=>$studentName,'FapplingForLevel'=>$FapplingForLevel,'students'=>$students,'testCount'=>$testCount,'testIelts'=>$testIelts,'category'=>$category,'studentQualification'=>$studentQualification,'appliedCoureseArray'=>$checkAppliedStudentFile];
                }else{
                    
                    return ['code'=> false];
                }
            }
        if($prm == 'remove'){
                $student = Session::forget('FstudentId');
                $country = Session::forget('FcountryId');
                $FapplingForLevel = Session::forget('FapplingForLevel');
                $studentName = Session::forget('FstudentName');
                $studentName = Session::forget('student');
                return redirect()->route('student.index');
                
            }
        }

    public function viewStudentNotify($studentId)
    {
        $student = Student::where('id',$studentId)->first();
        $user = Agent::where('id',$student['agent_id'])->first();
        Session::forget('FstudentId');
           Session::forget('FcountryId');
            Session::forget('Fcategory');
            Session::forget('student');
         
            Notification::create([
                'type' =>'agent',
                'link' =>route('student.show',base64_encode($student['id'])),
                'agent_id' =>$student['agent_id'],
                'application_id' =>'',
                'student_id' => $student['id'],
                'message' =>'Dear '.$user['name'].' - Programs shortlisted by ADMITOFFER team for '.$student['firstName'].' '.$student['lastName'].'.',
                'application_status' =>'',
                'status' =>0,
                ]);
            $data['agent'] = $user; 
            $data['student'] = $student; 
            $data['link'] = route('student.show',base64_encode($student['id'])); 
             $mail =  Mail::send('emails.shortlistedByAdmin',['data' => $data], function($message) use ($data) {
                $message->to($data['agent']['email']);
                $message->subject('Programs Shortlisted by AdmitOffer team');
                
            });

             return redirect()->route('studentfiles.show',base64_encode($studentId));
         
    }
}