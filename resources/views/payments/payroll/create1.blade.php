@extends('project.admin_master')

@section('project')

<style>

#change::-webkit-input-placeholder {
    /* WebKit, Blink, Edge */
    color: #FF0000;
}
#change:-moz-placeholder {
    /* Mozilla Firefox 4 to 18 */
    color: #FF0000;
    opacity: 1;
}
#change::-moz-placeholder {
    /* Mozilla Firefox 19+ */
    color: #FF0000;
    opacity: 1;
}
#change:-ms-input-placeholder {
    /* Internet Explorer 10-11 */
    color: #FF0000;
}

#other {
  display: none;
}

#oother {
  display: none;
}
</style>


<div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="{{route('voucher.index')}}">Voucher</a>
        <a class="breadcrumb-item" href="{{route('voucher.index')}}">Payments</a>
        <span class="breadcrumb-item active">Create</span>
      </nav>

                                <div class="row">
								<div class="col-lg-12">
                               
									<div class="card card-default">
										<div class="card-header card-header-border-bottom">
											<h4>Payment Voucher</h4>
										</div>
										<div class="card-body">
                                        <form action="{{ route('payroll.create') }}" method="GET">
    @csrf
    <label for="month_with_year">Select Month to Duplicate:</label>
    

    <select name="month_with_year" id="month_with_year" required>
        @foreach ($profiles as $profiles)
        <option value="{{$profiles->month_with_year}}">{{$profiles->month_with_year}}</option>
        @endforeach
    </select>


    <select name="month_with_year2" id="month_with_year" required>
        @foreach ($under as $profiles)
        <option value="{{$profiles->Under}}">{{$profiles->Under}}</option>
        @endforeach
    </select>

    <label for="monthYearDropdown">Select Month and Year:</label>
    <select id="monthYearDropdown" name="month_with_year1"></select>
    <button type="submit">Duplicate</button>
</form>

             
                    

                        
                    
                    </div></div>
  
                    <script>
        // Function to generate the month-year dropdown
        function generateMonthYearDropdown() {
            const dropdown = document.getElementById('monthYearDropdown');
            const currentDate = new Date();
            
            // Get last 6 months and next 6 months
            const monthsToShow = 12; 
            const monthNames = [
                "January", "February", "March", "April", "May", "June", 
                "July", "August", "September", "October", "November", "December"
            ];

            for (let i = -6; i <= 6; i++) {
                const date = new Date(currentDate.getFullYear(), currentDate.getMonth() + i, 1);
                const month = monthNames[date.getMonth()];
                const year = date.getFullYear();

                const option = document.createElement("option");
                option.value = `${month} ${year}`;
                option.text = `${month} ${year}`;
                dropdown.appendChild(option);
            }
        }

        // Call the function on page load
        window.onload = generateMonthYearDropdown;
    </script>
</body>
</html>









   @endsection
