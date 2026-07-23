@extends('project.admin_master')

@section('project')
  <style>
/* ===== Dashboard Base ===== */
.dashboard-card {
    background: #ffffff;
    border-radius: 10px;
    padding: 22px;
    box-shadow: 0 2px 10px rgba(0,0,0,.06);
}

/* ===== KPI Cards ===== */
.kpi-card {
    border-radius: 10px;
    padding: 18px 20px;
    height: 120px;
    position: relative;
    color: #fff;
    overflow: hidden;
}

.kpi-card h3 {
    font-size: 26px;
    font-weight: 700;
    margin: 0;
}

.kpi-card span {
    font-size: 13px;
    opacity: .9;
}

.kpi-icon {
    position: absolute;
    right: 15px;
    top: 18px;
    font-size: 38px;
    opacity: .25;
}

/* ===== Card Colors (ElaAdmin style) ===== */
.bg-green { background: #2ecc71; }
.bg-purple { background: #9b59b6; }
.bg-blue { background: #3498db; }
.bg-orange { background: #f39c12; }
.bg-red { background: #e74c3c; }
.bg-teal { background: #1abc9c; }

/* ===== Section Title ===== */
.section-title {
    font-size: 18px;
    font-weight: 600;
    margin-bottom: 15px;
}

/* ===== Scroll text ===== */
.scroll-container {
    background: #f1f5f9;
    padding: 10px;
    overflow: hidden;
    white-space: nowrap;
    border-radius: 6px;
    margin-top: 20px;
}
.scroll-text {
    display: inline-block;
    animation: scroll-left 18s linear infinite;
}
@keyframes scroll-left {
    0% { transform: translateX(100%); }
    100% { transform: translateX(-100%); }
}
</style>


  <div class="sl-mainpanel">
      <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="index.html">IIT Hyderabad</a>
        <span class="breadcrumb-item active">F&A</span>
      </nav>

@if(!is_null($P6))

<div class="dashboard-card mb-4">
    <div class="section-title">Vouchers Summary</div>

    <div class="row g-3">
        <div class="col-md-3 col-lg-2">
            <div class="kpi-card bg-green">
                <i class="fa fa-clock kpi-icon"></i>
                <h3>{{ $P1 }}</h3>
                <span>Pending with AR</span>
            </div>
        </div>

        <div class="col-md-3 col-lg-2">
            <div class="kpi-card bg-purple">
                <i class="fa fa-clock kpi-icon"></i>
                <h3>{{ $P2 }}</h3>
                <span>Pending with DR</span>
            </div>
        </div>

        <div class="col-md-3 col-lg-2">
            <div class="kpi-card bg-blue">
                <i class="fa fa-user-check kpi-icon"></i>
                <h3>{{ $P3 }}</h3>
                <span>Pending with DDO</span>
            </div>
        </div>

        <div class="col-md-3 col-lg-2">
            <div class="kpi-card bg-orange">
                <i class="fa fa-cash-register kpi-icon"></i>
                <h3>{{ $P4 }}</h3>
                <span>Pending with Cashier</span>
            </div>
        </div>

        <div class="col-md-3 col-lg-2">
            <div class="kpi-card bg-teal">
                <i class="fa fa-check-circle kpi-icon"></i>
                <h3>{{ $P5 }}</h3>
                <span>Vouchers Paid</span>
            </div>
        </div>

        <div class="col-md-3 col-lg-2">
            <div class="kpi-card bg-red">
                <i class="fa fa-list kpi-icon"></i>
                <h3>{{ $P6 }}</h3>
                <span>Total Processed</span>
            </div>
        </div>
    </div>
</div>




   <div class="dashboard-card mb-4">
    <div class="section-title">Advances Summary</div>

    <div class="row g-3">
        <div class="col-md-4 col-lg-3">
            <div class="kpi-card bg-orange">
                <i class="fa fa-hourglass-half kpi-icon"></i>
                <h3>{{ $A3 - $A2 }}</h3>
                <span>Pending Advances</span>
            </div>
        </div>

        <div class="col-md-4 col-lg-3">
            <div class="kpi-card bg-green">
                <i class="fa fa-check kpi-icon"></i>
                <h3>{{ $A2 }}</h3>
                <span>Settled Advances</span>
            </div>
        </div>

        <div class="col-md-4 col-lg-3">
            <div class="kpi-card bg-blue">
                <i class="fa fa-layer-group kpi-icon"></i>
                <h3>{{ $A3 }}</h3>
                <span>Total Advances</span>
            </div>
        </div>
    </div>
</div>
@endif



     <div class="scroll-container">
        <div class="scroll-text">✨Payslips for June 2026 were uploaded✨</div>
</div>

      <img src="homelogo.jpg" alt="Girl in a jacket" style="width:800px;height:532px;">
  
@endsection
