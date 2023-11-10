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
      <table class="table table-bordered data-table display" id="familyTable">
        <thead>
            <tr>
                <th>Photo</th>
                <th>Name</th>
                <th>Surname</th>
                <th>Birthday</th>
                <th>Total Family Members</th>
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
