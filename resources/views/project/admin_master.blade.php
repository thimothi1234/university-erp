


<!-- new -->

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">



    <!-- Meta -->
    <meta name="description" content="Premium Quality and Responsive UI for Dashboard.">
    <meta name="author" content="ThemePixels">

    <title>IIT Hyderabad ERP</title>

    <!-- vendor css -->
    <link href="{{asset('includes/lib/font-awesome/css/font-awesome.css')}}" rel="stylesheet">
    <link href="{{asset('includes/lib/Ionicons/css/ionicons.css')}}" rel="stylesheet">
    <link href="{{asset('includes/lib/perfect-scrollbar/css/perfect-scrollbar.css')}}" rel="stylesheet">
    <link href="{{asset('includes/lib/highlightjs/github.css')}}" rel="stylesheet">
    <link href="{{asset('includes/lib/datatables/jquery.dataTables.css')}}" rel="stylesheet">
    <link href="{{asset('includes/lib/select2/css/select2.min.css')}}" rel="stylesheet">
    <script src="{{asset('select2/dist/js/select2.min.js')}}" type="text/javascript"></script>
<link rel="stylesheet" type="text/css" href="{{asset('select2/dist/css/select2.min.css')}}">
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<link href="{{asset('includes/lib/rickshaw/rickshaw.min.css')}}" rel="stylesheet">


    <!-- Starlight CSS -->
    <link rel="stylesheet" href="{{asset('includes/css/starlight.css')}}">
  </head>

  <body>

    <!-- ########## START: LEFT PANEL ########## -->
    @include('project.body.sidebar')<!-- sl-sideleft -->
    <!-- ########## END: LEFT PANEL ########## -->

    <!-- ########## START: HEAD PANEL ########## -->
    <div class="sl-header">
    
      <div class="sl-header-left">
        <div class="navicon-left hidden-md-down"><a id="btnLeftMenu" href=""><i class="icon ion-navicon-round"></i></a></div>
        <div class="navicon-left hidden-lg-up"><a id="btnLeftMenuMobile" href=""><i class="icon ion-navicon-round"></i></a></div>
        
      </div><!-- sl-header-left -->
      <!-- <strong style="float:left;"> Finance & Accounts</strong> -->
      <div class="sl-header-right">
        <nav class="nav">
          <div class="dropdown">
         
            <a href="" class="nav-link nav-link-profile" data-toggle="dropdown">
              <span class="logged-name">{{ Auth::user()->names->name }}</span></span>
              <img src="{{asset('includes/img/imgg.PNG')}}" class="wd-32 rounded-circle" alt="">
            </a>

            
            <div class="dropdown-menu dropdown-menu-header wd-200">
              <ul class="list-unstyled user-profile-nav">
                <?php $user_id = Auth::user()->id; ?>
                 <li><a href="{{ route('users.edit',$user_id) }}"><i class="icon ion-ios-person-outline"></i> Change Password</a></li>
               
                <li>

                <a  href="{{ route('logout') }}" 
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="icon ion-power"></i>
                                        {{ __('Logout') }}</li>
                                     
                                    </a>
              </ul>
              <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
            </div><!-- dropdown-menu -->
          </div><!-- dropdown -->

          
        </nav>
        <div class="navicon-right">
  
        </div><!-- navicon-right -->
      </div><!-- sl-header-right -->
    </div><!-- sl-header -->
    <!-- ########## END: HEAD PANEL ########## -->



    <!-- ########## START: MAIN PANEL ########## -->
   
      @yield('project')        
      <footer class="sl-footer">
        <div class="footer-left">
          <div class="mg-b-2" style = "font-size: 12px; color:black;">Copyright &copy; 2021.Finance & Accounts, IIT Hyderabad. All Rights Reserved.</div>
          <div style = "font-size: 15px; color:black;">Designed & Developed by Thimothi</div>
        </div>
        <div class="footer-right d-flex align-items-center">
          <!-- <span class="tx-uppercase mg-r-10">Reach:</span> -->
          <!-- <a target="_blank" class="pd-x-5" href="https://www.facebook.com/ch.thimothi"><i class="fa fa-facebook tx-20"></i></a>
          <a target="_blank" class="pd-x-5" href="https://twitter.com/chidruppa"><i class="fa fa-twitter tx-20"></i></a> -->
        </div>
      </footer>
    </div><!-- sl-mainpanel -->
    <!-- ########## END: MAIN PANEL ########## -->



    <script src="{{asset('includes/lib/jquery/jquery.js')}}"></script>
    <script src="{{asset('includes/lib/popper.js/popper.js')}}"></script>
    <script src="{{asset('includes/lib/bootstrap/bootstrap.js')}}"></script>
    <script src="{{asset('includes/lib/perfect-scrollbar/js/perfect-scrollbar.jquery.js')}}"></script>
    <script src="{{asset('includes/lib/highlightjs/highlight.pack.js')}}"></script>
    <script src="{{asset('includes/lib/datatables/jquery.dataTables.js')}}"></script>
    <script src="{{asset('includes/lib/datatables-responsive/dataTables.responsive.js')}}"></script>
    <script src="{{asset('includes/lib/select2/js/select2.min.js')}}"></script>
    <script src="{{asset('includes/lib/rickshaw/rickshaw.min.js')}}"></script>
    <script src="{{asset('includes/js/starlight.js')}}"></script>

    <script>
      $(function(){
        'use strict';

        $('#datatable1').DataTable({
     
          responsive: true,

          scrollY:        "300px",
        scrollX:        true,
        scrollCollapse: true,
        paging:         true,
        bAutoWidth: true, 
  aoColumns : [
    { sWidth: '2%' },
    { sWidth: '3%' },
    { sWidth: '5%' },
    { sWidth: '5%' },
    { sWidth: '15%' },
    { sWidth: '60%' },
    { sWidth: '10%' }
  ],
         
          language: {
            searchPlaceholder: 'Search...',
            sSearch: '',
            lengthMenu: '_MENU_ items/page',
            dom: 'Bfrtip',
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ],
        aaSorting: [[0,'desc']],
            
          }
        });

        $('#datatable2').DataTable({
          bLengthChange: false,
          searching: false,
          responsive: true,
          dom: 'Bfrtip',
          buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ],
        aaSorting: [[0,'desc']],
        });

        // Select2
        $('.dataTables_length select').select2({ minimumResultsForSearch: Infinity });

      });
    </script>

  </body>
</html>
