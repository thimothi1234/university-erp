@extends('project.admin_master2')

@section('project')
<style>
.ui-datatable tbody td.wrap {
    white-space: normal;
    word-wrap: break-word;
}

</style>
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.3/css/buttons.dataTables.min.css">


<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">Payroll</a>
        <a class="breadcrumb-item" href="index.html">Tax</a>
        <span class="breadcrumb-item active">computation</span>
      </nav>
<div class="card pd-20 pd-sm-40">
<div class="card-header card-header-border-bottom d-flex justify-content-between">
											<h4>Tax computation sheet of all Faculty & Staff


                      </h4>




										</div>
<form method="GET" action="{{ route('taxsheet') }}">
    
    <select name="fy">
        <option value="">Select Financial Year</option>

    

        @foreach ($pfy as $payorderss)
	<option value="{{$payorderss}}">{{$payorderss}}</option>
      @endforeach

    </select>

    <button type="submit">Submit</button>

</form>


          @if(session('success'))
								<div class="alert alert-success alert-dismissible fade show" role="alert">
								{{session('success')}}
								<button type="button" class="close" data-dismiss="alert" aria-label="Close">
									<span aria-hidden="true">&times;</span>
								</button>
								</div>
                @endif
          <div class="table-wrapper">
            <table id="example" width="100%" class="table display responsive nowrap">
              <thead>
                <tr> <th colspan="23">FY {{$fy}}</th> </tr>
               <tr>
                        <th>Name</th>
                        <th>E-ID</th>
                        <th>Salary Gross</th>
                        <th>Actual salary paid</th>
                        <th>NPS Employer paid</th>
                        <th>Projected Salary</th>
                        <th>Other Income</th>
                        <th>ADD</th>
                        <th>Total Gross</th>
                        <th>Deductions</th>
                        <th>ADD</th>
                        <th>Net taxable income</th>
                        <th>Tax rate</th>
                        <th>Regime</th>
                        <th>Total Tax</th>
                        <th>Change</th>
                        <th>Tax deducted</th>
                        <th>Tax last</th>
                        <th>Tax payable</th>
                        <th>Tax per month</th>
                        <th>Action</th>
                        <th>Action</th>
                    </tr>
              </thead>
              <tbody>
              
			@foreach($under as $payorder)
    @php
        $eid = $payorder->EID;
        $actualVal = (float) ($actual[$eid]->actual1 ?? 0);
        $nps = (float) ($actualnps[$eid]->actualnps1 ?? 0);
        $addIncomeold = (float) ($deduc_data[$eid]->addinc ?? 0);
        $addIncomenew = (float) ($deduc_datanew[$eid]->addinc ?? 0) + ($deduc_data[$eid]->addinc ?? 0);
        $addIncometds = (float) ($deduc_data[$eid]->addinctds ?? 0);
        $grossBase = (float) $payorder->total + $actualVal + ($nps * 1.4);
        $addIncome = ($payorder->taxregime == 1) ? $addIncomenew : $addIncomeold;
        $totalGross = $grossBase + $addIncome;
        
     
       
        $nps_total = (float) ($nps_data[$eid]->nps_total ?? 0);

        $nps14paid = $nps_total + ($nps * 1.4) ;
        $nps10 = ($nps14paid)/14 *10;

        $deduction = (float) ($deduction_data[$eid]->deduc ?? 0);
        $deduc80c = (float) ($deduction_80c[$eid]->deduc80c ?? 0);
        
        $limit80c = min(150000, (($nps10) + $deduc80c));
        $deductable = $payorder->taxregime == 1
            ? ($nps14paid+ 75000)
            : ($nps14paid + $deduction + $limit80c + 50000 + 2400);
     

        $netTaxable = $totalGross - $deductable;
        $taxOld = $taxCalculations[$eid]['oldTax'] ?? 0;
        $taxNew = $taxCalculations[$eid]['newTax'] ?? 0;
        $difference = $taxCalculations[$eid]['difference'] ?? 0;
        $taxPerMonth = $taxCalculations[$eid]['taxPerMonth'] ?? 0;
    @endphp
    <tr>
        <td>{{ $payorder->Name }}</td>
        <td>{{ $eid }}</td>
        <td>₹{{ number_format($grossBase, 2) }}</td>
        <td>{{ $actualVal }}</td>
        <td>{{ number_format($nps * 1.4, 2) }}</td>
        <td>{{ number_format($payorder->total, 2) }}</td>
        <td>₹{{ number_format($addIncome, 2) }}</td>
        <td>
       <a class="btn btn-sm btn-outline-primary" target="_blank"
   href="{{ url('/save-other-income-data?id=' . $eid . '&fy=' . $fy) }}">
    <i class="fa fa-plus"></i>
</a>

        </td>
        <td>₹{{ number_format($totalGross, 2) }}</td>
        <td>@php
    $total = $deductable;
@endphp
₹{{ number_format($total, 2) }}
</td>
        <td>
            <a class="btn btn-sm btn-outline-primary" target="_blank"
               href="{{ url('indexdeduct?id=' . $eid. '&fy=' . $fy) }}">
                <i class="fa fa-plus"></i>
            </a>
        </td>
        <td>₹{{ number_format($netTaxable  , 2) }}
        </td>
        <td>
            @php
    $taxRate = 0;
if ($payorder->taxregime == 1)
  {
       if ($netTaxable <= 1200000) {
        $taxRate = 0.00;
    } elseif ($netTaxable <= 1600000) {
        $taxRate = 15.60;
    } elseif ($netTaxable <= 2000000) {
        $taxRate = 20.80;
    } elseif ($netTaxable <= 2400000) {
        $taxRate = 26.00;
    } elseif ($netTaxable <= 5000000) {
        $taxRate = 31.20;
    } elseif ($netTaxable <= 10000000) {
        $taxRate = 34.32;
    } elseif ($netTaxable <= 20000000) {
        $taxRate = 35.88;
    } else {
        $taxRate = 39.00;
    }
    }
    else {
        if ($netTaxable <= 500000) {
                $taxRate = 0.00;
            } elseif ($netTaxable <= 1000000) {
                $taxRate = 20.80;
            } elseif ($netTaxable <= 5000000) {
                $taxRate = 31.20;
            } elseif ($netTaxable <= 10000000) {
                $taxRate = 34.32;
            } elseif ($netTaxable <= 20000000) {
                $taxRate = 35.88;
            } elseif ($netTaxable <= 50000000) {
                $taxRate = 39.00;
            } else {
                $taxRate = 43.00;
            }

    }
@endphp

 {{ $taxRate }}%

        </td>
        <td> 
        @if ($payorder->taxregime == 1) 
            New Regime  @else  Old Regime 
        

        @endif

        </td>
        <td class="{{ $payorder->taxregime == 0 ? 'bg-danger' : 'bg-info' }} text-white fw-bold">
            ₹{{ number_format($payorder->taxregime == 0 ? $taxOld : $taxNew, 0) }}
        </td>
        <td>
            <button type="button" class="btn btn-primary" data-toggle="modal"
                    data-taxregime="{{ $payorder->taxregime }}"
                    data-eid="{{ $eid }}" data-fy="{{ $fy }}" data-target="#hraModal">
                <i class="fa fa-edit"></i>
            </button>
        </td>
        <td>₹{{ number_format(($taxdeducted[$eid]->taxdeduc ?? 0) + $addIncometds, 2) }}
        </td>
        <td>₹{{ number_format($taxdeductedlast[$eid]->taxdeduclast ?? 0, 2) }}</td>
        <td class="text-danger fw-bold">{{ number_format($difference, 0) }}</td>
        <td class="text-primary fw-bold">₹{{ number_format($taxPerMonth, 0) }}</td>
        <td>
            <a class="btn btn-sm btn-primary" target="_blank"
               href="{{ url('computationsheet?id=' . $eid. '&fy=' . $fy) }}">View</a>
        </td>
        <td>
            <a class="btn btn-sm btn-primary" target="_blank"
               href="{{ url('fetchdata2?id=' . $eid) }}">Edit</a>
        </td>
    </tr>
@endforeach

                
              </tbody>
              
            </table>
          </div><!-- table-wrapper -->
        </div><!-- card -->
        <!-- Modal -->
<!-- HRA Exemption Modal -->
<div class="modal fade" id="hraModal" tabindex="-1" role="dialog" aria-labelledby="hraModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <form id="editForm" class="modal-content" action="{{ route('update.taxdeduction') }}" method="POST">
            @csrf
            <div class="modal-header">
                <h5 class="modal-title">Change Tax Regime</h5>
                <button type="button" class="close" data-dismiss="modal"><span>×</span></button>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label for="edit-eid">EID</label>
                    <input name="eid" id="edit-eid" class="form-control" readonly>
                    <input name="fy" id="edit-fy" class="form-control" readonly>
                    @error('eid')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="edit-section">Section</label>
                    <select name="section" id="edit-section" class="form-control" required>
                        <option value="">-- Select Regime --</option>
                        <option value="0">Old</option>
                        <option value="1">New</option>
                    </select>
                    @error('section')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </form>
    </div>
</div>
<!-- jQuery -->


<!-- Popper and Bootstrap JS -->


        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
<script>
$(function () {
    $('#example').DataTable({
        dom: 'Blfrtip', // IMPORTANT: include 'l' for length menu
        scrollX: true,
        scrollY: 400,

        pageLength: -1,
        lengthMenu: [
            [10, 25, 50, 100, -1],
            [10, 25, 50, 100, "All"]
        ],

        buttons: ['copy', 'csv', 'excel', 'pdf']
    });


    $('#hraModal').on('show.bs.modal', function(e) {
        let btn = $(e.relatedTarget);
        $('#edit-section').val(btn.data('taxregime'));
        $('#edit-eid').val(btn.data('eid'));
        $('#edit-fy').val(btn.data('fy'));
    });
});
</script>

@endsection

