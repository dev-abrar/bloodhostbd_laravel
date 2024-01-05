@extends('layouts.dashboard')

@section('content')
    <div class="row mt-5">
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h3 style="width: 100%">Donation History<a class="float-right btn btn-success" href="{{route('donor.history.download', $donors->id)}}">Download</a></h3>
                    
                </div>
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th>Sl</th>
                            <th>Donor Name</th>
                            <th>Blood Group</th>
                            <th>Last Donation Date</th>
                            <th>Action</th>
                        </tr>
                        @forelse ($donor_info as $sl=> $donor )
                        <tr>
                           <td>{{$sl+1}}</td>
                           <td>{{$donor->rel_to_donor->name}}</td>
                           <td>{{$donor->rel_to_donor->rel_to_blood->blood_group}}</td>
                           <td>{{$donor->donate_date}}</td>
                           <td>
                           
                            <a class=" btn btn-danger" href="{{route('donor.history.delete', $donor->id)}}">Delete</a>
                           </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="5" style="width: 100%; text-align:center">

                                        <Strong class="text-danger text-center">He Has not Donated Yet !</Strong>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </table>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3>Add last Donate Date</h3>
                </div>
                <div class="card-body">
                    <form action="{{route('donor.history.store')}}" method="POST">
                        @csrf
                        <div class="mt-3">
                            <label for="">Donate Date</label>
                            <input type="hidden" class="form-control" name="donor_id" value="{{$donors->id}}">
                            <input type="date" class="form-control" name="donate_date" >
                            @error('donate_date')
                                <strong class="text-danger">{{$message}}</strong>
                            @enderror
                        </div>
                        <div class="mt-3">
                            <button type="submit" class="btn btn-info">Add last Date</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection