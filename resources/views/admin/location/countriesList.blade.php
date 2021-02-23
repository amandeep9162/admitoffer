@extends('admin.layouts.admin') 
@section('content')
<div class="container-fluid">
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Countries List &nbsp;
                    <span class="float-right">
                        <a href="{{route('admin.addCountry')}}" class="btn btn-sm btn-success">Add New Country</a>
                    </span>
                </div>
                <div class="card-body">
                    @include('multiauth::message')
                    <table  data-order='[[ 0, "desc" ]]' class="mb-0 table tableID">
                        <thead>
                            <tr>
                                <th>Country</th> 
                                <th>Flag</th> 
                                <th>Icons</th> 
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="appendQualTest ">
                            @foreach ($countries as $country)
                            <tr>
                            <th scope="row">{{ $country->name }}</th>
                           
                                <td class="capitalize" width="50%" ><img src="{{asset($country->path.'/'.$country['image_name']) }}" style="width: 20px;height: 20px" > </td>
                            
                            
                                <td class="badge badge-warning badge-pill mt-10"><img src="{{asset($country->currency_icon_path.'/'.$country['currency_icon_name']) }}" style="width: 20px;height: 20px" > </td>

                                <td class="capitalize"><a href="{{route('admin.country.edit',base64_encode($country->id))}}"  class="btn btn-sm btn-info mr-3">Edit</a></td>
                        
                            </tr>
                        @endforeach
                         @if($countries->count()==0)
                        <p class="text-center">No Country created Yet.</p>
                        @endif
                        
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection