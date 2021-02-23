<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Agent;
use App\Models\TaskManager;
use Bitfumes\Multiauth\Model\Admin;
use Bitfumes\Multiauth\Model\Role;
use Auth;
use Session;
use Carbon;

class TaskManagerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $admin = Auth::guard('admin')->user();
        $tasks = TaskManager::with('agent')->where('status','0')->where('account_manager_id',$admin['id'])->whereDate('next_followup',Carbon\Carbon::today())->get();
        $pendingTasks = TaskManager::with('agent')->where('status','0')->where('account_manager_id',$admin['id'])->whereDate('next_followup','<',Carbon\Carbon::today())->get();
        $upcomingTasks = TaskManager::with('agent')->where('account_manager_id',$admin['id'])->whereDate('next_followup','>',Carbon\Carbon::today())->get();
        $totalTasks = TaskManager::with('agent')->where('account_manager_id',$admin['id'])->get();
        $completedTask = TaskManager::with('agent')->where('status','1')->where('account_manager_id',$admin['id'])->get();
        $getAdmin = Admin::where('id',$admin['id'])->first();
        return view('admin.taskManager.view',compact('getAdmin','tasks','totalTasks','pendingTasks','upcomingTasks','completedTask'));
    }
    public function adminindex()
    {

        $admins = Admin::with('roles')->get();
        $adminsArray = [];
        foreach ($admins as $key => $value) {
            if ($value->roles[0]['id'] == 5 ) {
        
                $adminsArray[] = $value;
                            
            }            
        }


        return view('admin.taskManager.accountview',compact('adminsArray'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $task='';
        $isAddNew = 'yes';
        $admin = Auth::guard('admin')->user();
        $agents = Agent::get();
         if ($admin->roles[0]['name'] == 'account manager')
        {
            $agents = Agent::where('account_manager', $admin['id'])->get();
        }   
        return view('admin.taskManager.add',compact('agents','task','isAddNew'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $admin = Auth::guard('admin')->user();
        if($request->isAddNew == 'no'){
        
                TaskManager::where('id',$request->taskId)->Update(['status'=>'1']);
            
        TaskManager::create(['agent_id' =>$request->agent_id,'activity' =>$request->activity,'details' =>$request->details,'next_followup' => $request->nextFollowUp,'account_manager_id'=>$admin['id']]);
        }else{

            TaskManager::create(['agent_id' =>$request->agent,'activity' =>$request->activity,'details' =>$request->details,'next_followup' => $request->nextFollowUp,'account_manager_id'=>$admin['id']]);
        }
        Session::flash('success','New task saved');
        return redirect()->route('taskmanager.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $id = base64_decode($id);
        $isAddNew = 'no';
        TaskManager::where('id',$id)->Update(['status'=>'1']);
        $task = TaskManager::where('id',$id)->first();
        $admin = Auth::guard('admin')->user();
        $agents = Agent::get();
         if ($admin->roles[0]['name'] == 'account manager')
        {
            $agents = Agent::where('account_manager', $admin['id'])->get();
        }   
        return view('admin.taskManager.add',compact('agents','task','isAddNew'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $id = base64_decode($id);

        $tasks = TaskManager::with('agent')->where('status','0')->where('account_manager_id',$id)->whereDate('next_followup',Carbon\Carbon::today())->get();
        $pendingTasks = TaskManager::with('agent')->where('status','0')->where('account_manager_id',$id)->whereDate('next_followup','<',Carbon\Carbon::today())->get();
        $upcomingTasks = TaskManager::with('agent')->where('account_manager_id',$id)->whereDate('next_followup','>',Carbon\Carbon::today())->get();
        $totalTasks = TaskManager::with('agent')->where('account_manager_id',$id)->get();
        $completedTask = TaskManager::with('agent')->where('status','1')->where('account_manager_id',$id)->get();
        $getAdmin = Admin::where('id',$id)->first();
        return view('admin.taskManager.view',compact('getAdmin','tasks','totalTasks','pendingTasks','upcomingTasks','completedTask'));
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
