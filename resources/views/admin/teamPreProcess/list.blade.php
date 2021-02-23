@extends('admin.layouts.admin') 
@section('content')
<div class="container-fluid">
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                 PreProcesses List &nbsp;
                    <span class="float-right">
                        <!-- <a href="{{route('teamPreProcess.create')}}" class="btn btn-sm btn-success">Add New PreProcesses</a> -->
                    </span>
                </div>
                <div class="card-body">
                    @include('multiauth::message')
                    <ul class="list-group">
                        <li class="list-group-item ">
                            <div class="row ">
                                <div class="capitalize col-md-3">
                                    <label><strong>Pre Processor</strong></label>
                                </div>
                                <div class="col-md-8 text-center">
                                    <div class="row">
                                       <label><strong>Processor</strong></label>
                                    </div>
                                </div>
                                <div class="float-right col-md-1">
                                    <label><strong>Action</strong></label>
                                </div>
                            </div>
                        </li>
                        @foreach ($preProcesses[0] as $preProcess)
                            <?php
                             $assignedProcessAry = [];
                            ?>
                        @foreach($teamPreProcesses as $teamPreProcess)
                        @if($teamPreProcess['preProcess_id'] == (string)$preProcess['id'])
                        <?php
                        $assignedProcessAry[] = $teamPreProcess['process_id'];
                        ?>       
                            @endif
                        @endforeach
                        <form method="POST" action="{{route('teamPreProcess.store')}}">
                            @csrf
                        <li class="list-group-item ">
                            <div class="row">
                                <div class="capitalize col-md-3"><strong>{{ $preProcess->name }}</strong>
                                    <input type="hidden" name="preProcess_id" value="{{ $preProcess->id }}">
                                </div>
                                <div class="col-md-8">
                                    <div class="row">
                                        @foreach($process[0] as $proc)
                                            <div class="col-md-3">
                                                <input type="checkbox" class="capitalize"  name="process[]" value="{{$proc['id']}}"  <?php if(in_array($proc['id'],$assignedProcessAry)){?> checked="checked"<?php }?>  ><span>{{$proc['name']}}</span>
                                            </div>
                                        
                                        @endforeach
                                    </div>
                                </div>
                                <div class="float-right col-md-1">
                                    <!-- <a href="#" class="btn btn-sm btn-secondary mr-3" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $preProcess->id }}').submit();">Delete</a>
                                    <form id="delete-form-{{ $preProcess->id }}" action="{{ route('teamPreProcess.destroy',[$preProcess->id]) }}" method="POST" style="display: none;">
                                        @csrf @method('delete')
                                    </form> -->

                                    <button class="btn btn-sm btn-success mr-3">Assign</button>
                                </div>
                            </div>
                        </li>
                        </form>
                        @endforeach @if($preProcesses[0]->count()==0)
                        <p class="text-center">No Team Pre Processes created Yet.</p>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection