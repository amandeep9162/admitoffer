<?php // Code within app\Helpers\GetAnnouncement.php

namespace App\Http\Helpers;
use App\Models\StudentAttachment;
use App\Models\Announcement;
use App\Models\Notification;
use App\Models\AllowCountryAgent;
use Auth;

class CheckCountry
{
       
        public static function allowCountry()
        {
            if(Auth::guard('agent')->check()){

            	$AllowCountryAgent = AllowCountryAgent::where('agent_id',Auth::guard('agent')->user()->id)->pluck('country_id')->toArray();
            return $AllowCountryAgent;
        }



}
}