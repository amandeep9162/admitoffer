<?php

namespace App\Http\Controllers\Agent;
use App\Models\Agent\AppliedStudentFile;
use App\Models\Agent\Student;
use App\Models\University;
use App\Models\PendancyAttachment;
use App\Models\Announcement;
use Khill\Lavacharts\Lavacharts;
use App\Models\Course;
use App\Models\Notification;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use App;
use Carbon;
use App\Agent;

class HomeController extends Controller
{

    protected $redirectTo = '/agent/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('agent.auth:agent');
    }

    /**
     * Show the Agent dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    
    public function index() {
        // $lava = new Lavacharts; // See note below for Laravel

        $lava = new Lavacharts; // See note below for Laravel
        // $chart = $lava->LineChart('MyStocks', $stocksTable);
        $user =Auth::guard('agent')->user();
        $files = AppliedStudentFile::with(['student'=>function($img){
            $img->with(['studentImage'])->first();
        },'course'=>function($q){
            $q->with(['college'])->first();
        },'country','applicationStatus','agent'])->where('agent_id',$user['id'])->where('file_status','>',1)->orderBy('id', 'desc')->get()->take(7);
       
        
        $applications = AppliedStudentFile::where('agent_id',$user['id'])->get();
        

        $aprlToJul = [];
        $aprlToJulOffers = [];
        $aprlToJulComission = 0;
        $aprlToJulSubComission = 0;

        $augToNov = [];
        $augToNovOffers = [];
        $augToNovComission = 0;
        $augToNovSubComission = 0;

        $decToMar = [];
        $decToMarOffers = [];
        $decToMarComission = 0;
        $decToMarSubComission = 0;


        foreach($applications as $application ){
     
            $course = Course::where('id',$application['course_id'])->first();
            // dd($course);
            if((int)$course['merge_intake_id'] == (int)'1'){
                $aprlToJul[] = Course::where('id',$application['course_id'])->first();
                
                if((int)$application['file_status'] >= (int)'3'){

                    $aprlToJulOffers[] = AppliedStudentFile::where('id',$application['id'])->first();
                    
                }
                
                $aprlToJulComission = (int)$aprlToJulSubComission + (int)$course['agent_commission'];
                
                
            }
            if((int)$course['merge_intake_id'] == (int)'2'){
                $augToNov[] = Course::where('id',$application['course_id'])->first();
                
                if((int)$application['file_status'] >= (int)'3'){

                    $augToNovOffers[] = AppliedStudentFile::where('id',$application['id'])->first();
                    
                }
                
                $augToNovComission = (int)$augToNovSubComission + (int)$course['agent_commission'];
                
                
            }
            if((int)$course['merge_intake_id'] == (int)'3'){
                $decToMar[] = Course::where('id',$application['course_id'])->first();
               
                if((int)$application['file_status'] >= (int)'3'){

                    $decToMarOffers[] = AppliedStudentFile::where('id',$application['id'])->first();
                    
                }
                
                $decToMarComission = (int)$decToMarSubComission + (int)$course['agent_commission'];
               
                
            }
          
        }

        $students = Student::where('agent_id',(string)$user['id'])->get();
        $studentPend = [];
        foreach($students as $student){
            $studentPend[] = $student['id'];
        }
        $pendancy = PendancyAttachment::with(['student','qualification'])->whereIn('student_id',$studentPend)->where('status',0)->get();
        //   chart
        // $graphUniversities = University::with(['country','college'=>function($clgs){
        //     $clgs->withCount(['applications'])->get();
        // }])->get()->take(4);

        $fileds = AppliedStudentFile::with(['college'=>function($uni){
                $uni->with(['university'])->get();
        },'country','applicationStatus','agent'])->where('agent_id',$user['id'])->select('college_id', DB::raw('count(*) as total'))
        ->groupBy('college_id')->orderBy('total', 'desc')->get()->take(7);
                
            $announcements = Announcement::all();
            $conversion = AppliedStudentFile::where('agent_id',$user['id'])->where('file_status',3)->get();
            $activeApplication = AppliedStudentFile::where('agent_id',$user['id'])->where('file_status','>',1)->where('file_status','<',10)->get();
            $totalApplication = AppliedStudentFile::where('agent_id',$user['id'])->get();
            $notifications = Notification::where('agent_id',$user['id'])->get()->take(6);

            $students = Student::where('lock_status',1)->where('agent_id',$user['id'])->get();
            $studentsIdArray = Student::where('lock_status',1)->where('agent_id',$user['id'])->pluck('id');

             $today = Carbon\Carbon::now()->format('d-m-Y');

        //submission or not applis        
                $sallfiles = AppliedStudentFile::with(['student'=>function($img){
                    $img->with(['studentImage'])->get();
                },'course'=>function($q){
                    $q->with(['college'=>function($uni){
                        $uni->with(['university'])->get();
                    }])->first();
                },'country','applicationStatus','agent'])->where('agent_id',$user['id'])->get();
                $submittedFiles = [];
                $notSubmittedFiles = [];
                $todayApplied = [];
                foreach($sallfiles as $file ){
                    if($file->student['lock_status'] == 1){
                        
                            if($file['file_status'] >= 1){
                                $submittedFiles[] = $file->student['id'];
                            }
                        
                    }else{
                        
                        if(!in_array($file['student_id'], $notSubmittedFiles)){
                            $notSubmittedFiles[] = $file->student['id'];
                        }
                    }

                     if($file->student['lock_status'] == 1){
                        if($file->student['applied_at'] == $today){
                            if(!in_array($file['student_id'], $todayApplied)){
                                $todayApplied[] = $file['student_id'];
                                
                            }
                        }
                    }


                }
                  
                 $newApplications = AppliedStudentFile::where('file_status',1)->whereIn('student_id',$studentsIdArray)->where('agent_id',$user['id'])->get();
                $activeFiles = AppliedStudentFile::where('file_status','>',1)->where('file_status','<',10)->where('agent_id',$user['id'])->get();
                $ttpaid = AppliedStudentFile::where('file_status',5)->where('agent_id',$user['id'])->get();
                 $provideCasRequest = AppliedStudentFile::where('file_status',8)->where('agent_id',$user['id'])->get();
                 $casIssued = AppliedStudentFile::where('file_status',9)->where('agent_id',$user['id'])->get();
                 $pendingApplications = AppliedStudentFile::where('file_status','>',1)->where('file_status','<',9)->where('agent_id',$user['id'])->get();
                 $applicationsUnconditioOfferUpload = AppliedStudentFile::where('file_status',4)->where('agent_id',$user['id'])->get();
                 $applicationsconditioOfferUpload = AppliedStudentFile::where('file_status',3)->where('agent_id',$user['id'])->get();
                 $processedApplications = AppliedStudentFile::where('file_status','>',9)->where('agent_id',$user['id'])->get();
                 $visaDisApproved = AppliedStudentFile::where('file_status',11)->where('agent_id',$user['id'])->get();
                  $visaApproved = AppliedStudentFile::where('file_status',10)->where('agent_id',$user['id'])->get();
                  $rejectedApplications = AppliedStudentFile::where('file_status',12)->where('agent_id',$user['id'])->get();

        return view('agent.home',compact('students','newApplications','visaDisApproved','visaApproved','processedApplications','rejectedApplications','notSubmittedFiles','submittedFiles','todayApplied','ttpaid','provideCasRequest','casIssued','pendingApplications','activeFiles','applicationsUnconditioOfferUpload','applicationsconditioOfferUpload','notifications','totalApplication','activeApplication','conversion','announcements','fileds','files','pendancy','aprlToJul', 'aprlToJulOffers', 'aprlToJulComission', 'augToNov', 'augToNovOffers', 'augToNovComission', 'decToMar', 'decToMarOffers', 'decToMarComission'));
    }
    public function getAgentGraph() {

            $topUniversity = University::select('id as y','name as label')->orderBy('id','DESC')->get()->take(5);
            // $topUniversityArray = [];
           
            // foreach ($topUniversity as $key => $value) {
            //     $aryKey = $key+1;
            //     $topUniversityArray[$aryKey]['x'] = $value['name'];
            //     $topUniversityArray[$aryKey]['y'] = 10;
            // }
           
            return $topUniversity;
    }
    public function profile() {
        $agent =Auth::guard('agent')->user();
           
            return  view('agent.profile.profile',compact('agent'));
    }

    public function createPdf($id)
    {
        
        $id = base64_decode($id);
        $pdf = App::make('dompdf.wrapper');
        $agent = Agent::where('id',$id)->first();
        
        $pdf->loadHTML('<h1 style="text-align:center;background:#e77817;color:white;">Admit Offer Contract</h1>
            <h4 ><strong>Name: </strong><span style="text-transform:uppercase;">'.$agent['name'].'</span></h4>
            <h5><strong>Email: </strong>'.$agent['email'].'</h5>
            <h5><strong>Phone: </strong>'.$agent['mobileno'].'</h5>
            <h5><strong>Country: </strong>'.$agent->country['name'].'</h5>
            <h5><strong>State: </strong>'.$agent->state['name'].'</h5>
            <h5><strong>City: </strong>'.$agent->city['name'].'</h5>
            <h5><strong>Address: </strong>'.$agent['address'].'</h5>
            <h5><strong>IP Address: </strong>'.$agent['ip_address'].'</h5>
            <h5><strong>Created at: </strong>'.$agent['created_at']->format('d/m/Y').'</h5>

            ');
        return $pdf->stream();
    }

}