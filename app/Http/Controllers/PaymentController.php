<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Agent\Student;
use App\Models\Loc\Country;
use App\Models\Agent\AppliedStudentFile;
use App\Models\StudentQuestionAnswers;
use App\Models\StudentApplicationsPayment;
use Redirect,Response,Session;

class PaymentController extends Controller
{
     public function index($student_id,$amount)
	 {
	 	$student_id = base64_decode($student_id);
	 	$amount = (int)base64_decode($amount);
	 	$sessionStudent_id = Session::get('paymentstudent_id');
	 	$sessionamount = Session::get('amount');
	 	if($student_id == $sessionStudent_id && $amount == $sessionamount){
	 		$student = Student::where('id',$student_id)->first();
	 		$country = Country::where('id',$student['applingForCountry'])->first();

	 	 return view('payment.index',compact('student_id','amount','country'));
	 	}else{

	 		Session::flash('success','New Student created');
	 		return back();
	 	}
	 }
	 public function razorPaySuccess(Request $request){
	 	
	 $data = [
	           'user_id' => '1',
	           'student_id' => $request->student_id,
	           'payment_id' => $request->razorpay_payment_id,
	           'amount' => $request->totalAmount,
	        ];
	 $getId = Payment::insertGetId($data);
	 $sessionamount = Session::get('amount');
	 $student = Student::where('id',$request->student_id)->update(['applicationFee_status'=>'paid','application_total_fee'=>$sessionamount,'application_fee_paid_amount'=>$request->totalAmount]);
	 $allApplications = AppliedStudentFile::with('college')->where('student_id',$request->student_id)->get();
	 foreach($allApplications as $key => $allApplication){
	 
	 	$hasPaid = StudentApplicationsPayment::where('student_id',$request->student_id)->where('college_id',$allApplication->college['id'])->first();
	 	if(!$hasPaid){

	 		$studentApplicationsPayment = StudentApplicationsPayment::create(['student_id'=>$request->student_id,'college_name'=>$allApplication->college['name'],'college_id'=>$allApplication->college['id'],'amount'=>$allApplication->college['application_fee']]);
	 	}
	 }

	 $arr = array('msg' => 'Payment successfully credited', 'status' => true,'student_id' => $request->student_id);
	 return Response()->json($arr);    
	 }
	 public function RazorThankYou($id)
	 {
	 	$student_id = base64_decode($id);
	 	$id = $id;
	 	
	  	$applications = StudentApplicationsPayment::where('student_id',$student_id)->get();
	 return view('payment.thankyou',compact('id','applications'));
	 }
}
