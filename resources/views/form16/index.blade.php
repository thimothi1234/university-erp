@extends('project.admin_master')

@section('project')
<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">Claim</a>
        <a class="breadcrumb-item" href="index.html">Bills</a>
        <span class="breadcrumb-item active">View</span>
      </nav>
<div class="card pd-20 pd-sm-40">
<div class="card-header card-header-border-bottom d-flex justify-content-between">
											<h4>Form-16</h4>

                      
           
            
            
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

                  <th class="wd-15p">Year</th>
                  <th class="wd-10p">Part - A</th>
                  <th class="wd-10p">Part - B</th>

                </tr>
              </thead>
              <tbody>
              
              @foreach($payorders as $payorder)
              
			<tr>
			<td>2022-23 </td>
      <td><a href="{{asset('uploads/form16/parta/'.$payorder->parta.'_2023-24.pdf')}}" target="_blank">Open</a></td>
      <td><a href="{{asset('uploads/form16/partb/'.$payorder->partb.'_PARTB_2023-24.pdf')}}" target="_blank">Open</a></td>

			</tr>
      <tr>
			<td>2023-24 </td>
      <td><a href="{{asset('uploads/form16n/parta/'.$payorder->parta.'_2024-25.pdf')}}" target="_blank">Open</a></td>
      <td><a href="{{asset('uploads/form16n/partb/'.$payorder->partb.'_PARTB_2024-25.pdf')}}" target="_blank">Open</a></td>

			</tr>
      <tr>
			<td>2024-25 </td>
      <td><a href="{{asset('uploads/form16-25-26/parta/'.$payorder->parta.'_2025-26.pdf')}}" target="_blank">Open</a></td>
      <td><a href="{{asset('uploads/form16-25-26/partb/'.$payorder->partb.'_PARTB_2025-26.pdf')}}" target="_blank">Open</a></td>

			</tr>

        <tr>
			<td>2025-26 </td>
      <td><a href="{{asset('uploads/f25-26/PART-A/'.$payorder->parta.'_2026-27.pdf')}}" target="_blank">Open</a></td>
      <td><a href="{{asset('uploads/f25-26/PART-B/'.$payorder->partb.'_PARTB_2026-27.pdf')}}" target="_blank">Open</a></td>

			</tr>
			@endforeach
                
              </tbody>
              
            </table>
          </div><!-- table-wrapper -->
        </div><!-- card -->
           
@endsection