<?php

namespace App\Http\Controllers;
use App\Models\College;
use App\Models\Course;
use App\Models\Loc\Country;
use App\Models\Loc\State;
use App\Models\Loc\City;
use App\Models\ProgramTitle;
use Bitfumes\Multiauth\Model\Admin;
use Bitfumes\Multiauth\Model\Role;
use App\Models\Attachment;
use App\Models\InstituteType;
use App\Models\SchoolType;
Use App\Helpers\ImageUpload;
use App\Models\University;
use Validator;
use Session;
use Auth;

use Illuminate\Http\Request;

class CollegeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        ini_set('memory_limit', '-1');
            ini_set('max_execution_time', 1500);
        $colleges =College::with('InstituteType','country')->orderBy('id','DESC')->get();   
          $updatecourses = Course::where('college_name',NULL)->orWhere('programTitle_name',NULL)->get();
        foreach ($updatecourses as $key => $value)
        {
            if (!$value['college_name'])
            {
                $clgname = College::where('id', $value['college_id'])->first();
                $crsupdate = Course::where('college_id', $value['college_id'])->update(['college_name' => $clgname['name']]);

            }
            if (!$value['programTitle_name'])
            {

                $prgttl = ProgramTitle::where('id', $value['programTitle_id'])->first();
                $crsPrgupdate = Course::where('programTitle_id', $prgttl['id'])->update(['programTitle_name' => $prgttl['name']]);

            }
        }  
        return view('admin.colleges.collegesList',compact('colleges'));
    }
    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        ini_set('memory_limit', '-1');
        $countries =Country::all();
        $state = State::all();
        // $cities =City::all();
        $instituteTypes = InstituteType::all();
        $schoolTypes = SchoolType::all();
        $roles = Role::with('admins')->where('name','preprocess')->first();

        return view('admin.colleges.addCollege',compact('state','countries','instituteTypes','schoolTypes','roles'));
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
        $user =Auth::guard('admin')->user();
        $validator =  $this->validate($request,
        ['name' => 'required|min:2',
        'description' => 'required|min:10|max:1000',
        'website_link' => 'required',
        'instituteType' => 'required',
        'schoolType' => 'required',
        'city_id' => 'required',
        // 'logo' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]
    );
    
   $college =  College::create([
        'name'=>$request->name,  
        'description'=>$request->description,  
        'website_link'=>$request->website_link,  
        'city_id'=>$request->city_id,  
        'country_id'=>$request->country_id,  
        'instituteType'=>$request->instituteType,  
        'isCardRequired'=>$request->isCardRequired,  
        'isDocumentRequired'=>$request->isDocumentRequired,  
        'university_id'=>$request->university_id,  
        'preProcessBy'=>$request->preProcessBy,  
        'inserted_by'=>$user['id'],  
        'schoolType'=>$request->schoolType,  
        'commission'=>$request->commission,  
        'application_fee'=>$request->application_fee,  
        'entry_requirement'=>$request->entryRequirement,  
        ]);

         $college->save();
         $collegeId = $college['id'];
        if (request()->hasFile('logo')) {
        $file = request()->file('logo');
        $logoSave = ImageUpload::uploadAttachment($file,'logo',$collegeId);
        }

        if (request()->hasFile('collegeSignedDocument')) {
        $files = request()->file('collegeSignedDocument');
        $collegeSignedDocumentSave = ImageUpload::uploadAttachment($files,'collegeSignedDocument',$collegeId);
        }
        Session::flash('success','New Institute created');
        return redirect()->route('colleges.index');
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
    

    public function instituteDeactivate($id)
    {
        $college = College::where('id',(int)$id)->first();
        if($college['status'] == '0'){

            College::where('id',(int)$id)->update([
                'status'=>'1',
            ]);
            Course::where('college_id',$id)->update([
                 'status'=>'1',
            ]);
        }else{
            College::where('id',(int)$id)->update([
                'status'=>'0',
            ]);
            Course::where('college_id',$id)->update([
                 'status'=>'0',
            ]);
        }
        Session::flash('success','Institute Deactivate');
        return back();
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        ini_set('memory_limit', '-1');
        $id = base64_decode($id);
        $college = College::with(['city','attachment','collegeSignedDocuments'])->where('id',$id)->first();
        $city = City::where('id',$college['city_id'])->first();
        $state = State::where('id',$city['state_id'])->first();
        $country = Country::where('id',$state['country_id'])->first();
        $universities = University::where('country_id',$state['country_id'])->get();
        $countries =Country::all();
        $instituteTypes = InstituteType::all();
        $schoolTypes = SchoolType::all();
        $roles = Role::with('admins')->where('name','preprocess')->first();
        return view('admin.colleges.editCollege',compact('countries','college','country','state','city','instituteTypes','schoolTypes','roles','universities'));
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
        $user =Auth::guard('admin')->user();
        $id = base64_decode($id);
        if(!$request->country_id){
            $city = City::where('id',$request->city_id)->first();
            $state = State::where('id',$city['state_id'])->first();
            $country = $state['country_id'];
        }else{

            $country = $request->country_id;
        }
        
        
        $validator =  $this->validate($request,
        ['name' => 'required|min:2',
        'description' => 'required|min:10|max:1000',
        'website_link' => 'required',
        'instituteType' => 'required',
        'schoolType' => 'required',
        'city_id' => 'required',
        ]
        );
        College::where('id',$id)->update([
            'name'=>$request->name,  
            'description'=>$request->description,  
            'website_link'=>$request->website_link,  
            'city_id'=>$request->city_id,
            'country_id'=>$country,
            'instituteType'=>$request->instituteType,
            'isCardRequired'=>$request->isCardRequired,  
            'isDocumentRequired'=>$request->isDocumentRequired, 
            'university_id'=>$request->university_id,
            'preProcessBy'=>$request->preProcessBy,  
            'inserted_by'=>$user['id'],  
            'schoolType'=>$request->schoolType,  
            'commission'=>$request->commission,  
            'application_fee'=>$request->application_fee,  
            'entry_requirement'=>$request->entryRequirement,
            ]);
            if (request()->hasFile('logo')) {
                $collegeId = $id;
                $imageId = $request->imageID;
                $file = request()->file('logo');
                $attachment = Attachment::where('attachment_id',$id)->where('type','logo')->first();
                if($attachment){

                    $logoSave = ImageUpload::updateAttachment($file,'logo',$collegeId,$imageId);
                }else{
                    $logoSave = ImageUpload::uploadAttachment($file,'logo',$collegeId);

                }
            }
            if (request()->hasFile('collegeSignedDocument')) {
                $collegeId = $id;
                $collegeSignedDocumentID = $request->collegeSignedDocumentID;
                
                $file = request()->file('collegeSignedDocument');
                $attachments = Attachment::where('attachment_id',$id)->where('type','collegeSignedDocument')->first();
                if($attachments){

                    $collegeSignedDocumentSave = ImageUpload::updateAttachment($file,'collegeSignedDocument',$collegeId,$collegeSignedDocumentID);
                }else{
                    $collegeSignedDocumentSave = ImageUpload::uploadAttachment($file,'collegeSignedDocument',$collegeId);

                }
            }
             if (request()->hasFile('structureFile')) {
                $collegeId = $id;
                $structureimageID = $request->structureimageID;
                $file = request()->file('structureFile');
                $structureFile = Attachment::where('attachment_id',$id)->where('type','structure')->first();
                if($structureFile){

                    $structureFiles = ImageUpload::updateAttachment($file,'structure',$collegeId,$structureimageID);
                }else{
                    $structureFiles = ImageUpload::uploadAttachment($file,'structure',$collegeId);

                }
            }
            $college =College::where('id',$id)->first();
            Course::where('college_id',$id)->update(['college_name'=>$college['name']]);
            Session::flash('success','Institute detail updated');
            return back();
        }
        
        /**
         * Remove the specified resource from storage.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function getAllUniversities($id)
        {
            $allUniversities = University::where('country_id',$id)->get();
            
            return $allUniversities;
        }
        /**
         * Remove the specified resource from storage.
         *
         * @param  int  $id
         * @return \Illuminate\Http\Response
         */
        public function destroy($id)
        {
            College::where('id',$id)->delete();
            Session::flash('success','College deleted');
            return back();
        }
    }
    