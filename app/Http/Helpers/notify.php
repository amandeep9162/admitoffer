<?php // Code within app\Helpers\Notify.php

namespace App\Helpers;
use Bitfumes\Multiauth\Model\Role;
use App\Models\StudentAttachment;
use App\Models\Notification;
use App\Models\Announcement;
use Auth;

class Notify
{
    // Notify
    public static function notifications()
        {
            if(Auth::guard('agent')->check()){

            $agent = Auth::guard('agent')->user();
            $notifications = Notification::where('agent_id',$agent['id'])->where('status','0')->where('type','!=','status Chat')->orderBy('id','Desc')->get();
            }elseif(Auth::guard('student')->check()){
                $student = Auth::guard('student')->user();
            $notifications = Notification::where('student_id',$student['id'])->where('type','!=','admin')->where('agent_id',NULL)->where('type','!=','status Chat')->where('status','0')->orderBy('id','Desc')->get();
            }
            return $notifications;
        }

        public static function messages()
        {
            if(Auth::guard('agent')->check()){

            $agent = Auth::guard('agent')->user();
            $messages = Notification::where('agent_id',$agent['id'])->where('status','0')->where('type','status Chat')->orderBy('id','Desc')->get();
            }elseif(Auth::guard('student')->check()){
                $student = Auth::guard('student')->user();
            $messages = Notification::where('student_id',$student['id'])->where('type','!=','admin')->where('agent_id',NULL)->where('type','status Chat')->where('status','0')->orderBy('id','Desc')->get();
            }
            return $messages;
        }
    public static function adminNotifications()
        {
            if(Auth::guard('admin')->check()){
                $admin = Auth::guard('admin')->user();
                $role = Role::where('id',$admin['id'])->first();
            }
            if($admin->roles[0]['id'] == 3){

                $notifications = Notification::where('type','admin')->where('to',$admin['id'])->where('status','0')->where('admin_role','!=','shortlisting')->where('application_status','!=','chat')->orderBy('id','Desc')->get();
            }elseif($admin->roles[0]['id'] == 4){

                $notifications = Notification::where('user',$admin['id'])->where('type','admin')->where('application_status','!=','chat')->where('status','0')->orderBy('id','Desc')->get();
            }elseif($admin->roles[0]['name'] == 'shortlisting'){

                $notifications = Notification::where('user',$admin['id'])->where('type','admin')->where('application_status','!=','chat')->where('status','0')->where('admin_role','shortlisting')->orderBy('id','Desc')->get();
            }else{

                $notifications = Notification::where('type','admin')->where('status','0')->where('application_status','!=','chat')->orderBy('id','Desc')->get();
            }
            return $notifications;
        }
        public static function adminMessages()
        {
            if(Auth::guard('admin')->check()){
                $admin = Auth::guard('admin')->user();
                $role = Role::where('id',$admin['id'])->first();
            }
            if($admin->roles[0]['id'] == 3){

                $messages = Notification::where('type','admin')->where('application_status','chat')->where('status','0')->orderBy('id','Desc')->get();
            }elseif($admin->roles[0]['id'] == 4){

                $messages = Notification::where('user',$admin['id'])->where('application_status','chat')->where('type','admin')->where('status','0')->orderBy('id','Desc')->get();
            }else{

                $messages = Notification::where('type','admin')->where('application_status','chat')->where('status','0')->orderBy('id','Desc')->get();
            }
            return $messages;
        }


         public static function announcements()
        {
            if(Auth::guard('agent')->check()){

            $anouncment = Announcement::where('id',1)->first();
            return $anouncment;
            }
        }
        


}