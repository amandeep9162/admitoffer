<?php

namespace App;

use App\Notifications\Agent\AgentResetPassword;
use App\Notifications\Agent\AgentVerifyEmail;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class Agent extends Authenticatable
{
    use SoftDeletes;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email','country_id','company_name','status','mobileno','account_manager','address','state_id','city_id', 'password','ip_address',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * Send the password reset notification.
     *
     * @param  string  $token
     * @return void
     */
    public function sendPasswordResetNotification($token)
    {
        $this->notify(new AgentResetPassword($token));
    }

    /**
     * Send the email verification notification.
     *
     * @return void
     */
    public function sendEmailVerificationNotification()
    {
        $this->notify(new AgentVerifyEmail);
    }

    public function city()
    {
        return $this->belongsTo('App\Models\Loc\City');
    } 
    public function state()
    {
        return $this->belongsTo('App\Models\Loc\State');
    } 
    public function country()
    {
        return $this->belongsTo('App\Models\Loc\Country');
    } 
    public function attachment()
    {
        return $this->belongsTo('App\Models\Attachment','id','attachment_id')->where('type','agent');;
    } 
    public function agentDocument()
    {
        return $this->belongsTo('App\Models\Attachment','id','attachment_id')->where('type','agentDocument');
    } 
    public function identity()
    {
        return $this->belongsTo('App\Models\Attachment','id','attachment_id')->where('type','identity');
    } 
    public function establishment()
    {
        return $this->belongsTo('App\Models\Attachment','id','attachment_id')->where('type','establishment');
    }
     public function contractfile()
    {
        return $this->belongsTo('App\Models\Attachment','id','attachment_id')->where('type','contractfile');
    } 
     public function accountManager()
    {
        return $this->belongsTo('Bitfumes\Multiauth\Model\Admin','account_manager','id');
    }
    public function studentsApp()
    {
        return $this->hasMany('App\Models\Agent\Student','agent_id','id');
    } 

}
