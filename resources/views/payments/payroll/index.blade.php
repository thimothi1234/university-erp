@extends('project.admin_master')

@section('project')
<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">Vouchers</a>
        <a class="breadcrumb-item" href="{{ route('voucher.index') }}">Payment</a>
        <span class="breadcrumb-item active">View</span>
    </nav>
    <div class="card pd-20 pd-sm-40">
        <div class="card-header card-header-border-bottom d-flex justify-content-between">
            <h4>Payment Vouchers</h4>
            <div class="pull-right">
                @can('voucher-create')
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

        <!-- Display unique 'Under' values with checkboxes -->
        <div id="filters" class="mb-4">
            <h5>Filter by Under:</h5>
            @php
                $underValues = $profiles->pluck('Under_')->unique(); // Get unique 'Under' values
            @endphp
            @foreach($underValues as $underValue)
                <label>
                    <input type="checkbox" class="under-filter" value="{{ $underValue }}">
                    {{ $underValue }}
                </label>
            @endforeach
        </div>

        <div class="table-wrapper">
            <table id="examplea" class="uk-table uk-table-hover uk-table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Category</th>
                        <th>Display Name in Reports</th>
                        <th>Under</th>
                        <th>EID</th>
                        <th>DOJ</th>
                        <th>Designation</th>
                        <th>Function</th>
                        <th>Location</th>
                        <th>Gender</th>
                        <th>Date of Birth</th>
                        <th>Blood Group</th>
                        <th>Father/Mother Name</th>
                        <th>Spouse Name</th>
                        <th>PAN</th>
                        <th>Aadhaar Number</th>
                        <th>Bank Name</th>
                        <th>Branch</th>
                        <th>Account Number</th>
                        <th>IFS Code</th>
                        <th>Contact Number</th>
                        <th>Email ID</th>
                        <th>Address</th>
                        <th>Passport Number</th>
                        <th>Country of Issue</th>
                        <th>Passport Expiry Date</th>
                        <th>Visa Number</th>
                        <th>Visa Expiry Date</th>
                        <th>Work Permit Number</th>
                        <th>Contract Start Date</th>
                        <th>Contract Expiry Date</th>
                        <th>Applicability Tax Regime</th>
                        <th>Effective From</th>
                        <th>Universal Account Number (UAN)</th>
                        <th>PF Account Number</th>
                        <th>EPS Account Number</th>
                        <th>PF Date of Join</th>
                        <th>ESI Number</th>
                        <th>ESI Dispensary</th>
                        <th>PRAN</th>
                        <th>Level</th>
                        <th>DOR</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($profiles as $profile)
                    <tr class="profile-row" data-under="{{ $profile->Under_ }}">
                        <td>{{ $profile->id }}</td>
                        <td>{{ $profile->Name }}</td>
                        <td>{{ $profile->Category_ }}</td>
                        <td>{{ $profile->Display_Name_in_Reports }}</td>
                        <td>{{ $profile->Under_ }}</td>
                        <td>{{ $profile->EID }}</td>
                        <td>{{ $profile->DOJ }}</td>
                        <td>{{ $profile->Designationn }}</td>
                        <td>{{ $profile->Function }}</td>
                        <td>{{ $profile->Location }}</td>
                        <td>{{ $profile->Gender_ }}</td>
                        <td>{{ $profile->Date_of_Birth_ }}</td>
                        <td>{{ $profile->Blood_Group }}</td>
                        <td>{{ $profile->Father_Mother_Name }}</td>
                        <td>{{ $profile->Spouse_Name }}</td>
                        <td>{{ $profile->PAN }}</td>
                        <td>{{ $profile->Aadhaar_Number }}</td>
                        <td>{{ $profile->Bank_Name_ }}</td>
                        <td>{{ $profile->Branch_ }}</td>
                        <td>{{ $profile->Account_Number }}</td>
                        <td>{{ $profile->IFS_Code_ }}</td>
                        <td>{{ $profile->Contact_Number_ }}</td>
                        <td>{{ $profile->E_Mail_ID }}</td>
                        <td>{{ $profile->Address_ }}</td>
                        <td>{{ $profile->Passport_Number }}</td>
                        <td>{{ $profile->Country_of_Issue }}</td>
                        <td>{{ $profile->Passport_Expiry_Date }}</td>
                        <td>{{ $profile->Visa_Number }}</td>
                        <td>{{ $profile->Visa_Expiry_Date }}</td>
                        <td>{{ $profile->Work_Permit_Number }}</td>
                        <td>{{ $profile->Contract_Start_Date }}</td>
                        <td>{{ $profile->Contract_Expiry_Date }}</td>
                        <td>{{ $profile->Applicability_Tax_Regime }}</td>
                        <td>{{ $profile->_Effective_from }}</td>
                        <td>{{ $profile->Universal_Account_Number_UAN }}</td>
                        <td>{{ $profile->PF_Account_Number }}</td>
                        <td>{{ $profile->EPS_Account_Number }}</td>
                        <td>{{ $profile->PF_Date_of_Join }}</td>
                        <td>{{ $profile->ESI_Number }}</td>
                        <td>{{ $profile->ESI_Dispensary }}</td>
                        <td>{{ $profile->PRAN }}</td>
                        <td>{{ $profile->Level }}</td>
                        <td>{{ $profile->DOR }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div><!-- table-wrapper -->
    </div><!-- card -->

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.2.3/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.uikit.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                dom: 'Blfrtip',
                order: [[0, 'desc']],
                scrollX: true,
                lengthMenu: [
                    [10, 25, 50, -1],
                    [10, 25, 50, 'All'],
                ],
                scrollY: '400px',
                buttons: [
                    'copy', 'csv', 'excel', 'pdf', 'print'
                ]
            });

            // Filter rows based on selected checkboxes
            $('.under-filter').on('change', function() {
                let selectedFilters = [];
                $('.under-filter:checked').each(function() {
                    selectedFilters.push($(this).val());
                });

                // Show/hide rows based on filters
                if (selectedFilters.length > 0) {
                    $('.profile-row').each(function() {
                        let rowUnder = $(this).data('under');
                        if (selectedFilters.includes(rowUnder)) {
                            $(this).show();
                        } else {
                            $(this).hide();
                        }
                    });
                } else {
                    // Show all rows if no checkbox is selected
                    $('.profile-row').show();
                }
            });
        });
    </script>
@endsection
