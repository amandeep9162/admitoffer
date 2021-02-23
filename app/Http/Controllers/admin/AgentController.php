<?php

namespace App\Http\Controllers\admin;

use App\Agent;
use Bitfumes\Multiauth\Model\Admin;
use App\Models\Loc\Country;
use App\Models\Loc\State;
use App\Models\Loc\City;
use App\Models\Attachment;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\ApplicationDocument;
use App\Models\StudentQualification;
use App\Models\Agent\AppliedStudentFile;
use App\Models\ApplicationStatusTimeline;
use App\Models\StudentQualificationGap;
use App\Models\StudentQuestionAnswers;
use App\Models\StudentWorkExperiance;
use App\Models\StudentEnglishTest;
use App\Models\StudentAttachment;
use App\Models\PendancyAttachment;
use App\Models\AllowCountryAgent;
use App\Models\Sop_pendency;
use App\Models\Agent\Student;
Use App\Helpers\ImageUpload;
use App\Models\Notification;
use App\Models\Chat;
use Validator;
use Session;
use Input;
use Auth;
use Mail;
use File;

class AgentController extends Controller
{

    public function __construct(){
       
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $adminType = Auth::guard('admin')->user()->roles()->pluck('name');
        $admin = Auth::guard('admin')->user();
        if($adminType[0] == 'account manager'){

        $agents = Agent::with(['studentsApp'=>function($q){
            $q->where('lock_status',1);
        },'accountManager'])->where('account_manager',$admin['id'])->orderBy('id','DESC')->get();
        }else{
        $agents = Agent::with(['studentsApp','accountManager'])->orderBy('id','DESC')->get();

        }

        return view('admin.agents.agentList',compact('agents'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $countries =Country::all();
        
        return view('admin.agents.addNewAgent',compact('countries'));
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
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:agents',
            'mobileno' => 'required|max:12',
            'company_name' => 'required',
            'country_id' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
            'file' => 'mimes:jpeg,jpg,png|required|max:1000',
            'identity' => 'mimes:jpeg,jpg,png|required|max:1000',
            'password' => 'required|min:6|confirmed',
        ]);
        if(!Auth::guard('admin')->check()){
            $validator =  $this->validate($request,
            [
                'checkprivacy' => 'required',
            ]); 
        }
        if($request->state_id == '6'){
            $validator =  $this->validate($request,
            [
                'sspoffice' => 'required',
            ]); 
        }
       
        $agent = Agent::create([
            'name' => $request->name,
            'company_name' => $request->company_name,
            'email' => $request->email,
            'mobileno' => $request->mobileno,
            'ip_address' => $request->ip(),
            'address' => $request->address,
            'country_id' => $request->country_id,
            'state_id' => $request->state_id,
            'city_id' => $request->city_id,
            'password' => bcrypt($request->password),
        ]);
        
        $attachmentId  = $agent['id'];
        if (request()->hasFile('file')) {
            $file = request()->file('file');
            $agentSave = ImageUpload::uploadAttachment($file,'agent',$attachmentId);
            $identity = $request->identity;
            $agentidentitySave = ImageUpload::uploadAttachment($identity,'identity',$attachmentId);
            $establishment = $request->establishment;
            $agentestablishmentSave = ImageUpload::uploadAttachment($establishment,'establishment',$attachmentId);
             if($request->state_id == '32'){
                $validator =  $this->validate($request,
                [
                    'document' => 'mimes:jpeg,jpg,png|required|max:1000',
                ]); 
                 $agentDocument = $request->document;
                 $agentestablishmentSave = ImageUpload::uploadAttachment($agentDocument,'agentDocument',$attachmentId);
            }
        }
        if(!$agent->save()){
            return back()->withErrors($validator);
        }
             \Artisan::call('config:clear');
            $data = Agent::where('id',$agent->id)->first()->toArray();
                $mail =  Mail::send('emails.contractEvent', $data, function($message) use ($data) {
                    $message->to($data['email']);
                    $message->subject('Registed Successfully');
                    $message->from('himanshu@admitoffer.com','ADMITOFFER');
                });
        if($agent->save()){
            if(Auth::guard('admin')->check()){
                Session::flash('success','New agent added');
                return back();

            }else{
                Session::flash('success','Registration details has been sent for approval. ');
                

                return redirect()->route('agent.thankyou',base64_encode($data['id']));
            }

        }else{
            return back()->withErrors($validator);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function show(Agent $agent)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = base64_decode($id);
        $countries =Country::all();
        $agent = Agent::with(['city','attachment','agentDocument','identity','establishment'])->where('id',$id)->first();
        $city = City::where('id',$agent['city_id'])->first();
        $state = State::where('id',$agent['state_id'])->first();
        $country = Country::where('id',$agent['country_id'])->first();
        $allowCountry = Country::where('applyFor','1')->get();
        $admin =   Admin::get();
        $account_managers = [];
        foreach ($admin as $key => $value) {
            if($value->roles[0]['name'] == 'account manager'){
                
                $account_managers[] = $value;

            }
            
        }
         $allowCountAgent = AllowCountryAgent::where('agent_id',$id)->pluck('country_id')->toArray();


        return view('admin.agents.editAgent',compact('allowCountAgent','allowCountry','countries','account_managers','agent','country','state','city'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {   
        $validator =  $this->validate($request,
        [
            'name' => 'required|max:255',
            'company_name' => 'required',
            'email' => 'required|email|max:255',
            'country_id' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
        ]
        );

        $agent = Agent::where('id',$id)->update([
            'name' => $request->name,
            'company_name' => $request->company_name,
            'email' => $request->email,
            'mobileno' => $request->mobileno,
            'address' => $request->address,
            'country_id' => $request->country_id,
            'state_id' => $request->state_id,
            'account_manager' => $request->account_manager,
            'city_id' => $request->city_id,
        ]);
        if($request->imageID){

            if (request()->hasFile('file')) {
                $attachmentId = $id;
                $imageId = $request->imageID;
                $file = request()->file('file');
                $agentSave = ImageUpload::updateAttachment($file,'agent',$attachmentId,$imageId);
                
            }
        }else{
            if (request()->hasFile('file')) {
                $attachmentId = $id;
                $file = request()->file('file');
                $agentSave = ImageUpload::uploadAttachment($file,'agent',$attachmentId);
                }
        }
        if($request->agentDocumentID){

            if (request()->hasFile('document')) {
                $attachmentId = $id;
                $agentDocumentId = $request->agentDocumentID;
                $file = request()->file('document');
                $agentSave = ImageUpload::updateAttachment($file,'agentDocument',$attachmentId,$agentDocumentId);
            }
        }else{
            if (request()->hasFile('document')) {
                $attachmentId = $id;
                $file = request()->file('document');
                $agentSave = ImageUpload::uploadAttachment($file,'agentDocument',$attachmentId);
                }
            
        }
        if (request()->hasFile('identity')) {
            Attachment::where('type','identity')->where('attachment_id',$id)->delete();
            $attachmentId = $id;
            $file = request()->file('identity');
            $agentSave = ImageUpload::uploadAttachment($file,'identity',$attachmentId);
        }
        if (request()->hasFile('establishment')) {
            Attachment::where('type','establishment')->where('attachment_id',$id)->delete();
            $attachmentId = $id;
            $file = request()->file('establishment');
            $agentSave = ImageUpload::uploadAttachment($file,'establishment',$attachmentId);
        }
        if (request()->hasFile('contractfile')) {
            Attachment::where('type','contractfile')->where('attachment_id',$id)->delete();
            $attachmentId = $id;
            $file = request()->file('contractfile');
            $agentSave = ImageUpload::uploadAttachment($file,'contractfile',$attachmentId);
        }

        // store country access

        if($request->countries){
                AllowCountryAgent::where('agent_id',$id)->delete();
            foreach($request->countries as $key => $value) {
        
                
               $AllowCountryAgent =  AllowCountryAgent::create([
                    'agent_id'=> $id,
                    'country_id'=> $value,
                ]);

            }
        }
        

        Session::flash('success','Agent detail updated');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Agent  $agent
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Agent::where('id',$id)->delete();
            Session::flash('success','Agent deleted');
            return back();
    }
    public function ApproveAgent($id)
    {
        $id = base64_decode($id);
        Agent::where('id',$id)->update([
            'status'=>1,
        ]);
            Session::flash('success','Agent Approved');
            return back();
    }
    public function DisapproveAgent($id)
    {
        $id = base64_decode($id);
        Agent::where('id',$id)->update([
            'status'=>0,
        ]);
            Session::flash('success','Agent Deactive');
            return back();
    }

    public function deleteAgent($id)
    {
        $agent = Agent::where('id',$id)->first();
        $students = Student::where('agent_id',$id)->pluck('id')->toArray();

         $applications  = AppliedStudentFile::where('agent_id',$id)->pluck('id')->toArray();




        $applicationDocuments = ApplicationDocument::whereIn('student_id',$students)->get();

        // delete
        foreach($applicationDocuments as $applicationDocument){
            $image_path = $applicationDocument['path'].'/'.$applicationDocument['name']; 
            if(File::exists($image_path)) {
                    File::delete($image_path);
            }
        }
         $pendAttachs  = PendancyAttachment::whereIn('student_id',$students)->get();

        foreach($pendAttachs as $pendAttach){
            $pendSmage_path = $pendAttach['path'].'/'.$pendAttach['name']; 
            if(File::exists($pendSmage_path)) {
                    File::delete($pendSmage_path);
            }
        }

        $sopDocs = Sop_pendency::whereIn('student_id',$students)->get();
         foreach($sopDocs as $sopDoc){
            $sopImage_path = $sopDoc['path'].'/'.$sopDoc['name']; 
            if(File::exists($sopImage_path)) {
                    File::delete($sopImage_path);
            }
        }   


         $attachmentImg  = Attachment::where('attachment_id',$id)->where('type','agent')->first();


          $agentAttImage_path = $attachmentImg['path'].'/'.$attachmentImg['name']; 
            if(File::exists($agentAttImage_path)) {
                    File::delete($agentAttImage_path);
            }

         $attachmentID  = Attachment::where('attachment_id',$id)->where('type','identity')->first();
            $agentAttImageID_path = $attachmentID['path'].'/'.$attachmentID['name']; 
            if(File::exists($agentAttImageID_path)) {
                    File::delete($agentAttImageID_path);
            }

         $attachmentestable  = Attachment::where('attachment_id',$id)->where('type','establishment')->first();
            $agentAttImageEst_path = $attachmentestable['path'].'/'.$attachmentestable['name']; 
            if(File::exists($agentAttImageEst_path)) {
                    File::delete($agentAttImageEst_path);
            }
         $attachmentDoc  = Attachment::where('attachment_id',$id)->where('type','agentDocument')->first();

         $agentAttImageDoc_path = $attachmentDoc['path'].'/'.$attachmentDoc['name']; 
            if(File::exists($agentAttImageDoc_path)) {
                    File::delete($agentAttImageDoc_path);
            }
        $attachmentcont  = Attachment::where('attachment_id',$id)->where('type','contractfile')->first();
         $agentAttImageCont_path = $attachmentcont['path'].'/'.$attachmentcont['name']; 
            if(File::exists($agentAttImageCont_path)) {
                    File::delete($agentAttImageCont_path);
            }

        $sopDocs = Sop_pendency::whereIn('student_id',$students)->delete();
        $qualGap = StudentQualificationGap::whereIn('student_id',$students)->delete();
        $qualification = StudentQualification::whereIn('student_id',$students)->delete();
        $englishTest = StudentEnglishTest::whereIn('student_id',$students)->delete();
        $stdQuestionAnswe = StudentQuestionAnswers::whereIn('student_id',$students)->delete();
        $stdWorkExp = StudentWorkExperiance::whereIn('student_id',$students)->delete();
        $stdAttach = StudentAttachment::whereIn('student_id',$students)->delete();
         $deletePendAttachs  = PendancyAttachment::whereIn('student_id',$students)->delete();
         $deleteAttachmentImg  = Attachment::where('attachment_id',$id)->where('type','agent')->delete();
         $deleteAttachmentID  = Attachment::where('attachment_id',$id)->where('type','identity')->delete();
         $deleteAttachmentestable  = Attachment::where('attachment_id',$id)->where('type','establishment')->delete();
         $deleteAttachmentDoc  = Attachment::where('attachment_id',$id)->where('type','agentDocument')->delete();
         $deleteAttachmentContract  = Attachment::where('attachment_id',$id)->where('type','contractfile')->delete();
         $deleteApplicationTimeline  = ApplicationStatusTimeline::whereIn('application_id',$applications)->delete();
         $deleteChat  = Chat::whereIn('application_id',$applications)->delete();
         $deleteNotif  = Notification::whereIn('student_id',$students)->delete();
        $deleteAapplicationDocuments = ApplicationDocument::whereIn('student_id',$students)->delete();
         $deleteApplications  = AppliedStudentFile::where('agent_id',$id)->delete();
        $DeleteStudents = Student::where('agent_id',$id)->delete();
        Agent::where('id',$id)->delete();
        return redirect()->route('agents.index');
    }
}
