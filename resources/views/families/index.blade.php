@extends('layouts.app')
@section('content')
<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">

  <!-- Main content -->
  <section class="content">

     <div class="container-fluid mt-4">
      <div class="pull-right mb-2">
      <a class="btn btn-success" href="{{ route('families.create') }}"> Create Families</a>
      </div>
      @if(session('status'))
        <div class="alert alert-success">
            {{ session('status') }}
        </div>
      @endif
      <table class="table table-bordered data-table" id="datatable-head-families">
        <thead>
            <tr>

                <!-- <th>id</th> -->
                <th>Name</th>
                 <th>Photo</th>
                <th>Sirname</th>
                <th>Birthday</th>
                <th>Total Family Members</th>
                <!-- <th>City</th>
                <th>Pincode</th>
                <th>MaritalStatus</th>
                <th>WeddingDate</th> -->
                <!-- <th>Created Date</th> -->
                <th width="100px">Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($families as $family)
            <tr role="row" class="odd">
                <td>{{$family->name}}</td>
                <td>
                    @if(!empty($family->photo))
                        <img src="{{ asset('images/family/' . $family->photo) }}" alt="Member Photo" width="90">
                    @else
                        <!-- Display something if the photo doesn't exist or is empty -->
                    @endif
                </td>
                <td>{{$family->surname}}</td>
                <td>{{$family->birthdate}}</td>
                <td><a href="{{ route('family-members.index',$family->id) }}" class="add btn btn-sm btn-success">{{$family->family_members_count}}</a></td>
                <td>
                    <a href="{{ route('family-members.create',$family->id) }}" class="add btn btn-sm btn-warning">Add Family Member</a>
            </td>
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
