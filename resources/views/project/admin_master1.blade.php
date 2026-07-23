


<!-- new -->



    <!-- vendor css -->
   
  </head>

  <body>

    <!-- ########## START: LEFT PANEL ########## -->
    <!-- sl-sideleft -->
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
              <span class="logged-name">{{{ Auth::user()->names->name }}}</span></span>
              <img src="{{asset('includes/img/imgg.PNG')}}" class="wd-32 rounded-circle" alt="">
            </a>
            <div class="dropdown-menu dropdown-menu-header wd-200">
              <ul class="list-unstyled user-profile-nav">
                <!-- <li><a href=""><i class="icon ion-ios-person-outline"></i> Edit Profile</a></li>
                <li><a href=""><i class="icon ion-ios-gear-outline"></i> Settings</a></li>
                <li><a href=""><i class="icon ion-ios-download-outline"></i> Downloads</a></li>
                <li><a href=""><i class="icon ion-ios-star-outline"></i> Favorites</a></li>
                <li><a href=""><i class="icon ion-ios-folder-outline"></i> Collections</a></li> -->
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
  

   

  </body>
</html>
