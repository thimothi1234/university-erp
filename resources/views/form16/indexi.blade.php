@extends('project.admin_master')

@section('project')

<style>
/* ===== Scroll Banner ===== */
.scroll-container {
    width: 100%;
    overflow: hidden;
    white-space: nowrap;
    border-radius: 8px;
    background: linear-gradient(90deg, #4facfe, #00f2fe);
    padding: 10px;
    color: #fff;
    font-weight: 500;
}

.scroll-text {
    display: inline-block;
    padding-left: 100%;
    animation: scroll-left 18s linear infinite;
}

@keyframes scroll-left {
    0%   { transform: translateX(0); }
    100% { transform: translateX(-100%); }
}

/* ===== Card Styling ===== */
.custom-card {
    border-radius: 12px;
    box-shadow: 0 4px 15px rgba(0,0,0,0.08);
    border: none;
}

/* ===== Table Styling ===== */
.table-modern {
    width: 100%;
    border-collapse: collapse;
}

.table-modern thead {
    background: #343a40;
    color: #fff;
}

.table-modern th {
    padding: 12px;
    text-align: center;
    font-weight: 600;
}

.table-modern td {
    padding: 12px;
    text-align: center;
    vertical-align: middle;
}

.table-modern tbody tr {
    transition: 0.2s;
}

.table-modern tbody tr:hover {
    background-color: #f1f5ff;
}

/* ===== Button Styling ===== */
.btn-view {
    background: #4facfe;
    color: #fff;
    border-radius: 20px;
    padding: 6px 16px;
    transition: 0.3s;
    font-size: 14px;
}

.btn-view:hover {
    background: #00c6ff;
    color: #fff;
}

/* ===== Responsive ===== */
@media (max-width: 768px) {
    .table-modern th, .table-modern td {
        font-size: 13px;
        padding: 8px;
    }
}
</style>

<div class="sl-mainpanel">

    <!-- Breadcrumb -->
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="#">Claim</a>
        <a class="breadcrumb-item" href="#">Bills</a>
        <span class="breadcrumb-item active">View</span>
    </nav>

    <!-- Scroll Banner -->
    <div class="scroll-container mb-3">
        <div class="scroll-text">✨Payslips for June 2026 were uploaded✨</div>
    </div>

    <!-- Card -->
    <div class="card custom-card pd-20 pd-sm-40">

        <div class="card-header d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Pay Slip {{ $id }}</h4>
        </div>

        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show mt-3" role="alert">
                {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert">&times;</button>
            </div>
        @endif

        <!-- Table -->
        <div class="table-responsive mt-3">
            <table class="table table-modern">
                <thead>
                    <tr>
                        <th>Month</th>
                        <th>Pay Slip PDF</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($payorders as $payorder)
                        <tr>
                            <td>{{ $payorder->month }}</td>
                            <td>
                                <a href="{{ url('show2/'.$payorder->pay_id) }}" 
                                   class="btn btn-view">
                                   View
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2">No Payslips Available</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

    </div>

</div>

@endsection
