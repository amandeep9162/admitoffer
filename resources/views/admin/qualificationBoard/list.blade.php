@extends('admin.layouts.admin') 
@section('content')
<div class="container">
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                Qualification Board List &nbsp;
                    <span class="float-right">
                        <a href="{{route('qualificationBoard.create')}}" class="btn btn-sm btn-success">Add Qualification Board</a>
                    </span>
                </div>
                <div class="card-body">
                    @include('multiauth::message')
                    <ul class="list-group">
                        @foreach ($boards as $board)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $board->name }}
                            <div class="float-right">
                             

                                <a href="{{route('qualificationBoard.edit',base64_encode($board->id))}}" class="btn btn-sm btn-info mr-3">Edit</a>
                            </div>
                        </li>
                        @endforeach @if($boards->count()==0)
                        <p class="text-center">No Qualification Board created Yet.</p>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection