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
											<h4>Tally Group</h4>

                      <div class="pull-right">
               
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
              
                  <th class="wd-15p">Group</th>
                  <th class="wd-20p">Expenditure</th>
                  <th class="wd-20p">Action</th>
                 
                

                </tr>
              </thead>
              <tbody>
              
			  @foreach($bud as $payorder)
			<tr>
    
			
			<td>{{$payorder->groupname}}</td>
    
      <td>{{$payorder->amount}}</td>
      <td><a class="btn btn-info" href="">View</a></td>	
 
   
      
			</tr>
			@endforeach
                
              </tbody>
              
            </table>
          </div><!-- table-wrapper -->
        </div><!-- card -->

@endsection