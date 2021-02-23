<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\TeamPreProcess;
use Bitfumes\Multiauth\Model\Admin;
use Bitfumes\Multiauth\Model\Role;
use Validator;
use Session;

class TeamPreProcessController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $teamPreProcesses = TeamPreProcess::get();
        $preProcessesList = Role::with(['admins'=>function($q){
            $q->with('teamProcess')->get();
        }])->get();
        $preProcesses = [];
        $process = [];
        
        foreach($preProcessesList as $preProcess){
            if($preProcess['id'] == '3'){
                $preProcesses[] = $preProcess->admins;
            }
            if($preProcess['id'] == '4'){
                $process[] = $preProcess->admins;
            }
        }
        
        return view('admin.teamPreProcess.list',compact('preProcesses','process','teamPreProcesses'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $teamPreProcesses = TeamPreProcess::all();
        return view('admin.teamPreProcess.list',compact('teamPreProcesses'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        TeamPreProcess::where('preProcess_id', $request->preProcess_id)->forceDelete();
        foreach($request->process as $process){

            TeamPreProcess::create([
                'preProcess_id' => $request->preProcess_id,
                'process_id' => $process,
                ]);
        }
        Session::flash('success','Assign Process to PreProcess');
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
