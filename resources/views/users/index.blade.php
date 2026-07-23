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
											<h4>Users</h4>
        @can('role-create')
            <a class="btn btn-success" href="{{ route('users.create') }}"> Create New User</a>
            @endcan
        </div>



@if ($message = Session::get('success'))
<div class="alert alert-success">
  <p>{{ $message }}</p>
</div>
@endif


<table class="table table-bordered">
 <tr>
   <th>No</th>
   <th>Name</th>
   <th>Email</th>
   <th>Role</th>
   <th width="280px">Action</th>
 </tr>
 @foreach ($data as  $user)
  <tr>
    <td>{{ $user->id }}</td>
    <td>{{ $user->names->name }}</td>
    <td>{{ $user->email }}</td>
    <td>
      @if(!empty($user->getRoleNames()))
        @foreach($user->getRoleNames() as $v)
           <label class="badge badge-success">{{ $v }}</label>
        @endforeach
      @endif
    </td>
    <td>
    <a class="btn btn-info" href="{{ route('users.show',$user->id) }}">Show</a>
            @can('user-edit')
                <a class="btn btn-primary" href="{{ route('users.edit',$user->id) }}">Edit</a>
            @endcan
            @can('user-delete')
                {!! Form::open(['method' => 'DELETE','route' => ['users.destroy', $user->id],'style'=>'display:inline']) !!}
                    {!! Form::submit('Delete', ['class' => 'btn btn-danger']) !!}
                {!! Form::close() !!}
            @endcan
    </td>
  </tr>
 @endforeach
</table>

</DIV>


@endsection