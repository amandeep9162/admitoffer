<?php

namespace App\Http\Controllers;
use App\Models\University;
use App\Models\Agent\AppliedStudentFile;
use App\Models\ApplicationStatus;
use App\Models\Intake;
use Illuminate\Http\Request;
use App\Models\Agent\Student;
use App\Models\Loc\Country;
use App\Models\College;
use App\Models\Commission;
use Auth;
use DB;
use Input;
use Carbon;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function totalConversions()
    {
        $user =Auth::guard('agent')->user();
       
        $students = Student::with(['studentImage','appliedStudentFiles','country','pendeciesStudentFiles','countryAddress','grade10'=>function($g){
            $g->with(['totals'])->get();
        },'grade12'=>function($g){
            $g->with(['totals'])->get();
        }])->where('agent_id',$user['id'])->orderBy('id','desc')->get();
        return view('agent.reports.totalConversions',compact('students'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function commission()
    {
        $user =Auth::guard('agent')->user();
       
        $students = Student::with(['studentImage','appliedStudentFiles','country','pendeciesStudentFiles','countryAddress','grade10'=>function($g){
            $g->with(['totals'])->get();
        },'grade12'=>function($g){
            $g->with(['totals'])->get();
        }])->where('agent_id',$user['id'])->orderBy('id','desc')->get();
        return view('agent.reports.commission',compact('students'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function universityReport(Request $request)
    {
        $user =Auth::guard('agent')->user();
        $universities = AppliedStudentFile::with(['college'=>function($q){
            $q->with('university')->get();
        }])->where('agent_id',(int)$user['id'])->groupBy('college_id')->select('college_id', DB::raw('count(*) as total'))->get();
        if ($request->isMethod('post')) {
            $fromDate = new Carbon\Carbon($request->fromDate);
            $toDate = new Carbon\Carbon($request->toDate);
            $applications = AppliedStudentFile::with(['college'=>function($q){
                $q->with('university')->get();
            }])->where('agent_id',(int)$user['id'])->groupBy('college_id')->select('college_id', DB::raw('count(*) as total'))->whereRaw('DATE(applied_at) >= ?', [$fromDate->format('Y-m-d')])->whereRaw('DATE(applied_at) <= ?', [$toDate->format('Y-m-d')])->get();
            // dd($applications);
            $universities = $applications;
            // foreach($applications as $application){
                // if($application['created_at'] >= $request['fromDate'] || $application['created_at'] <= $request['toDate'] ){
                //     $universities[] = $application;
                // }
            // }
        }
         
        return view('agent.reports.universityReport',compact('universities'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function locationReport(Request $request)
    {
        $user =Auth::guard('agent')->user();
        $countries = Country::all();
        $locations = AppliedStudentFile::with(['college'])->where('agent_id',(int)$user['id'])->groupBy('country_id')->select('country_id', DB::raw('count(*) as total'))->get();
        if ($request->isMethod('post')) {
            $fromDate = new Carbon\Carbon($request->fromDate);
            $toDate = new Carbon\Carbon($request->toDate);
            $applications = AppliedStudentFile::with(['college'])->where('country_id',$request->location)->where('agent_id',(int)$user['id'])->groupBy('country_id')->select('country_id', DB::raw('count(*) as total'))->whereRaw('DATE(applied_at) >= ?', [$fromDate->format('Y-m-d')])->whereRaw('DATE(applied_at) <= ?', [$toDate->format('Y-m-d')])->get();
            $locations = $applications;
            
        }
        return view('agent.reports.location',compact('locations','countries'));
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function TotalReport(Request $request)
    {
        $user = Auth::guard('agent')->user();
        $countries = Country::all();
        $intakes = Intake::all();
        $Universities = University::all();
        $allApplications = AppliedStudentFile::with(['college'])->where('agent_id',(int)$user['id'])->get();
        $applications = [];
        foreach($allApplications as $application){
            $applications[] = $application;
        }
        $applicationStatus = ApplicationStatus::all();
        $total = '';
        $name = 'All Applicatons';
        if ($request->isMethod('post')) {
            
            $allApplications = AppliedStudentFile::with(['college','course'])->where('agent_id',(int)$user['id'])->get();

            if ($request->fromDate) {
                $fromDate = new Carbon\Carbon($request->fromDate);
                $toDate = new Carbon\Carbon($request->toDate);
                $allApplications = AppliedStudentFile::with(['college'])->where('agent_id',(int)$user['id'])->whereRaw('DATE(applied_at) >= ?', [$fromDate->format('Y-m-d')])->whereRaw('DATE(applied_at) <= ?', [$toDate->format('Y-m-d')])->get();

                $applications = [];
                foreach($allApplications as $application){
                        $applications[] = $application;
                }
                $name ='Applied At';

            }
            if ($request->intake) {
                $Sintakes = Intake::where('id',$request->intake)->first();
                $applications = [];
                foreach($allApplications as $application){
                    if ($request->intake == $application->course['intake']) {
                        $applications[] = $application;
                    }
                }
                $name = $Sintakes['name'];
                
            }
            if ($request->country) {
                $country = Country::where('id',$request->country)->first();
                $applications = [];
                
                foreach($allApplications as $application){
                    if ($request->country == $application['country_id']) {
                        if ($request->intake) {
                            if ($request->intake == $application->course['intake']) {
                                
                                $applications[] = $application;
                            }
                        }else{
                            $applications[] = $application;
                        }
                    }
                }
                $name = $country['name'];
            }
            if ($request->university) {
                $university = University::where('id',$request->university)->first();
                $applications = [];
                foreach($allApplications as $application){
                    if ($application->college) {
                        if ($request->university == $application->college['university_id']) {
                            $applications[] = $application;
                        }
                    }
                }
                $name = $university['name'];
            }
            if ($request->status) {
                $allApplicationStatus = ApplicationStatus::where('id',$request->status)->first();
                $applications = [];
                foreach($allApplications as $application){
                    if ($request->status == $application['file_status']) {
                        $applications[] = $application;
                    }
                }
                $name = $allApplicationStatus['name'];
            }
            if ($request->report == 'Total Applications') {
            
                $applications = AppliedStudentFile::with(['college'])->where('agent_id',(int)$user['id'])->get();
            }else if($request->report == 'Total Offers'){
                $applications = AppliedStudentFile::with(['college'])->where('agent_id',(int)$user['id'])->where('file_status',3)->Orwhere('file_status',4)->get();
            }
        }
        $students = [];
        foreach($applications as $application){
                if(!in_array($application['student_id'],$students)){
                    $students[] = $application['student_id'];
                }

        }
        $offers = [];
        foreach($applications as $application){
                if($application['file_status'] == 3 || $application['file_status'] == 4){
                    $offers[] = $application['file_status'];
                    // if(!in_array($application['student_id'],$offers)){
                    // }
                }

        }
        $total = sizeof($applications);
        $students  = sizeof($students);
        $offers = sizeof($offers);

        return view('agent.reports.total',compact('students','offers','name','total','applications','countries','intakes','Universities','applicationStatus'))->with('data',$request->all());
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
    public function comissionStructure($id)
    {   $id = base64_decode($id);
        dd($commission);
        $commission = Commission::where('country_id',$id)->first();
        return view('agent.comission.structure',compact('commission'));
    }
    public function allUkUniversities()
    {
        $requirements = Commission::where('id',2)->first();
        
        return view('agent.reports.universityStructure',compact('requirements'));
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
