<?php

namespace App\Http\Controllers\Agent;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Agent\AppliedStudentFile;
Use App\Helpers\ImageUpload;
use App\Agent;
use App\Models\Attachment;
use App\Models\College;
use App\Models\University;
use App\Models\Course;
use App\Models\Loc\Country;
use App\Models\Loc\State;
use App\Models\Loc\City;
use App\Models\Agent\Student;
use App\Models\Notification;
use App\Models\ApplicationStatusTimeline;
use App\Models\ApplicationStatus;
use Validator;
use Session;
use Auth;
use Carbon;
use Response;
use Mail;

class AppliedStudentFileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $user =Auth::guard('agent')->user();
        $appliedStudentFiles = AppliedStudentFile::with(['student','course','country'])->where('agent_id',$user['id'])->get();
        
        return view('agent.appliedStudentFiles.list',compact('appliedStudentFiles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user =Auth::guard('agent')->user();
        $countries = Country::all();
        $students = Student::where('agent_id',$user['id'])->get();
        return view('agent.appliedStudentFiles.addNewFile',compact('countries','students'));
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
            'student' => 'required',
            'country_id' => 'required',
            ]
        );
        $student = Student::with('studentImage')->where('id',$request->student)->first();
        Session::put('FstudentName',$student['name']);
        Session::put('FstudentId',$request->student);
        Session::put('FcountryId',$request->country_id);
        Session::put('student',$student);

        Session::forget('document');
        Session::forget('studentID');
        Session::forget('hasFinanceDocument');
        // $applyStudent = AppliedStudentFile::create([
        //     'title' => $request->title,
        //     'description' => $request->description,
        //     'student_id' => $request->student,
        //     'country_id' => $request->country_id,
        //     'qualification' => $request->qualification,
        //     'college_id' => $request->college_id,
        //     'subject_id' => $request->subject_id,
        //     'course_id' => $request->course_id,
            
        //     ]);
        // Session::flash('success','New File Request Submitted');
        return redirect()->route('search.index',compact('student'));
        // return back()->withInput($request->all());
    }
    public function AppliedFor($studentId,$countryId,$courseId,$text)
    {
        
        $mytime = Carbon\Carbon::now();
        $currentDate = $mytime->toDateTimeString();
        $student = Student::where('id',$studentId)->first();
        $file_status = ApplicationStatus::where('country',$countryId)->first();
        if(auth('admin')->user()){

             $user = Agent::where('id',$student['agent_id'])->first();
        }else{

             $user =Auth::guard('agent')->user();
        }
        
        $AppliedStudentFile = AppliedStudentFile::where('course_id',$courseId)->where('student_id',$studentId)->first();
        $checkAppliedStudentFile = AppliedStudentFile::where('student_id',$studentId)->get();
        if($text == 'Apply'){
            $course = Course::where('id',$courseId)->first();
            $college = College::where('id',(string)$course['college_id'])->first();
            $uni = University::where('id',(string)$college['university_id'])->first();
            if($checkAppliedStudentFile->count() >= 5){
                return ['code'=>'complete','appliedCoureseArray' => $checkAppliedStudentFile];
            }
            if(!$AppliedStudentFile){
                $applyStudent = AppliedStudentFile::create([
                'student_id' => $studentId,
                'country_id' => $countryId,
                'course_id' => $courseId,
                'college_id' => $college['id'],
                'file_status' => $file_status['id'],
                'university_id' => $college['university_id'],
                'applied_at' => $currentDate,
                'preProcessBy_id' => $college['preProcessBy'],
                'agent_id' => $user['id'],
                ]);
            $checkAppliedStudentFile = AppliedStudentFile::with('course')->where('student_id',$studentId)->get();
                // Session::flash('success','New File Request Submitted');

                 $notifs = Notification::where('status','0')->where('type','admin')->pluck('message')->toArray();
        // dd($notifs);
            if($student['lock_status'] == '1'){
                if(!in_array('On applicaton of '.$student['firstName'].' '.$student['lastName'].' new  program added  by agent '.$user['name'].'.', $notifs) ){

                    Notification::create([
                        'type' =>'admin',
                        'link' =>route('studentfiles.show',base64_encode($student['id'])),
                        'agent_id' =>'',
                        'application_id' =>'',
                        'student_id' => $student['id'],
                        'admin_role' => 'preprocess',
                        'message' =>'On applicaton of '.$student['firstName'].' '.$student['lastName'].' new  program added  by agent '.$user['name'].'.',
                        'application_status' =>'',
                        'status' =>0,
                        ]);

                }

            }
                  
                return  ['code'=> true,'appliedCoureseArray' => $checkAppliedStudentFile];
            }else{
                return  ['code'=> false];
            }
        }elseif($text == 'Update'){
            $student = Student::where('id',$studentId)->first();
            $course = Course::where('id',$courseId)->first();

            $changeCourseID = Session::get('changeCourse_id');
            
            $applyStudentUpdate = AppliedStudentFile::where('student_id',$studentId)->where('course_id',$changeCourseID)->update(['course_id'=>$courseId,'file_status'=>$file_status['id'],'college_id'=>$course['college_id']]);
            $application = AppliedStudentFile::where('student_id',$studentId)->where('course_id',$courseId)->first();
           
            Session::put('changeCourse_id',$courseId);
            $checkAppliedStudentFile = AppliedStudentFile::with('course')->where('course_id',$courseId)->where('student_id',$studentId)->get();

            $deleteTimeline = ApplicationStatusTimeline::where('application_id',$application['id'])->delete();
        $user =Auth::guard('agent')->user()->toArray();

        $mail =  Mail::send('emails.newApplication',$user, function($message) use ($user) {
            $message->to('uk@admitoffer.com');
            $message->subject('Applicatons program change by '.$user['name']);
            $message->from('himanshu@admitoffer.com','ADMITOFFER');
        });
        $notifs = Notification::where('status','0')->where('type','admin')->pluck('message')->toArray();
        // dd($notifs);
        if(!in_array('Applicaton of '. $student['firstName'].' '. $student['lastName'].' program changed by '.$user['name'].'.', $notifs) ){

        Notification::create([
            'type' =>'admin',
            'link' =>route('studentfiles.show',base64_encode($student['id'])),
            'agent_id' =>'',
            'application_id' =>'',
            'student_id' => $student['id'],
            'message' =>'Applicaton of '. $student['firstName'].' '. $student['lastName'].' program changed by '.$user['name'].'.',
            'application_status' =>'',
            'status' =>0,
            ]);
        }


            return  ['code'=> 'update','appliedCoureseArray'=>$checkAppliedStudentFile,'applicationId'=>$applyStudentUpdate];

        }else{
            $student = Student::where('id',$studentId)->first();
            if($student['lock_status'] == '1'){
                return ['code'=> 'false','appliedCoureseArray'=>$checkAppliedStudentFile];
            }

            $applyStudentDelete = AppliedStudentFile::where('student_id',$studentId)->where('course_id',$courseId)->delete();
            $checkAppliedStudentFile = AppliedStudentFile::with('course')->where('student_id',$studentId)->get();
            return  ['code'=> 'delete','appliedCoureseArray'=>$checkAppliedStudentFile];
        }
       
       
        // return back()->withInput($request->all());
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
        $applyStudent = AppliedStudentFile::where('id',$id)->first();
        return view('agent.appliedStudentFiles.editFile',compact('applyStudent'));
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
    
}
