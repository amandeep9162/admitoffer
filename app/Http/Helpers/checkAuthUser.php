<?php // Code within app\Helpers\CheckAuthUser.php

namespace App\Helpers;
use Bitfumes\Multiauth\Model\Role;
use App\Models\StudentAttachment;
use Auth;

class CheckAuthUser
{
    // CheckAuthUser
    public static function isPreProcess()
        {
            if(Auth::guard('admin')->check()){
                $admin = Auth::guard('admin')->user();
                $role = Role::where('id',$admin['id'])->first();
            }

            return $role;
            if($role['id'] == '4'){
                }else{
                    
                    return '';
            }
        }


}