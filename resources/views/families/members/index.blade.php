@extends('layouts.app')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

  <!-- Main content -->
  <section class="content">

     <div class="container-fluid mt-4">
      <div class="pull-right mb-2">
       <a href="{{ route('family-members.create',$id) }}" class="add btn btn-sm btn-warning">Add Family Member</a>
      </div>
      @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
      @endif
      <table class="table table-bordered data-table" id="datatable-head-families">
        <thead>
            <tr>
                <th>Name</th>
                 <th>Photo</th>
                <th>Birthday</th>
                <th>Marital status</th>
                <th>Wedding date</th>
                <th>Education</th> 
            </tr>
        </thead>
        <tbody>
            @foreach ($family_member as $member)
            <tr role="row" class="odd">
                <td>{{$member->name}}</td>
                <td>
                    @if(!empty($member->photo))
                        <img src="{{ asset('images/family/' . $member->photo) }}" alt="Member Photo" width="90">
                    @else
                        <!-- Display something if the photo doesn't exist or is empty -->
                    @endif
                </td>
                <td>{{$member->birthdate}}</td>
                <td>{{$member->marital_status}}</td>
                <td>{{$member->wedding_date}}</td>
                <td>{{$member->education}}</td>
                
            </tr>
            @endforeach
        </tbody>
    </table>
  </div> 
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
