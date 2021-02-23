<?php // Code within app\Helpers\ImageUpload.php

namespace App\Helpers;
use App\Models\Attachment;
use App\Models\StudentAttachment;
use Auth;

class ImageUpload
{
    // upload image
    
    public static function uploadAttachment($file,$type,$id=NULL)
    {
        $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
        if($id != NULL){
            $destinationPath = 'uploads/'.$type.'/'.$id;
        }else{
            $destinationPath = 'uploads/'.$type.'/';
        }
         $file->move($destinationPath, $fileName);    
       $attachment = Attachment::create([
            'name' => $fileName,
            'path' => $destinationPath,
            'type' => $type,
            'attachment_id' => $id
            ]);
        $attachment->save();    
        return $attachment->id;
    }
    // update Iamge
    public static function updateAttachment($file,$type,$id=NULL,$imageId)
    {
        $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
        if($id != NULL){
            $destinationPath = 'uploads/'.$type.'/'.$id;
        }else{
            $destinationPath = 'uploads/'.$type.'/';
        }
         $file->move($destinationPath, $fileName);    
       $attachment = Attachment::where('id',$imageId)->update([
            'name' => $fileName,
            'path' => $destinationPath,
            ]);
        return true;
    }

// upload student documents

public static function uploadStudentDocuments($file,$attachmentName=NULL,$type,$id=NULL,$attachmentId=NULL)
    {
        $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
        if($id != NULL){
            $destinationPath = 'uploads/student/'.$type.'/'.$id;
        }else{
            $destinationPath = 'uploads/student/'.$type.'/';
        }
         $file->move($destinationPath, $fileName);    
       $attachment = StudentAttachment::create([
            'name' => $fileName,
            'path' => $destinationPath,
            'type' => $type,
            'student_id' => $id,
            'attachment_id' => $attachmentId,
            'attachment_name' => $attachmentName,
            ]);
        $attachment->save();    
        return $attachment->id;
    }
public static function updateStudentDocuments($file,$attachmentName=NULL,$type,$id=NULL,$attachmentId=NULL)
    {
        $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
        if($id != NULL){
            $destinationPath = 'uploads/student/'.$type.'/'.$id;
        }else{
            $destinationPath = 'uploads/student/'.$type.'/';
        }
        $file->move($destinationPath, $fileName);    
        // $Lastattachment = StudentAttachment::where('student_id',$id)->where('attachment_id',$attachmentId)->first();
        // \File::delete($Lastattachment['name']);
        $attachment = StudentAttachment::where('student_id',$id)->where('attachment_id',$attachmentId)->where('type',$type)->update([
            'name' => $fileName,
            'path' => $destinationPath,
            'type' => $type,
            'student_id' => $id,
            'attachment_id' => $attachmentId,
            'attachment_name' => $attachmentName,
            ]);
            
        return true;
    }
public static function updateStudentDocumentsProfile($file,$attachmentName=NULL,$type,$id=NULL,$attachmentId=NULL)
    {
        $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
        if($id != NULL){
            $destinationPath = 'uploads/student/'.$type.'/'.$id;
        }else{
            $destinationPath = 'uploads/student/'.$type.'/';
        }
        $file->move($destinationPath, $fileName);    
        $attachment = StudentAttachment::where('student_id',$id)->where('attachment_name',$attachmentName)->where('type',$type)->update([
            'name' => $fileName,
            'path' => $destinationPath,
            'type' => $type,
            'student_id' => $id,
            'attachment_id' => $attachmentId,
            'attachment_name' => $attachmentName,
            ]);
            
        return true;
    }
public static function agentImage()
    {
       if(Auth::guard('agent')->check()){
           $user = Auth::guard('agent')->user();
        }else{
            $user = Auth::guard('admin')->user();
        }
        if($user){
            $agentImage = Attachment::where('type','agent')->where('attachment_id',$user['id'])->first();
            return $agentImage;
        }else{
            
            return '';
        }
    }


}