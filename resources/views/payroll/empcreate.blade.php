@extends('layouts.app')

@section('content')
<div class="container">
    <form method="POST" action="{{ route('multi.store') }}" class="card p-4 shadow rounded">
        @csrf

        <h3 class="mb-4">Common Information</h3>
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Name *</label>
                <input name="name" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Bank Name</label>
                <input name="bank_name" class="form-control">
            </div>
            <div class="col-md-6">
                <label class="form-label">Branch</label>
                <input name="branch" class="form-control">
            </div>
            <div class="col-md-6">
                <label class="form-label">Account Number</label>
                <input name="account_number" class="form-control">
            </div>
            <div class="col-md-6">
                <label class="form-label">IFS Code</label>
                <input name="ifs_code" class="form-control">
            </div>
            <div class="col-md-6">
                <label class="form-label">Contact Number</label>
                <input name="contact_number" class="form-control">
            </div>
            <div class="col-md-6">
                <label class="form-label">Mail ID</label>
                <input name="mail_id" type="email" class="form-control">
            </div>
            <div class="col-md-6">
                <label class="form-label">PFMS Code</label>
                <input name="mail_id" type="email" class="form-control">
            </div>
            <div class="col-12">
                <label class="form-label">Address</label>
                <textarea name="address" class="form-control" rows="2"></textarea>
            </div>
        </div>

        <h3 class="mt-5 mb-4">Employee Information</h3>
        <div class="row g-3">
            <div class="col-md-4">
                <label class="form-label">Category</label>
                <input name="category_" class="form-control">
            </div>
            <div class="col-md-4">
                <label class="form-label">Designation</label>
                <input name="designationn" class="form-control">
            </div>
            <div class="col-md-4">
                <label class="form-label">Function</label>
                <input name="function" class="form-control">
            </div>
            <div class="col-md-4">
                <label class="form-label">Date of Joining</label>
                <input name="doj" type="date" class="form-control">
            </div>
             <div class="col-md-4">
                <label class="form-label">Date of Birth</label>
                <input name="doj" type="date" class="form-control">
            </div>
        </div>

        <h3 class="mt-5 mb-4">User Information</h3>
        <div class="row g-3">
            <div class="col-md-6">
                <label class="form-label">Email *</label>
                <input name="email" type="email" class="form-control" required>
            </div>
            <div class="col-md-6">
                <label class="form-label">Password *</label>
                <input name="password" type="password" class="form-control" required>
            </div>
        </div>

       

        <div class="mt-5">
            <button type="submit" class="btn btn-primary w-100">Submit All</button>
        </div>
    </form>
</div>
@endsection
