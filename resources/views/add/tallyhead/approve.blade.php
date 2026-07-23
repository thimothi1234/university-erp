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
                <a class="btn btn-success" href="{{ route('Tally.create') }}"> Create New Ledger</a>
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
                <th class="wd-10p">S.no</th>
                  <th class="wd-25p">Name</th>
                  <th class="wd-30p">Group</th>
                  <th class="wd-20p">Opening Balance</th>
                  <th class="wd-45p">Created</th>
                  <th class="wd-45p">Updated</th>
                  <th class="wd-10p">Action</th>
                </tr>
              </thead>
              <tbody>
              
			  @foreach($payorders as $payorder)
			<tr>
      <td>{{ $loop->iteration }}</td>
			<td>{{$payorder->name}}</td>
			<td>{{$payorder->group}}</td>
      <td>{{$payorder->balance}}</td>
			<td>{{$payorder->created_at}}</td>
      <td>{{$payorder->updated_at}}</td>
			<td> <p>
                    <a class="btn btn-primary" target="_blank" href="{{ route('voucher.edit',$payorder->id) }}">Edit</a>
                  {{ link_to('approvalledger/approve/' . $payorder->id.'/action', 'Approve', ['class' => 'btn btn-primary']) }}
          
                  </p></td>
			</tr>
			@endforeach
                
              </tbody>
              
            </table>
          </div><!-- table-wrapper -->
        </div><!-- card -->

@endsection