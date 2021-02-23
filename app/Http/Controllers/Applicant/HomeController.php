<?php

namespace App\Http\Controllers\Applicant;

use App\Http\Controllers\Controller;
use App\Models\Agent\AppliedStudentFile;
use Auth;

class HomeController extends Controller
{

    protected $redirectTo = '/applicant/login';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('applicant.auth:student');
    }

    /**
     * Show the Applicant dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() {
        $studentUser =Auth::guard('student')->user();
        $allApplyStudents = AppliedStudentFile::with('timelines')->where('student_id',$studentUser['id'])->get();
        
        return view('applicant.home',compact('allApplyStudents'));
    }

}