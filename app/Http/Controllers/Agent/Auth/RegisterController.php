<?php

namespace App\Http\Controllers\Agent\Auth;

use App\Agent;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use App\Models\Loc\Country;
use App\Models\Loc\State;
use App\Models\Loc\City;
use Session;
use Mail;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new admins as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/agent';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       $this->middleware('agent.guest:agent');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:agents',
            'country_id' => 'required',
            'state_id' => 'required',
            'city_id' => 'required',
            'password' => 'required|min:6|confirmed',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\Agent
     */
    protected function create(array $data)
    {   
         Agent::create([
            'name' => $data['name'],
            'email' => $data['email'],
            
            'password' => bcrypt($data['password']),
        ]);
        Session::flash('success','New Agent created');
        return back();
    }

    /**
     * Show the application registration form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showRegistrationForms()
    {

        
        
         \Artisan::call('config:clear');
         \Artisan::call('cache:clear');
         \Artisan::call('view:clear');
         \Artisan::call('route:clear');
        // $datas = Agent::where('id',198)->first()->toArray();
        //   $mail =  Mail::send('emails.newApplication',$datas, function($message) use ($datas) {
        //             $message->to('uk@admitoffer.com');
        //             $message->subject('New Applicatons sent by'.$datas['name']);
        //             $message->from('himashu@admitoffer.com','ADMITOFFER');
        //         });


        // $data = Agent::where('id',198)->first()->toArray();
        //         $mail =  Mail::send('emails.contractEvent', $data, function($message) use ($data) {
        //             $message->to($data['email']);
        //             $message->subject('Registed Successfully');
        //             $message->from('uk@admitoffer.com','ADMITOFFER');
        //         });
        $countries = Country::all();

        return view('agent.auth.AgentRegister',compact('countries'));
    } 
   

    /**
     * Get the guard to be used during registration.
     *
     * @return \Illuminate\Contracts\Auth\StatefulGuard
     */
    protected function guard()
    {
        return Auth::guard('agent');
    }

}