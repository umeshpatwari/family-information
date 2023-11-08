@extends('admin.layout.layout')
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
                <th>Birthday</th>
                <th>Name</th>
                <th>Sirname</th>
                <th>Birthday</th>
                <!-- <th>City</th>
                <th>Pincode</th>
                <th>MaritalStatus</th>
                <th>WeddingDate</th> -->
                <!-- <th>Created Date</th> -->
                <th width="100px">Action</th>
            </tr>
        </thead>
        <tbody>
        </tbody>
    </table>
  </div> 
  </section>
  <!-- /.content -->
</div>
<!-- /.content-wrapper -->
@endsection
