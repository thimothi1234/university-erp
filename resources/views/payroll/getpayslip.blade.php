@extends('project.admin_master')

@section('project')
<form action="" method="GET">
  <!-- Name Dropdown -->
<select id="employee_name" name="name">
    <option value="">Select Name</option>
    @foreach($names as $name)
        <option value="{{ $name->name }}">{{ $name->name }}</option>
    @endforeach
</select>

<!-- Month Dropdown -->
<select id="month_with_year" name="month">
    <option value="">Select Month</option>
</select>


    <button type="submit">Fetch Payslip</button>
</form>

<!-- -->
@endsection