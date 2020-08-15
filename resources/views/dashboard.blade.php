@extends('layouts.admin')

@section('content')

<!-- Page Heading -->
<div class="d-sm-flex align-items-center justify-content-between mb-4">
  <h1 class="h3 mb-0 text-gray-800">Solution Queries</h1>
  <!-- <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-download fa-sm text-white-50"></i> Generate Report</a> -->
</div>

<!-- DataTales Example -->
<div class="card shadow mb-4">
  <!-- <div class="card-header py-3">
    <h6 class="m-0 font-weight-bold text-primary">DataTables Example</h6>
  </div> -->
  <div class="card-body">
    <div class="table-responsive">
      <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
        <thead>
          <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Company Name</th>
            <th>Mobile Number</th>
            <th>Pincode</th>
            <th>State</th>
            <th>Query</th>
            <th>Query raised on</th>
          </tr>
        </thead>
        <tfoot>
          <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Company Name</th>
            <th>Mobile Number</th>
            <th>Pincode</th>
            <th>State</th>
            <th>Query</th>
            <th>Query raised on</th>
          </tr>
        </tfoot>
        <tbody>
          @foreach ($solutionQueries as $solutionQuery)
            <tr>
              <td>{{ $solutionQuery->name }}</td>
              <td>{{ $solutionQuery->email }}</td>
              <td>{{ $solutionQuery->companyName }}</td>
              <td>{{ $solutionQuery->mobileNumber }}</td>
              <td>{{ $solutionQuery->pincode }}</td>
              <td>{{ $solutionQuery->state }}</td>
              <td class="query-details" data="{{$solutionQuery->query}}">{{ substr($solutionQuery->query, 0, 10) }}</td>
              <td>{{ $solutionQuery->created_at->format('j F Y') }}</td>
            </tr>
          @endforeach
        </tbody>
      </table>
    </div>
  </div>
</div>


<div id="myModal" class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Query Description</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>

      <div class="modal-body" id="modalContent"></div>
    </div>
  </div>
</div>

@endsection