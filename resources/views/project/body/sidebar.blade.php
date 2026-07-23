<div class="sl-logo"><img src="{{asset('includes/img/IIT.png')}}" alt="" style="width:250px;height:40px;"></div>
    <div class="sl-sideleft">
      <div class="input-group input-group-search">
        <input type="search" name="search" class="form-control" placeholder="Search">
        <span class="input-group-btn">
          <button class="btn"><i class="fa fa-search"></i></button>
        </span><!-- input-group-btn -->
      </div><!-- input-group -->

      <label class="sidebar-label">Menu</label>
   
        @can('voucher-create')
        <a href="#" class="sl-menu-link">
          <div class="sl-menu-item">
            
            <i class="fa fa-bar-chart"></i>
            <span class="menu-item-label">Vouchers</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
          <li class="nav-item"><a href="{{route('voucher.index')}}" class="nav-link">Payment Voucher</a></li>
           <li class="nav-item"><a href="{{route('receipt.index')}}" class="nav-link">Receipt Voucher</a></li>
          <!--<li class="nav-item"><a href="{{route('journal.index')}}" class="nav-link">Journal Voucher</a></li>
          <li class="nav-item"><a href="{{route('contra.index')}}" class="nav-link">Contra Voucher</a></li> -->
          <li class="nav-item"><a href="{{route('bulk.index')}}" class="nav-link">Bulk Voucher</a></li>
      
          
          <li class="nav-item"><a href="{{route('commitment.index')}}" class="nav-link">Commitments</a></li>
          <li class="nav-item"><a href="{{url('selfadvances')}}" class="nav-link">Self Advances</a></li>
          <li class="nav-item"><a href="{{route('advance.index')}}" class="nav-link">All Advances</a></li>
          
        
        </ul>

 @if(auth()->user()->id == 769 or auth()->user()->id == 46 or auth()->user()->id == 500  )
        <a href="#" class="sl-menu-link">
          <div class="sl-menu-item">
            
            <i class="fa fa-cubes"></i>
            <span class="menu-item-label">Payroll</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column show">
          <!-- <li class="nav-item"><a href="{{route('payroll.index')}}" class="nav-link">Employees profile</a></li> -->
          <li class="nav-item"><a href="{{url('getpayslip')}}" class="nav-link">Payslip</a></li>
          <li class="nav-item"><a href="{{url('paysheetfull')}}" class="nav-link">pay sheet full</a></li>
          <li class="nav-item"><a href="{{url('taxsheet')}}" class="nav-link">Tax sheet</a></li>
           <li class="nav-item"><a href="{{route('employees.create')}}" class="nav-link">New employee</a></li>
            <li class="nav-item"><a href="{{route('addincome.import.form')}}" class="nav-link">Bulk upload Other Income</a></li>
          <li class="nav-item"><a href="{{url('/save-other-income-data-po')}}" class="nav-link">Additonal Income category</a></li>
        
        </ul>
          
       
@endif
 @if(auth()->user()->id == 47 or auth()->user()->id == 46  )
        <a href="#" class="sl-menu-link">
          <div class="sl-menu-item">
                   

            <i class="fa fa-exchange"></i>
            <span class="menu-item-label">Inward Pending</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
        <li class="nav-item"><a href="{{url('ceaprocess')}}" class="nav-link">Children Education Allowance</a></li>
          <li class="nav-item"><a href="{{route('claim.index')}}" class="nav-link">Tour & TA Advance</a></li>
          <li class="nav-item"><a href="{{url('inwardmobile')}}" class="nav-link">​Telephone Reimbursement</a></li>
   
          <li class="nav-item"><a href="{{route('reimb.index')}}" class="nav-link">​Reimbursement</a></li>
          <li class="nav-item"><a href="{{route('medical.index')}}" class="nav-link">Medical Claim A (OP)</a></li>
          <li class="nav-item"><a href="{{route('travel.index')}}" class="nav-link">Travel Claim</a></li>
          
          <li class="nav-item"><a href="{{route('tempadv.index')}}" class="nav-link">Temporary Advance</a></li>
        </ul>

        @endif



@can('voucher-create')

        <a href="#" class="sl-menu-link">
          <div class="sl-menu-item">
          <i class="fa fa-plus"></i>
          <span class="menu-item-label">ADD</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
        <li class="nav-item"><a href="{{route('projects.index')}}" class="nav-link">Budget Heads</a></li>
        <li class="nav-item"><a href="{{url('createsub')}}" class="nav-link">Budget Sub Heads</a></li>
          <!-- <li class="nav-item"><a href="{{route('Tallygroup.index')}}" class="nav-link">Create Group</a></li> -->
          <li class="nav-item"><a href="{{route('beneficiary.index')}}" class="nav-link">Vendor Details</a></li>
          <li class="nav-item"><a href="{{route('Tally.index')}}" class="nav-link">Tally Ledgers</a></li>
          <!-- <li class="nav-item"><a href="{{route('Tallygroup.index')}}" class="nav-link">Tally Groups</a></li> -->
          <!-- <li class="nav-item"><a href="{{route('costcentre.index')}}" class="nav-link">Cost Centers</a></li>
          <li class="nav-item"><a href="{{route('costcentregroup.index')}}" class="nav-link">Cost Centers Group</a></li> -->
          <li class="nav-item"><a href="{{route('pfms.index')}}" class="nav-link">PFMS Head</a></li>
        </ul>
@endcan

        <a href="#" class="sl-menu-link">
          <div class="sl-menu-item">
          <i class="fa fa-group"></i>
          <span class="menu-item-label">Stores</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
        <li class="nav-item"><a href="{{route('commitment.index')}}" class="nav-link">Commitments</a></li>

          <li class="nav-item"><a href="{{route('bankbook.create')}}" class="nav-link">Payments</a></li>
          

          

        


        </ul>
        
        
                    


        <!-- <a href="#" class="sl-menu-link">
          <div class="sl-menu-item">
          <i class="fa fa-plus"></i>
          <span class="menu-item-label">Master</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div>menu-item -->
        <!--</a> sl-menu-link -->
        <!-- <ul class="sl-menu-sub nav flex-column">
          <li class="nav-item"><a href="" class="nav-link">Invoice</a></li>
          <li class="nav-item"><a href="form-elements.html" class="nav-link">Funding Agencies</a></li>
          <li class="nav-item"><a href="{{url('/add/tallyhead')}}" class="nav-link">Tally Ledgers</a></li>
          <li class="nav-item"><a href="{{route('employees.index')}}" class="nav-link">Employees Master</a></li>
          <li class="nav-item"><a href="{{url('/add/pfmshead')}}" class="nav-link">PFMS Head</a></li>
          <li class="nav-item"><a href="{{url('/add/pfmsschemes')}}" class="nav-link">PFMS Schemes</a></li>
          <li class="nav-item"><a href="{{url('/add/bankaccounts')}}" class="nav-link">Bank Accounts</a></li>
          <li class="nav-item"><a href="{{url('/add/vouchertype')}}" class="nav-link">Voucher Types</a></li>
          <li class="nav-item"><a href="{{url('/add/payorder')}}" class="nav-link">Payorder Types</a></li>
          
          
        


        </ul> --> 

        @if(auth()->user()->id == 806 or auth()->user()->id == 308 or auth()->user()->id == 419 or auth()->user()->id == 466 or auth()->user()->id == 46 or auth()->user()->id == 825 )
        
        <a href="#" class="sl-menu-link">
          <div class="sl-menu-item">
          <i class="fa fa-bank"></i>
          <span class="menu-item-label">Pay</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
          <li class="nav-item"><a href="{{route('cheque.create')}}" class="nav-link">Cheque</a></li>
          <li class="nav-item"><a href="{{url('selectcheque')}}" class="nav-link">Cheque Print</a></li>
          
          <li class="nav-item"><a href="{{route('bulk.indexx')}}" class="nav-link">Bulk Payments</a></li>
            <li class="nav-item"><a href="{{url('searchtsa')}}" class="nav-link">Approved payments</a></li>
     
        </ul>    
        
        <!-- <a href="#" class="sl-menu-link">
          <div class="sl-menu-item">
          <i class="fa fa-envelope"></i>
          <span class="menu-item-label">Mail </span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div>
          </a> -->
          <!-- menu-item -->
       <!-- sl-menu-link -->
        <!-- <ul class="sl-menu-sub nav flex-column">

          <li class="nav-item"><a href="https://package.accounts.iith.ac.in/mail/public/usersb" class="nav-link">Normal payment Mails</a></li>
          <li class="nav-item"><a href="https://package.accounts.iith.ac.in/mail/public/users" class="nav-link">Bulk Payment Mails</a></li>
        </ul>     -->
        @endif
        @endcan
        @can('user-edit')


        <a href="#" class="sl-menu-link">
          <div class="sl-menu-item">
            <i class="fa fa-address-card-o"></i>
            <span class="menu-item-label">User Roles</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
          <li class="nav-item"><a href="{{route('roles.index')}}" class="nav-link">Roles</a></li>
          <li class="nav-item"><a href="{{route('users.index')}}" class="nav-link">Users</a></li>
          <li class="nav-item"><a href="{{url('showPage')}}" class="nav-link">Visitors</a></li>
        
        </ul>
        @endcan
    
@can('approval-create')

        <a href="#" class="sl-menu-link">
          <div class="sl-menu-item">
          <i class="fa fa-check"></i>
          <span class="menu-item-label">Approval</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
          <li class="nav-item"><a href="{{route('approval.index')}}" class="nav-link">Pending Approvals</a></li>
           <!-- <li class="nav-item"><a href="{{url('approved')}}" class="nav-link">Approved History</a></li> -->
         
      
          
          
        


        </ul>
@endcan
       


       
        <a href="#" class="sl-menu-link">
          <div class="sl-menu-item">
            <i class="menu-item-icon icon ion-ios-navigate-outline tx-24"></i>
            <span class="menu-item-label">Claim</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
        <li class="nav-item"><a href="{{route('cea.index')}}" class="nav-link">Children Education Allowance</a></li>
          <li class="nav-item"><a href="{{route('claim.index')}}" class="nav-link">Tour & TA Advance</a></li>
          <li class="nav-item"><a href="{{route('mobile.index')}}" class="nav-link">​Telephone Reimbursement</a></li>
   
          <li class="nav-item"><a href="{{route('reimb.index')}}" class="nav-link">​Reimbursement</a></li>
          <li class="nav-item"><a href="{{route('medical.index')}}" class="nav-link">Medical Claim A (OP)</a></li>
          <li class="nav-item"><a href="{{route('travel.index')}}" class="nav-link">Travel Claim</a></li>
          
          <li class="nav-item"><a href="{{route('tempadv.index')}}" class="nav-link">Temporary Advance</a></li>
        </ul>

        

        <a href="{{url('mybills')}}"  class="sl-menu-link">
          <div class="sl-menu-item">
            
          <i class="fa fa-filter"></i>
            <span class="menu-item-label">My Payments</span>
            
          </div><!-- menu-item -->
        </a>



        @if(auth()->user()->id == 684 )
        <a href="{{url('pos')}}"  class="sl-menu-link">
          <div class="sl-menu-item">
            
            <i class="fa fa-external-link"></i>
            <span class="menu-item-label">PO Payments</span>
            
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
@endif


  @if(auth()->user()->id == 46 or auth()->user()->id == 236 or auth()->user()->id == 307 )
        <a href="{{url('HRMDEAN')}}"  class="sl-menu-link">
          <div class="sl-menu-item">
            
            <i class="fa fa-external-link"></i>
            <span class="menu-item-label">Faculty applications</span>
            
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
@endif
        
@can('voucher-edit')
        <a href="#" class="sl-menu-link">
          <div class="sl-menu-item">
          <i class="fa fa-book"></i>




            <span class="menu-item-label">Reports</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
              <li class="nav-item"><a href="{{url('allbills')}}" class="nav-link">All Vouchers</a></li>
          <li class="nav-item"><a href="{{route('bankbook.create')}}" class="nav-link">Bank-Book</a></li>

          @can('payorder-list')
          <li class="nav-item"><a href="{{route('reports.create')}}" class="nav-link">Payments & Receipts</a></li>
          
          <li class="nav-item"><a href="{{url('tdscreate')}}" class="nav-link">TDS Report</a></li>
          <li class="nav-item"><a href="{{url('gstcreate')}}" class="nav-link">GST-TDS Report</a></li>
          <li class="nav-item"><a href="{{url('tallyc')}}" class="nav-link">Tally Export</a></li>
          <li class="nav-item"><a href="{{url('ledgerper')}}" class="nav-link">Ledger wise</a></li>
          <li class="nav-item"><a href="{{url('budgetper')}}" class="nav-link">Budget wise funds stats</a></li>
          @endcan
          <!-- <li class="nav-item"><a href="chart-chartjs.html" class="nav-link">Pending Advances</a></li>
          <li class="nav-item"><a href="chart-rickshaw.html" class="nav-link">Receivables</a></li>
          <li class="nav-item"><a href="chart-sparkline.html" class="nav-link">BRS</a></li> -->
          
        </ul> 
@endcan
 <a href="#" class="sl-menu-link">
          <div class="sl-menu-item">
         <i class="fa fa-inr"></i>
            <span class="menu-item-label">Salary</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
       
          <li class="nav-item"><a href="{{url('payslip')}}" class="nav-link">Pay slip</a></li>
           <li class="nav-item"><a href="{{url('form1s6')}}" class="nav-link">Form 16</a></li>
   
   
        </ul>

         <a href="#" class="sl-menu-link">
          <div class="sl-menu-item">
        <i class="fa fa-money"></i>


            <span class="menu-item-label">IT-Computation 
        <span class="badge bg-danger" style="font-size:10px;">New</span></span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
       
          <li class="nav-item"><a href="{{url('/computationsheet?fy=25-26')}}" class="nav-link">25-26</a></li>
           <li class="nav-item"><a href="{{url('/computationsheet?fy=26-27')}}" class="nav-link">26-27</a></li>
   
   
        </ul>

@if(strpos(auth()->user()->eid, 'F') !== false)
    <!-- Code to show if eid contains 'F' -->

         <a href="#" class="sl-menu-link">
          <div class="sl-menu-item">
     <i class="fa fa-group"></i>
            <span class="menu-item-label">HR (Faculty)</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
        <ul class="sl-menu-sub nav flex-column">
       
          <li class="nav-item"><a href="{{route('HRM.index')}}" class="nav-link">Appl. for Internal Promotion</a></li>

   
   
        </ul>

  @endif




       


        <!-- <a href="#" class="sl-menu-link">
          <div class="sl-menu-item">
            
            <i class="fa fa-bullhorn"></i>
            <span class="menu-item-label">Pending Advances</span>
            <i class="menu-item-arrow fa fa-angle-down"></i>
          </div>
        </a>
        <ul class="sl-menu-sub nav flex-column">
          <li class="nav-item"><a href="{{url('pendingta')}}" class="nav-link">Travel Advances</a></li>
          <li class="nav-item"><a href="{{url('pendingta')}}" class="nav-link">Temporary Advances</a></li> 
        </ul> -->
     
        @can('voucher-edit')
     <!-- <a href="http://192.168.140.12/accounts/" target="_Blank" class="nav-link">Old ERP</a> -->

     <a href="https://package.accounts.iith.ac.in/accounts/" target="_Blank" class="sl-menu-link">
          <div class="sl-menu-item">
            
            <i class="fa fa-external-link"></i>
            <span class="menu-item-label">Old ERP</span>
            
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->

        <a href="{{url('indexlink')}}" target="_Blank" class="sl-menu-link">
          <div class="sl-menu-item">
            
            <i class="fa fa-external-link"></i>
            <span class="menu-item-label">Google Sheets</span>
            
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
     
        @endcan
   <a href="{{url('https://accounts.iith.ac.in')}}" target="_Blank" class="sl-menu-link">
          <div class="sl-menu-item">
            
            <i class="fa fa-globe" style="font-size:20px"></i>
            <span class="menu-item-label">About</span>
            
          </div><!-- menu-item -->
        </a><!-- sl-menu-link -->
      </div><!-- sl-sideleft-menu -->

      <br>
    </div>