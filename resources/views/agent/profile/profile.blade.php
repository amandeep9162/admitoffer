@extends('agent.layouts.app')
@section('content')
<style>
    .card{
    margin:10px;
    }
</style>
<div class="container-fluid">
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">My Account</div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="SviewPage">
                                    @if($agent->attachment)
                                    <img src="{{asset($agent->attachment['path']."/".$agent->attachment['name'])}}">
                                    @else
                                    <img  src="{{asset('images/site/user-img.png')}}" alt="your image" />
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div id="toastTypeGroup" class="strongColor">
                                <div class="row padd-5-bb-1 capitalize">
                                    <div class="col-md-6 " >
                                        <strong>Company: </strong>
                                    </div>
                                    <div class="col-md-6 " >
                                        <h5 class="capitalize"><span class="colorBgYellow">{{$agent['company_name']}}</span></h5>
                                    </div>
                                </div>
                                <div class="row padd-5-bb-1 capitalize">
                                    <div class="col-md-6 " >
                                        <strong>Name: </strong>
                                    </div>
                                    <div class="col-md-6 " >
                                        {{$agent['name']}}
                                    </div>
                                </div>
                                <div class="row padd-5-bb-1">
                                    <div class="col-md-6 " >
                                        <strong>Email: </strong>
                                    </div>
                                    <div class="col-md-6 " >
                                        {{$agent['email']}}
                                    </div>
                                </div>
                                <div class="row padd-5-bb-1">
                                    <div class="col-md-6 " >
                                        <strong>Mobile : </strong>
                                    </div>
                                    <div class="col-md-6 " >
                                        {{$agent['mobileno']}}
                                    </div>
                                </div>
                                <div class="row padd-5-bb-1">
                                    <div class="col-md-6 " >
                                        <strong>Location: </strong>
                                    </div>
                                    <div class="col-md-6 " >
                                        {{$agent->city['name']}},{{$agent->state['name']}},{{$agent->country['name']}}
                                    </div>
                                </div>
                                <div class="row padd-5-bb-1">
                                    <div class="col-md-6 " >
                                        <strong>Admit Offer Agreement: </strong>
                                    </div>
                                    <div class="col-md-6 " >
                                         @if($agent->contractfile['path'])
                                        <a href="{{asset($agent->contractfile['path']."/".$agent->contractfile['name'])}}" target="_blank" download>Download Agreement</a>
                                         @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('addjavascript')
<noscript>
    <script src="{{ asset('js/app.js') }}" ></script>
</noscript>
@endsection