<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Loc\Country;
use App\Models\Loc\State;
use App\Models\Loc\City;
use Validator;
use Session;
class LocationController extends Controller
{
    //countries list
    public function countryList(){
        $countries =Country::all();
        return view('admin.location.countriesList',compact('countries'));
    }
    // country page view
    public function addCountry(){
        return view('admin.location.addCountry');
    }
    //add new country
    public function saveCountry(Request $request){
        $validator =  $this->validate($request,
            ['name' => 'required|unique:loc_countries|min:2',
            'shotcode' => 'required|max:8',
            'nationality' => 'required',
            ]
        );
        $file = $request->flag;
        $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
        $destinationPath = 'uploads/country/flag/';
        
        $file->move($destinationPath, $fileName);    
        
        $request['image_name'] = $fileName;
        $request['path'] = $destinationPath;
        
        $currencyfile = $request->currencyIcon;
        $currencyfileName = md5($currencyfile->getClientOriginalName() . time()) . "." . $currencyfile->getClientOriginalExtension();
        $currencydestinationPath = 'uploads/country/flag/';
        
        $currencyfile->move($currencydestinationPath, $currencyfileName);    
        // dd($request->all());
        $request['currency_icon_name'] = $request->currencyIcon;
        $request['currency_icon_path'] = $currencydestinationPath;
        Country::create($request->all());
        Session::flash('success','New Country created');
        return back();
    }
    //Edit country
    public function countryEdit($id){
        $id = base64_decode($id);
        $country = Country::where('id',$id)->first();
        return view('admin.location.editCountry',compact('country'));
    }
    //Update country
        public function countryUpdate(Request $request,$id){
            // dd($id);
            // $id = base64_decode($id);
            // dd($request->all());
            $validator =  $this->validate($request,
            ['name' => 'required|min:2',
            'shotcode' => 'required|max:8',
            'nationality' => 'required',
            ]
        );
        $country = Country::where('id',$id)->first();
        if($request->has('flag')){
        $file = $request->flag;
        $fileName = md5($file->getClientOriginalName() . time()) . "." . $file->getClientOriginalExtension();
        $destinationPath = 'uploads/country/flag/';
        
        $file->move($destinationPath, $fileName);    
        }else{
            $fileName = $country['image_name'];
            $destinationPath = $country['path'];
        }
        if($request->has('flag')){
        $currencyfile = $request->currencyIcon;
        $currencyfileName = md5($currencyfile->getClientOriginalName() . time()) . "." . $currencyfile->getClientOriginalExtension();
        $currencydestinationPath = 'uploads/country/flag/';
        
        $currencyfile->move($currencydestinationPath, $currencyfileName);
        }else{
            $currencyfileName = $country['currency_icon_name'];
            $currencydestinationPath = $country['currency_icon_path'];
        }
        Country::where('id',$id)->update([
            'name'=>$request->name,
            'shotcode'=>$request->shotcode,
            'nationality'=>$request->nationality,
            'currency'=>$request->currency,
            'image_name'=>$fileName,
            'path'=>$destinationPath,
            'currency_icon_name'=>$request->currencyIcon,
            'currency_icon_path'=>$currencydestinationPath,
            ]);
            Session::flash('success','New Country updated');
            return back();
        }
        //delete country
        public function countryDelete($id){
            Country::where('id',$id)->delete();
            Session::flash('success','New Country Deleted');
            return back();
        }
        
    //State code start
        
        //states list
        public function statesList(){
            $states =State::all();
            return view('admin.location.statesList',compact('states'));
        }
        // state page view
        public function addState(){
            $countries =Country::all();
            return view('admin.location.addState',compact('countries'));
        }
        //add new state
        public function saveState(Request $request){
            $validator =  $this->validate($request,
            ['name' => 'required|unique:loc_states|min:2',
            'country_id' => 'required',
            ]
            );
            State::create($request->all());
            Session::flash('success','New State created');
            return back();
        }
            //Edit state
            public function stateEdit($id){
                $id = base64_decode($id);
            $countries =Country::all();
            $state = State::where('id',$id)->first();
            return view('admin.location.editState',compact('state','countries'));
        }
        //Update state
        public function stateUpdate(Request $request,$id){
            // $id = base64_decode($id);
            $validator =  $this->validate($request,
            ['name' => 'required|min:2',
            'country_id' => 'required',
            ]
        );
        State::where('id',$id)->update([
            'name'=>$request->name,
            'country_id'=>$request->country_id,
            ]);
            Session::flash('success','New State updated');
            return back();
        }
        //delete state
        public function stateDelete($id){
            State::where('id',$id)->delete();
            Session::flash('success','New State Deleted');
            return back();
        }
        //City code start
        
        //cities list
        public function citiesList(){
            ini_set('memory_limit', '-1');
            $cities =City::all();
            return view('admin.location.citiesList',compact('cities'));
        }
        // city page view
        public function addCity(){
            
            $countries =Country::all();
           
            
            return view('admin.location.addCity',compact('countries'));
        }
        //add new city
        public function saveCity(Request $request){
            $validator =  $this->validate($request,
            ['name' => 'required|unique:loc_cities|min:2',
            'country_id' => 'required',
            'state_id' => 'required',
            ]
            );
            City::create($request->all());
            Session::flash('success','New City created');
            return back();
        }
        //Edit city
        public function cityEdit($id){
            $id = base64_decode($id);
        $countries =Country::all();
        $state = State::all();
        $city = City::where('id',$id)->first();
        // dd($city['country_id']);
        $state = State::where('country_id',$city['country_id'])->get();

        return view('admin.location.editCity',compact('state','countries','city'));
        }
        //Update city
        public function cityUpdate(Request $request,$id){
            $validator =  $this->validate($request,
            ['name' => 'required|min:2',
            'country_id' => 'required',
            'state_id' => 'required',
            ]
            );
            // $id = base64_decode($id);
            City::where('id',$id)->update([
                                            'name'=>$request->name,
                                            'state_id'=>$request->state_id,
                                                ]);
            Session::flash('success','New City updated');
            return back();
        }
        //delete city
        public function cityDelete($id){
            City::where('id',$id)->delete();
            Session::flash('success','New City Deleted');
            return back();
        }
        //ajax responce getState
        public function getState($id){
            $state = State::where('country_id',$id)->get();
            return $state;
        }
        //ajax responce getCity
        public function getCity($id){
            $city = City::where('state_id',$id)->get();
            return $city;
        }
}
