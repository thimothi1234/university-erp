@extends('project.admin_master')

@section('project')
<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">Approvel</a>
        <a class="breadcrumb-item" href="index.html">Approvel History</a>
        <span class="breadcrumb-item active">View</span>
      </nav>
<div class="card pd-20 pd-sm-40">
<div class="card-header card-header-border-bottom d-flex justify-content-between">
											<h4>Approved History</h4>

                   


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
                  <th class="wd-20p">Date</th>
                  <th class="wd-15p">amount</th>
                  <th class="wd-10p">vendor </th>
                  <th class="wd-10p">Name </th>
                  <th class="wd-10p">Action</th>

                </tr>
              </thead>
              <tbody>
              
			  @foreach($payorders as $payorder)
			<tr>
      <td>{{$payorder->id}}</td>
      <td>{{$payorder->entered}}</td>
			<td>{{$payorder->created_at}}</td>
			<td>{{$payorder->amount}}</td>
    
     
      <td>{{$payorder->vendor}}</td>
      <td>{{$payorder->vendor}}</td>
    
			<td>
                   
                   


                   
                   
                    
                   
                    <p>
                  
 {{ link_to('approval/undo/' . $payorder->id.'/action', 'Undo', ['class' => 'btn btn-primary']) }}
 
 </p>
 

                   </td>
			</tr>
			@endforeach
                
              </tbody>
              
            </table>
          </div><!-- table-wrapper -->
        </div><!-- card -->

@endsection