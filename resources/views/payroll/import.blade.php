@extends('project.admin_master')

@section('project')
<br><br><br><br><br><br>
<div class="container">
    <h4>Import Add Income Data</h4>
    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="alert alert-danger">{{ implode(', ', $errors->all()) }}</div>
    @endif

     
     <br>
    <form action="{{ route('addincome.import') }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="file" class="form-label">Choose Excel File</label> 

            <input type="file" name="file" class="form-control" accept=".xlsx, .xls, .csv" required>
        </div>
        <button class="btn btn-primary">Upload</button> <a href="{{ asset('Bulk upload template.xlsx') }}" 
   style="padding: 10px 20px; background-color: green; color: white; text-decoration: none; border-radius: 5px;">
   Download Excel Template
</a>
    </form>

   
    


<br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
@endsection