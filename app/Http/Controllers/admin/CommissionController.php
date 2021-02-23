<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Commission;

class CommissionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
      $commission =  Commission::where('country_id',$id)->first();
        return view('admin.commission.edit',compact('commission'));
    }
    public function createentryrequirement()
    {
      $requirements =  Commission::where('id',2)->first();

        return view('admin.entryRequirement.edit',compact('requirements'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $hasCommission = Commission::where('country_id',$request->country)->where('type',$request->type)->first();
        if($hasCommission){

            $commission = Commission::where('country_id',$request->country)->where('type',$request->type)->update(['commission'=>$request->commission]);
        }else{
            $commission = Commission::create(['commission'=>$request->commission,'country_id',$request->country,'type',$request->type]);

        }

        return back();
    }
    public function requirementsStore(Request $request)
    {
        $requirement = Commission::where('id',2)->update(['commission'=>$request->requirement]);

        return back();      
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
