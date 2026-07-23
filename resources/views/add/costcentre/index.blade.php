@extends('project.admin_master')

@section('project')
<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">Add</a>
        <a class="breadcrumb-item" href="index.html">tallyledgers</a>
        <span class="breadcrumb-item active">View</span>
      </nav>
<div class="card pd-20 pd-sm-40">
<div class="card-header card-header-border-bottom d-flex justify-content-between">
											<h4>Tally Ledgers</h4>

                      <div class="pull-right">
                @can('Tally-create')
                <a class="btn btn-success" href="{{ route('costcentre.create') }}"> Create New Costcentre</a>
                @endcan
            </div>


										</div>
          @if(session('success'))
								<div class="alert alert-success alert-dismissible fade show" role="alert">
								{{session('success')}}
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								</div>
                @endif
          <div class="table-wrapper">
            <table id="datatable1" class="table display responsive nowrap">
              <thead>
                <tr>
                <th class="wd-15p">S.No</th>
                  <th class="wd-15p">Name</th>
                  <th class="wd-20p">Group</th>
                  <th class="wd-20p">Opening Balance</th>
                  <th class="wd-15p">Created</th>
                  <th class="wd-10p">Action</th>
                </tr>
              </thead>
              <tbody>
              
			  @foreach($payorders as $payorder)
			<tr>
			<td>{{$payorder->id}}</td>
			<td>{{$payorder->name}}</td>
			<td>{{$payorder->group}}</td>
      <td>{{$payorder->balance}}</td>
			<td>{{$payorder->created_at}}</td>
			<td><form action="{{ route('costcentre.destroy',$payorder->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('costcentre.show',$payorder->id) }}">Show</a>
                    @can('costcentre-edit')
                    <a class="btn btn-primary" href="{{ route('costcentre.edit',$payorder->id) }}">Edit</a>
                    @endcan


                    @csrf
                    @method('DELETE')
                    @can('costcentre-delete')
                    <button type="submit" class="btn btn-danger">Delete</button>
                    @endcan</td>
			</tr>
			@endforeach
                
              </tbody>
              
            </table>
          </div><!-- table-wrapper -->
        </div><!-- card -->

@endsection