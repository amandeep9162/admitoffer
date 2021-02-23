<?php // Code within app\Helpers\GetAnnouncement.php

namespace App\Helpers;
use Bitfumes\Multiauth\Model\Role;
use App\Models\StudentAttachment;
use App\Models\Announcement;
use App\Models\Notification;
use Auth;

class GetAnnouncement
{
       
        public static function announcements()
        {
            if(Auth::guard('agent')->check()){

            $anouncment = Announcement::where('id',1)->first();
            return $anouncment;
        }



}
}