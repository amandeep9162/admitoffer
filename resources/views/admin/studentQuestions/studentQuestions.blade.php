@extends('admin.layouts.admin') 
@section('content')
<div class="container">
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                Assigned Questions List &nbsp;
                    <span class="float-right">
                        <a href="{{route('studentQuestions.create')}}" class="btn btn-sm btn-success">Assign Question</a>
                    </span>
                </div>
                <div class="card-body">
                    @include('multiauth::message')
                    <table  data-order='[[ 0, "desc" ]]' class="mb-0 table tableID">
                        <thead>
                            <tr>
                                <th>Question</th> 
                                <th>Country</th> 
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="appendQualTest ">
                        @foreach ($studentQuestions as $studentQuestion)
                        
                        <tr>
                            <th scope="row">{{ $studentQuestion->question['question'] }}</th>
                            <td class="capitalize"> {{ $studentQuestion->country['name'] }} </td>
                            <td class="float-right">
                                <!-- <a href="#" class="btn btn-sm btn-secondary mr-3" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $studentQuestion->id }}').submit();">Delete</a>
                                <form id="delete-form-{{ $studentQuestion->id }}" action="{{ route('studentQuestions.destroy',[$studentQuestion->id]) }}" method="POST" style="display: none;">
                                    @csrf @method('delete')
                                </form> -->

                                <a href="{{route('studentQuestions.edit',base64_encode($studentQuestion->id))}}" class="btn btn-sm btn-info mr-3">Edit</a>
                            </td>
                        </tr>
                        @endforeach @if($studentQuestions->count()==0)
                        <p class="text-center">No Question created Yet.</p>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection