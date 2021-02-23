<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Chat;
use App\Models\Agent\AppliedStudentFile;
use App\Agent;
use App\Models\Notification;
use App\Models\Agent\Student;
use Validator;
use Session;
use Auth;
use Carbon;

class ChatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.chat.add');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $id = base64_decode($id);
        
        if(Auth::guard('agent')->check()){
            $agent = Auth::guard('agent')->user();
            $messages = Chat::where('application_id',NULL)->where('student_id',NULL)->where('agent_id',$agent['id'])->get();
           
         }elseif(Auth::guard('admin')->check()){
            $admin = Auth::guard('admin')->user();
            $agent = Agent::where('id',$id)->first();
            $messages = Chat::where('agent_id',$id)->where('application_id',NULL)->where('student_id',NULL)->get();

        }


        return view('chat.live',compact('messages','id','agent'));
    }
    public function createAgent()
    {
        
        
        if(Auth::guard('agent')->check()){
            $agent = Auth::guard('agent')->user();
            $messages = Chat::where('application_id',NULL)->where('student_id',NULL)->where('agent_id',$agent['id'])->get();
           
         }elseif(Auth::guard('admin')->check()){
            $admin = Auth::guard('admin')->user();
            $messages = Chat::where('application_id',NULL)->where('student_id',NULL)->where('admin_id',$admin['id'])->get();

        }


        return view('chat.agentLive',compact('messages'));
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
                'message' => 'required|min:2',
            ]
        );
        if($request->application_id != 'yes'){
            if(Auth::guard('agent')->check()){
                $agentId = Auth::guard('agent')->user()->id;
                $agent = Auth::guard('agent')->user();
                $chat = Chat::create([
                    'application_id'=>$request->application_id,  
                    'message'=>$request->message,  
                    'type'=>'agent',  
                    'agent_id'=>$agentId,  
                ]);

                $application = AppliedStudentFile::where('id',$request->application_id)->first();
                Notification::create([
                    'type' =>'admin',
                    'link' =>route('chat.show',base64_encode($application['id'])),
                    'agent_id' =>'',
                    'application_id' =>$application['id'],
                    'message' => $agent['name'].' sent message '. $request->message.' on ' .$application->course['name'].' of ' .$application->student['firstName'].' ' .$application->student['lastName'].' Application',
                    'application_status' =>'chat',
                    'status' =>0,
                    ]);
                
            }elseif(Auth::guard('admin')->check()){
               $adminID = Auth::guard('admin')->user()->id;
               $application = AppliedStudentFile::where('id',$request->application_id)->first();
                $chat = Chat::create([
                            'application_id'=>$request->application_id,  
                            'message'=>$request->message,  
                            'type'=>'admin',  
                            'admin_id'=>$adminID,  
                            'agent_id'=>$application['agent_id'],  
                        ]);

                Notification::create([
                    'type' =>'status Chat',
                    'link' =>route('chat.show',base64_encode($application['id'])),
                    'agent_id' =>$application['agent_id'],
                    'application_id' =>$application['id'],
                    'message' => 'Dear '.$application->agent['name'].' sent message '.$request->message.' on ' .$application->student['firstName'].' ' .$application->student['lastName'].' Application by ADMITOFFER team',
                    'application_status' =>'',
                    'status' =>0,
                    ]);
            
            }
        }else{

            if(Auth::guard('agent')->check()){
                $agentId = Auth::guard('agent')->user()->id;
                $agent = Auth::guard('agent')->user();
                $chat = Chat::create([
                    'application_id'=>NULL,  
                    'message'=>$request->message,  
                    'type'=>'agent',  
                    'agent_id'=>$agentId,  
                    'admin_id'=>'5',  
                ]);

                Notification::create([
                    'type' =>'admin',
                    'link' =>route('chat.create',base64_encode($agentId)),
                    'agent_id' =>'',
                    'application_id' =>NULL,
                    'message' => $agent['name'].' sent message : '. $request->message.' ',
                    'application_status' =>'chat',
                    'status' =>0,
                    ]);
                
            }elseif(Auth::guard('admin')->check()){
               $adminID = Auth::guard('admin')->user()->id;
                $agent = Agent::where('id',$request->agent_id)->first();
                $chat = Chat::create([
                            'application_id'=>NULL,  
                            'message'=>$request->message,  
                            'type'=>'admin',  
                            'admin_id'=>$adminID,  
                            'agent_id'=>$request->agent_id,  
                        ]);

                Notification::create([
                    'type' =>'status Chat',
                    'link' =>route('chat.create.agent'),
                    'agent_id' =>$request->agent_id,
                    'application_id' =>'',
                    'message' => 'Dear '.$agent['name'].' ADMITOFFER team sent message '. $request->message,
                    'application_status' =>'chat',
                    'status' =>0,
                    ]);
            
            }

        }
    
        return response()->json([ 'status' => 'success' , 'message' => 'message saved' ,'data' => $chat] , 200);
    }
    public function StudentChatstore(Request $request)
    {
        $validator =  $this->validate($request,
            [
                'message' => 'required|min:2',
            ]
        );
        if($request->student_id  != 'yes'){
            if(Auth::guard('agent')->check()){
                $agent = Auth::guard('agent')->user();
                $agentId = Auth::guard('agent')->user()->id;
                $student = Student::where('id',$request->student_id)->first();
                if($student['lock_status'] == '1'){
                    $to = 'preprocess';
                }else{

                    $to = 'shortlisting';
                }
                $chat = Chat::create([
                    'student_id'=>$request->student_id,  
                    'message'=>$request->message,  
                    'type'=>'studentChat',  
                    'from'=>$agentId,  
                    'to'=>'admin',  
                    'admin_role'=>'admin',  
                ]);

                Notification::create([
                    'type' =>'admin',
                    'link' =>route('admin.student.chat',base64_encode($student['id'])),
                    'agent_id' =>'',
                    'student_id' =>$student['id'],
                    'admin_role'=>$to,  
                    'message' => $agent['name'].' sent message '. $request->message.' on ' .$student['firstName'].''. $student['lastName'].' Student',
                    'application_status' =>'chat',
                    'status' =>0,
                    ]);
                
            }elseif(Auth::guard('admin')->check()){
                // dd($request->all());
               $admin = Auth::guard('admin')->user();
               $adminID = Auth::guard('admin')->user()->id;
               $student = Student::where('id',$request->student_id)->first();
                $chat = Chat::create([
                              
                            'student_id'=>$request->student_id,  
                            'message'=>$request->message,  
                            'admin_id'=>$adminID,  
                            'agent_id'=>$student['agent_id'],  
                            'type'=>'studentChat',  
                            'from'=>'admin',  
                            'to'=> $student['agent_id'],  
                            'admin_role'=> 'agent',  
                        ]);

                Notification::create([
                    'type' =>'status Chat',
                    'link' =>route('agent.student.chat.show',base64_encode($student['id'])),
                    'agent_id' =>$student['agent_id'],
                    'student_id' =>$student['id'],
                    'message' =>'Admit Offer team Sent message '. $request->message.' on ' .$student['firstName'].''.$student['lastName'].' student',
                    'application_status' =>'',
                    'status' =>0,
                    ]);
            
            }
        }
    
        return response()->json([ 'status' => 'success' , 'message' => 'message saved' ,'data' => $chat] , 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id = base64_decode($id);
        $application = AppliedStudentFile::where('id',$id)->first();
        $messages = Chat::where('application_id',$id)->get();
        // if(Auth::guard('agent')->check()){
        //     return view('agent.chat.view',compact('messages','application'));
            
        // }elseif(Auth::guard('admin')->check()){

        // }
        return view('chat.view',compact('messages','application'));
    }
    public function studentChat($id)
    {
        $id = base64_decode($id);
    
        $messages = Chat::where('student_id',$id)->get();
        // if(Auth::guard('agent')->check()){
        //     return view('agent.chat.view',compact('messages','application'));
            
        // }elseif(Auth::guard('admin')->check()){

        // }
        return view('chat.view',compact('messages'));
    }
    public function AdminStudentChat($id)
    {
        $id = base64_decode($id);
   
        $messages = Chat::where('student_id',$id)->get();
        $student = Student::where('id',$id)->first();
        $agent = Agent::where('id',$student['agent_id'])->first();
        Notification::where('student_id',$id)->where('application_status','chat')->where('application_id',NULL)->update(['status' => 1]);
        
        return view('chat.adminStudentChat',compact('messages','student','agent'));
    }
     public function AgentStudentChat($id)
    {
        $id = base64_decode($id);
   
        $messages = Chat::where('student_id',$id)->get();
        $student = Student::where('id',$id)->first();
        $agent = Agent::where('id',$student['agent_id'])->first();
        Notification::where('student_id',$id)->where('type','status Chat')->where('application_id',NULL)->update(['status' => 1]);

        return view('chat.agentStudentChat',compact('messages','student','agent'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($application_id,$agent_id = NULL)
    {
        
        

            if($application_id != 'yes'){
                $chat = Chat::where('application_id',$application_id)->get();
            }else{

                if(Auth::guard('agent')->check()){
                   $agent = Auth::guard('agent')->user();

                $chat = Chat::where('application_id',NULL)->where('student_id',NULL)->where('agent_id',$agent['id'])->get();
                }else {
                   $admin = Auth::guard('admin')->user();
                

                    $chat = Chat::where('application_id',NULL)->where('student_id',NULL)->where('agent_id',$agent_id)->get();
                   

                }

            }
        
        return response()->json([ 'status' => 'success' , 'message' => 'All message' ,'data' => $chat] , 200);
    }
    public function Studentedit($student_id,$student)
    {
        
        

            if($student != 'yes'){
                $chat = Chat::where('student_id',$student_id)->get();
            }else{

                if(Auth::guard('agent')->check()){
                   $agent = Auth::guard('agent')->user();

                $chat = Chat::where('student_id',$student_id)->get();
                }else {
                   $admin = Auth::guard('admin')->user();
                

                    $chat = Chat::where('student_id',$student_id)->get();
                   

                }

            }
        
        return response()->json([ 'status' => 'success' , 'message' => 'All message' ,'data' => $chat] , 200);
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
