<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Commission;
use App\Agent;
use Session;
use Auth;

class AdmitOfferController extends Controller
{
    public function index()
    {   
        
        return view('admitoffer.index');
    }
    public function aboutus()
    {
        
        return view('admitoffer.about');
    }
     public function privacyPolicy()
    {
        
        return view('admitoffer.privacy_policy');
    }
     public function refundPolicy()
    {
        
        return view('admitoffer.refund_policy');
    }
     public function termsandconditions()
    {
        
        return view('admitoffer.termsandconditions');
    }
    public function solution()
    {
        
        return view('admitoffer.solutions');
    }
    public function gallery()
    {
        
        return view('admitoffer.gallery');
    }
    public function contactus()
    {
        
        return view('admitoffer.contact');
    }
      public function webinars()
    {
        
        return view('admitoffer.webinars');
    }

     public function pdfView(Request $request){
        $data =  $request->all();
        return  view('pdf.view',compact('data'));
    }
    public function getpdfView(Request $request){
        
        return redirect()->route('student.index');
    } 
    public function lock($id){
        $id = base64_decode($id);
        return view('pagelock.view',compact('id'));
    }
    public function unlock(Request $request){
        $agent =Auth::guard('agent')->user();
        if($request->password == $agent['pagelock'] ){
            $countryID =  Session::get('commissionStructureCountryId');
            $id = base64_decode($countryID);
             $commission = Commission::where('country_id',$id)->first();
        return view('agent.comission.structure',compact('commission'));
        }

        return back()->withErrors(['Password not match']);
    }
    public function changePassword(){

        return view('pagelock.changepassword');
    }
    public function changePasswordUpdate(Request $request){
        
         $agent =Auth::guard('agent')->user();
        if($request->oldpassword == $agent['pagelock'] ){
            if($request->newpassword == $request->confirmpassword ){
                Agent::where('id',$agent['id'])->update(['pagelock'=> $request->newpassword]);
            Session::flash('success','New Password Updated');

            return back();
            }else{

            return back()->withErrors(['confirm password not matched
                ']);
            }

            
        }else{
            return back()->withErrors(['correct old password']);
        }
    }
}