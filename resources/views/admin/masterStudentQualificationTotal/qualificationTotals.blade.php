@extends('admin.layouts.admin') 
@section('content')
<div class="container-fluid">
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                Qualification List &nbsp;
                    <span class="float-right">
                        <a href="{{route('qualificationTotals.create')}}" class="btn btn-sm btn-success">Add New Qualification</a>
                    </span>
                </div>
                <div class="card-body">
                    @include('multiauth::message')
                    <table  data-order='[[ 0, "desc" ]]' class="mb-0 table tableID">
                        <thead>
                            <tr>
                                <th>Qualification Grade/%</th> 
                                <th>Type</th> 
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="appendQualTest ">
                        @foreach ($qualificationTotals as $qualificationTotal)
                        
                        <tr>
                            <th scope="row">{{ $qualificationTotal->name }}</th>
                            <td class="capitalize">  {{ $qualificationTotal->type }}</td>
                            <td class="float-right">
                                <!-- <a href="#" class="btn btn-sm btn-secondary mr-3" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $qualificationTotal->id }}').submit();">Delete</a>
                                <form id="delete-form-{{ $qualificationTotal->id }}" action="{{ route('qualificationTotals.destroy',[$qualificationTotal->id]) }}" method="POST" style="display: none;">
                                    @csrf @method('delete')
                                </form> -->

                                <a href="{{route('qualificationTotals.edit',base64_encode($qualificationTotal->id))}}" class="btn btn-sm btn-info mr-3">Edit</a>
                            </td>
                        </tr>
                        @endforeach @if($qualificationTotals->count()==0)
                        <p class="text-center">No Qualification Totals created Yet.</p>
                        @endif
                        </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection