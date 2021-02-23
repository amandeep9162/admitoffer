@extends('admin.layouts.admin') 
@section('content')
<style type="text/css">
    .metric-row {
    margin-bottom: 1.25rem;
    border-radius: .25rem;
    align-items: stretch;
    display: flex;
    flex-wrap: wrap;
    margin-right: -10px;
    margin-left: -10px;
}
.metric-flush {
    margin: .5rem -1px .5rem 1px;
}
.metric-row {
    margin-bottom: 1.25rem;
    border-radius: .25rem;
    align-items: stretch;
    display: flex;
    flex-wrap: wrap;
    margin-right: -10px;
    margin-left: -10px;
}
.metric-bordered {
    border: 1px solid #d6d8e1;
}
.metric {
    position: relative;
    padding: 1rem;
    display: flex;
    flex-direction: column;
    justify-content: center;
    flex-grow: 1;
    max-width: 100%;
    border-radius: .25rem;
    cursor: default;
}
.align-items-center {
    align-items: center!important;
}
.metric-label:first-child {
    margin-bottom: .5rem;
}

.metric-label {
    font-size: .875rem;
    font-weight: 500;
    color: #888c9b;
    white-space: nowrap;
}
a{
    color:#dd3c35 !important;
}
a:hover{
    color: #ff0b00 !important;
}
</style>
<div class="container-fluid">
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                To Do List &nbsp;
                    <span class="float-right">
                        <a href="{{route('taskmanager.create')}}" class="btn btn-sm btn-success">Add New Task</a>
                    </span>
                </div>
                <div class="card-body">
                    @include('multiauth::message')
                    <div class="page-inner">
              <!-- .page-title-bar -->
              <header class="page-title-bar">
                <div class="d-flex flex-column flex-md-row">
                  <p class="lead">
                    <?php
                        $user = auth('admin')->user();
                    ?>
                    <span class="font-weight-bold">Hi, {{$getAdmin['name']}}.</span> <span class="d-block text-muted">Here’s what’s happening with your business today.</span>
                  </p>
                
                </div>
              </header><!-- /.page-title-bar -->
              <!-- .page-section -->
              <div class="page-section">
                <!-- .section-block -->
                <div class="section-block">
                  <!-- metric row -->
                  <div class="metric-row">
                    <div class="col-lg-9">
                      <div class="metric-row metric-flush">
                        <!-- metric column -->
                        <div class="col">
                          <!-- .metric -->
                          <a href="#" class="metric metric-bordered align-items-center">
                            <h2 class="metric-label"> Total Tasks </h2>
                            <p class="metric-value h3">
                              <sub><i class="oi oi-people"></i></sub> <span class="value">{{$totalTasks->count()}}</span>
                            </p>
                          </a> <!-- /.metric -->
                        </div><!-- /metric column -->
                        <!-- metric column -->
                        <div class="col">
                          <!-- .metric -->
                          <a href="#" class="metric metric-bordered align-items-center">
                            <h2 class="metric-label"> Today Tasks </h2>
                            <p class="metric-value h3">
                              <sub><i class="oi oi-fork"></i></sub> <span class="value">{{$tasks->count()}}</span>
                            </p>
                          </a> <!-- /.metric -->
                        </div><!-- /metric column -->
                        <!-- metric column -->
                        <div class="col">
                          <!-- .metric -->
                          <a href="#" class="metric metric-bordered align-items-center">
                            <h2 class="metric-label"> Pending Tasks </h2>
                            <p class="metric-value h3">
                              <span class="value">{{$pendingTasks->count()}}</span>
                            </p>
                          </a> <!-- /.metric -->
                        </div><!-- /metric column -->
                      </div>
                    </div><!-- metric column -->
                    <div class="col-lg-3">
                      <!-- .metric -->
                      <a href="#" class="metric metric-bordered">
                        <div class="metric-badge">
                          <span class="badge badge-lg badge-success"><span class="oi oi-media-record pulse mr-1"></span> UPCOMING TASKS</span>
                        </div>
                        <p class="metric-value h3">
                          <sub><i class="oi oi-timer"></i></sub> <span class="value">{{$upcomingTasks->count()}}</span>
                        </p>
                      </a> <!-- /.metric -->
                    </div><!-- /metric column -->
                  </div><!-- /metric row -->
                </div><!-- /.section-block -->
                <div class="section-block">
                  <!-- metric row -->
                  <div class="metric-row">
                    <div class="col-lg-9">
                      <div class="metric-row metric-flush">
                        <!-- metric column -->
                        <div class="col">
                          <!-- .metric -->
                          <a href="#" class="metric metric-bordered align-items-center">
                            <h2 class="metric-label"> Completed tasks </h2>
                            <p class="metric-value h3">
                              <sub><i class="oi oi-people"></i></sub> <span class="value">{{$completedTask->count()}}</span>
                            </p>
                          </a> <!-- /.metric -->
                        </div><!-- /metric column -->
                        <!-- metric column -->
                      <!--   <div class="col">
                          <a href="#" class="metric metric-bordered align-items-center">
                            <h2 class="metric-label"> Today Tasks </h2>
                            <p class="metric-value h3">
                              <sub><i class="oi oi-fork"></i></sub> <span class="value">{{$tasks->count()}}</span>
                            </p>
                          </a> 
                        </div>
                        
                        <div class="col">
                          <a href="#" class="metric metric-bordered align-items-center">
                            <h2 class="metric-label"> Pending Tasks </h2>
                            <p class="metric-value h3">
                              <sub><i class="fa fa-tasks"></i></sub> <span class="value">{{$pendingTasks->count()}}</span>
                            </p>
                          </a> 
                        </div> -->
                      </div>
                    </div>
                  <!--   <div class="col-lg-3">
                      <a href="#" class="metric metric-bordered">
                        <div class="metric-badge">
                          <span class="badge badge-lg badge-success"><span class="oi oi-media-record pulse mr-1"></span> UPCOMING TASKS</span>
                        </div>
                        <p class="metric-value h3">
                          <sub><i class="oi oi-timer"></i></sub> <span class="value">{{$upcomingTasks->count()}}</span>
                        </p>
                      </a> 
                    </div> -->
                  </div><!-- /metric row -->
                </div><!-- /.section-block -->
                <!-- grid row -->
                  <!-- grid column -->
                    <!-- .card -->
                    <div class="row" style="margin-bottom: 70px">
                <div class="col-md-6 card-deck-xl" >
                  <!-- .card -->
                  <div class="card card-fluid pb-3">
                    <div class="card-header"> Today Tasks </div><!-- .lits-group -->
                    <div class="lits-group list-group-flush" style="overflow-y: scroll;height: 500px;">
                    <?php
                    $i = 1;
                    ?>
                    @foreach($tasks as $key=> $task)

                     <div class="list-group-item">
                        <!-- .lits-group-item-figure -->
                        <div class="list-group-item-figure">
                          <div class="has-badge">
                            <a href="#" class="tile tile-md bg-purple">{{ $task->activity}}</a> <a href="#team" class="user-avatar user-avatar-xs"><img src="assets/images/avatars/team4.jpg" alt=""></a>
                          </div>
                        </div><!-- .lits-group-item-figure -->
                        <!-- .lits-group-item-body -->
                        <div class="list-group-item-body">
                          @if($task['agent_id'])
                          <h5 class="card-title">
                            <a href="#">{{ $task->agent->name}}</a>
                          </h5>
                          @endif
                          <p class="card-subtitle text-muted mb-1"> {{ $task->details}} </p><!-- .progress -->
                              <span class="">{{  date('d-M-y', strtotime( $task->next_followup))}}</span>
                         <a href="{{route('taskmanager.show',base64_encode($task['id']))}}" class="btn btn-success float-right">Complete Task</a>
                        </div><!-- .lits-group-item-body -->
                      </div>


                    @endforeach
               
                </div><!-- /grid row -->
                </div><!-- /grid row -->
                </div><!-- /grid row -->
                <!-- card-deck-xl -->
                <div class="col-md-6 card-deck-xl" >
                  <!-- .card -->
                  <div class="card card-fluid pb-3">
                    <div class="card-header"> Completed Tasks </div><!-- .lits-group -->
                    <div class="lits-group list-group-flush" style="overflow-y: scroll;height: 500px;">
                      <!-- .lits-group-item -->
                      @foreach($completedTask as $completedTsk)
                      <div class="list-group-item">
                        <!-- .lits-group-item-figure -->
                        <div class="list-group-item-figure">
                          <div class="has-badge">
                            <a href="#" class="tile tile-md bg-purple">{{ $completedTsk->activity}}</a> <a href="#team" class="user-avatar user-avatar-xs"><img src="assets/images/avatars/team4.jpg" alt=""></a>
                          </div>
                        </div><!-- .lits-group-item-figure -->
                        <!-- .lits-group-item-body -->
                        <div class="list-group-item-body">
                          @if($completedTsk['agent_id'])
                          <h5 class="card-title">
                            <a href="#">{{ $completedTsk->agent->name}}</a>
                          </h5>
                          @endif
                          <p class="card-subtitle text-muted mb-1"> {{ $completedTsk->details}} </p><!-- .progress -->
                              <span class="">{{  date('d-M-y', strtotime($completedTsk->next_followup))}}</span>
                         
                        </div><!-- .lits-group-item-body -->
                      </div><!-- /.lits-group-item -->
                      @endforeach
                     
                   
                   
                    </div><!-- /.lits-group -->
                  </div><!-- /.card -->
                </div><!-- /card-deck-xl -->
                </div><!-- /card-deck-xl -->
                <div class="row">
                <div class="col-md-6 card-deck-xl">
                  <!-- .card -->
                  <div class="card card-fluid pb-3">
                    <div class="card-header"> Pending Tasks </div><!-- .lits-group -->
                    <div class="lits-group list-group-flush" style="overflow-y: scroll;height: 500px;">
                      <!-- .lits-group-item -->
                      @foreach($pendingTasks as $pendingTask)
                      <div class="list-group-item">
                        <!-- .lits-group-item-figure -->
                        <div class="list-group-item-figure">
                          <div class="has-badge">
                            <a href="#" class="tile tile-md bg-purple">{{ $pendingTask->activity}}</a> <a href="#team" class="user-avatar user-avatar-xs"><img src="assets/images/avatars/team4.jpg" alt=""></a>
                          </div>
                        </div><!-- .lits-group-item-figure -->
                        <!-- .lits-group-item-body -->
                        <div class="list-group-item-body">
                          @if($pendingTask['agent_id'])
                          <h5 class="card-title">
                            <a href="#">{{ $pendingTask->agent->name}}</a>
                          </h5>
                          @endif
                          <p class="card-subtitle text-muted mb-1"> {{ $pendingTask->details}} </p><!-- .progress -->
                              <span class="">{{  date('d-M-y', strtotime($pendingTask->next_followup))}}</span>
                         <a href="{{route('taskmanager.show',base64_encode($pendingTask['id']))}}" class="btn btn-success float-right">Complete Task</a>
                        </div><!-- .lits-group-item-body -->
                      </div><!-- /.lits-group-item -->
                      @endforeach
                     
                   
                   
                    </div><!-- /.lits-group -->
                  </div><!-- /.card -->
                </div>
                <div class="col-md-6 card-deck-xl">
                  <!-- .card -->
                  <div class="card card-fluid pb-3">
                    <div class="card-header"> Total Tasks </div><!-- .lits-group -->
                    <div class="lits-group list-group-flush" style="overflow-y: scroll;height: 500px;">
                      <!-- .lits-group-item -->
                      @foreach($totalTasks as $totalTask)
                      <div class="list-group-item">
                        <!-- .lits-group-item-figure -->
                        <div class="list-group-item-figure">
                          <div class="has-badge">
                            <a href="#" class="tile tile-md bg-purple">{{ $totalTask->activity}}</a> <a href="#team" class="user-avatar user-avatar-xs"><img src="assets/images/avatars/team4.jpg" alt=""></a>
                          </div>
                        </div><!-- .lits-group-item-figure -->
                        <!-- .lits-group-item-body -->
                        <div class="list-group-item-body">
                          @if($totalTask['agent_id'])
                          <h5 class="card-title">
                            <a href="#">{{ $totalTask->agent->name}}</a>
                          </h5>
                          @endif
                          <p class="card-subtitle text-muted mb-1"> {{ $totalTask->details}} </p><!-- .progress -->
                              <span class="">{{  date('d-M-y', strtotime($totalTask->next_followup))}}</span>
                         
                        </div><!-- .lits-group-item-body -->
                      </div><!-- /.lits-group-item -->
                      @endforeach
                     
                   
                   
                    </div><!-- /.lits-group -->
                  </div><!-- /.card -->
                </div>
                </div>
              </div><!-- /.page-section -->
            </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection