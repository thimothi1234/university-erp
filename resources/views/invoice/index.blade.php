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
                <a class="btn btn-success" href="{{ route('voucher.create') }}"> New Voucher Entry</a>
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
                  <th class="wd-15p">Entered</th>
                  <th class="wd-20p">Bank</th>
                  <th class="wd-15p">amount</th>
                  <th class="wd-10p">vendor </th>
                  <th class="wd-10p">Project </th>
                  <th class="wd-10p">Action</th>

                </tr>
              </thead>
              <tbody>
              
			  @foreach($payorders as $payorder)
			<tr>
      <td>{{$payorder->id}}</td>
			<td>{{$payorder->created_at->diffForHumans()}}</td>
			<td>{{$payorder->ledger->bank->name}}</td>
    
      <td>{{$payorder->sum}}</td>
 
      <td>{{$payorder->vendors->name}}</td>
      <td>{{$payorder->projects->name}}</td>
			
			<td><form action="{{ route('Tally.destroy',$payorder->id) }}" method="POST">
                    <a class="btn btn-info" href="{{ route('voucher.show',$payorder->id) }}">Show</a>
                    @can('Tally-edit')
                    <a class="btn btn-primary" href="{{ route('Tally.edit',$payorder->id) }}">Edit</a>
                    @endcan


                    @csrf
                    @method('DELETE')
                    @can('Tally-delete')
                    <button type="submit" class="btn btn-danger">Delete</button>
                    @endcan</td>
			</tr>
			@endforeach
                
              </tbody>
              
            </table>
          </div><!-- table-wrapper -->
        </div><!-- card -->

@endsection