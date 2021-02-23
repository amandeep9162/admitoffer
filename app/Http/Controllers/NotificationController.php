<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Notification;
use Bitfumes\Multiauth\Model\Role;
use Validator;
use Session;
use Auth;

class NotificationController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
            $anotifications = Notification::where('link','like','%www.%')->get();
            if($anotifications){

                foreach ($anotifications as $key => $value) {
                   
                    $src = str_replace('www.','', $value['link']);

                    $anotificationss = Notification::where('id',$value['id'])->update(['link' => $src]);
                    
                }
            }

        $agent = Auth::guard('agent')->user();
            $admin = Auth::guard('admin')->user();
        if($agent){

            $notifications = Notification::where('agent_id',$agent['id'])->where('type','!=','status Chat')->where('status','0')->get();
            
            
            return view('agent.notification.list',compact('notifications'));
        }elseif($admin->roles[0]['name'] == 'shortlisting'){
            $notifications = Notification::where('type','admin')->where('to',$admin['id'])->orderBy('id','DESC')->where('type','!=','status Chat')->where('status','0')->get();
            

            return view('admin.notification.list',compact('notifications'));
        }else{
            $notifications = Notification::where('type','admin')->orderBy('id','DESC')->where('type','!=','status Chat')->where('status','0')->get();
            

            return view('admin.notification.list',compact('notifications'));
             
        }
    }
    public function messages()
    {
        $agent = Auth::guard('agent')->user();
            $admin = Auth::guard('admin')->user();
        if($agent){

            $messages = Notification::where('agent_id',$agent['id'])->where('type','status Chat')->where('status','0')->get();
            
            return view('agent.notification.messageslist',compact('messages'));
        }elseif($admin->roles[0]['name'] == 'shortlisting'){
          
            $messages = Notification::where('type','admin')->where('admin_role','shortlisting')->where('application_status','chat')->orderBy('id','DESC')->get()->take(10);

            return view('admin.notification.messageslist',compact('messages'));
        }else{
            
            $messages = Notification::where('type','admin')->where('application_status','chat')->orderBy('id','DESC')->get()->take(10);

            return view('admin.notification.messageslist',compact('messages'));
             
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getNotifications()
    {
        $notification = '';
        $notifCount = 0;
        $adminNotification = '';
        $adminNotificationCount = 0;

        $messages = '';
        $msgCount = 0;
        $adminMessages = '';
        $adminMessagesCount = 0;


        
        if(Auth::guard('agent')->check()){
        $agent = Auth::guard('agent')->user();
        $notification = Notification::where('agent_id',$agent['id'])->where('status','0')->where('type','!=','status Chat')->orderBy('id','Desc')->get();
        $notifCount = $notification->count();
        $messages = Notification::where('agent_id',$agent['id'])->where('type','status Chat')->where('status','0')->orderBy('id','Desc')->get();
        $msgCount = $messages->count();
        }

        if(Auth::guard('student')->check()){
        $studentUser = Auth::guard('student')->user();

        $notification = Notification::where('student_id',$studentUser['id'])->where('type','!=','admin')->where('agent_id',NULL)->where('status','0')->orderBy('id','Desc')->get();
        $notifCount = $notification->count();
        }

        if(Auth::guard('admin')->check()){
                $admin = Auth::guard('admin')->user();
                $role = Role::where('id',$admin['id'])->first();
            if($admin->roles[0]['id'] == 3){

                $adminNotification = Notification::where('type','admin')->where('to',$admin['id'])->where('application_status','!=','chat')->where('status','0')->where('admin_role','!=','shortlisting')->orderBy('id','Desc')->get();
                $adminNotificationCount = $adminNotification->count();

                $adminMessages = Notification::where('type','admin')->where('status','0')->where('application_status','chat')->orderBy('id','Desc')->get();
                $adminMessagesCount = $adminMessages->count();
            }elseif($admin->roles[0]['id'] == 4){

                $adminNotification = Notification::where('user',$admin['id'])->where('application_status','!=','chat')->where('type','admin')->where('status','0')->where('admin_role','!=','shortlisting')->orderBy('id','Desc')->get();
                $adminNotificationCount = $adminNotification->count();

                $adminMessages = Notification::where('user',$admin['id'])->where('type','admin')->where('application_status','chat')->where('status','0')->where('admin_role','!=','shortlisting')->orderBy('id','Desc')->get();
                $adminMessagesCount = $adminMessages->count();

            }elseif($admin->roles[0]['name'] == 'shortlisting'){
                $adminNotification = Notification::where('type','admin')->where('to',$admin['id'])->where('application_status','!=','chat')->where('status','0')->Where('to',$admin['id'])->orderBy('id','Desc')->get();
                $adminNotificationCount = $adminNotification->count();

                $adminMessages = Notification::where('type','admin')->where('status','0')->where('application_status','chat')->where('admin_role','shortlisting')->orderBy('id','Desc')->get();
                $adminMessagesCount = $adminMessages->count();
            }else{
                $adminNotification = Notification::where('type','admin')->where('application_status','!=','chat')->where('status','0')->orderBy('id','Desc')->get();
                $adminNotificationCount = $adminNotification->count();

                $adminMessages = Notification::where('type','admin')->where('status','0')->where('application_status','chat')->orderBy('id','Desc')->get();
                $adminMessagesCount = $adminMessages->count();
            }
        }
        
        return ['notification'=>$notification,'notifCount'=>$notifCount,'adminNotification'=>$adminNotification,'adminNotificationCount'=>$adminNotificationCount,'messages'=>$messages,'msgCount'=>$msgCount,'adminMessages'=>$adminMessages,'adminMessagesCount'=>$adminMessagesCount];
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

        
        $notification = Notification::where('id',$id)->update([
            'status'=>'1',
            ]);
        $notificationGet = Notification::where('id',$id)->first();
        return redirect($notificationGet['link']);
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
