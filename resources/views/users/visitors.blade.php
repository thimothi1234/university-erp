@extends('project.admin_master')

@section('project')
<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">Roles</a>
        <a class="breadcrumb-item" href="index.html">Users</a>
        <span class="breadcrumb-item active">View</span>
      </nav>
<div class="card pd-20 pd-sm-40">
<div class="card-header card-header-border-bottom d-flex justify-content-between">
											<h4>Visitors</h4>
        
        </div>





<table class="table table-bordered">
 <tr>
   <th>No</th>
   <th>Name</th>
   <th>Email</th>
   <th width="280px">visit count</th>
 </tr>
 @foreach ($pageVisit as  $user)
  <tr>
    <td>{{ $user->id }}</td>
    <td>{{ $user->user_id }}</td>
    <td>{{ $user->user->email }}</td>
    
    <td>{{ $user->visit_count }}</td>
   
    
   
  </tr>
 @endforeach
</table>

</DIV>


@endsection