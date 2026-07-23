@extends('project.admin_master')

@section('project')

<style>
body {
    background: #f4f6f9;
    font-family: 'Segoe UI', sans-serif;
}

/* CARD */
.report-card {
    background: #fff;
    border-radius: 10px;
    box-shadow: 0 4px 12px rgba(0,0,0,0.08);
    padding: 20px;
}

/* HEADER */
.report-header {
    border-bottom: 2px solid #e3e6ea;
    margin-bottom: 20px;
    padding-bottom: 10px;
}

.report-title {
    font-size: 18px;
    font-weight: 600;
    color: #2c3e50;
}

/* FORM */
.form-label {
    font-size: 13px;
    font-weight: 600;
    color: #34495e;
}

.form-control {
    border-radius: 6px;
    font-size: 13px;
}

/* BUTTON */
.btn-report {
    background: #34495e;
    color: #fff;
    border-radius: 6px;
    padding: 6px 15px;
    border: none;
}

.btn-report:hover {
    background: #1abc9c;
    color: #fff;
}

/* QUICK BUTTONS */
.quick-btns button {
    margin-right: 5px;
}
</style>

<div class="sl-mainpanel">

    <!-- Breadcrumb -->
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item">Reports</a>
        <a class="breadcrumb-item">Ledger</a>
        <span class="breadcrumb-item active">Generate</span>
    </nav>

    <div class="row justify-content-center">
        <div class="col-lg-6">

            <div class="report-card">

                <!-- HEADER -->
                <div class="report-header">
                    <div class="report-title">
                        Select Report Period
                    </div>
                </div>

                <!-- FORM -->
                <form action="{{ url('ledger1') }}" method="GET">

                    <!-- DATE FIELDS -->
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-label">From Date</label>
                                <input type="date" class="form-control"
                                       name="from"
                                       value="{{ date('Y-m-01') }}"
                                       required>
                            </div>
                        </div>

                        <div class="col-sm-6">
                            <div class="form-group">
                                <label class="form-label">To Date</label>
                                <input type="date" class="form-control"
                                       name="to"
                                       value="{{ date('Y-m-d') }}"
                                       required>
                            </div>
                        </div>
                    </div>

                    <!-- QUICK BUTTONS -->
                    <div class="quick-btns mt-2 mb-3">
                        <button type="button" class="btn btn-sm btn-outline-secondary" onclick="setToday()">Today</button>
                        <button type="button" class="btn btn-sm btn-outline-secondary" onclick="setMonth()">This Month</button>
                        <button type="button" class="btn btn-sm btn-outline-secondary" onclick="setFY()">Financial Year</button>
                    </div>

                    <!-- BANK -->
                    <div class="form-group">
                        <label class="form-label">Select Bank</label>
                        <select name="bank" class="form-control" required>
                            <option value="">-- Select Bank --</option>
                            <option value="all">All Banks</option>

                            @foreach ($bud as $buds)
                                <option value="{{$buds->id}}">
                                    {{$buds->name}}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- BUTTON -->
                    <div class="text-end mt-4">
                        <button type="submit" class="btn btn-report">
                            Generate Report
                        </button>
                    </div>

                </form>

            </div>

        </div>
    </div>

<br><br><br><br><br><br>

<!-- SCRIPT -->
<script>
function formatDate(date) {
    let d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;

    return [year, month, day].join('-');
}

// Today
function setToday() {
    let today = formatDate(new Date());
    document.querySelector('[name="from"]').value = today;
    document.querySelector('[name="to"]').value = today;
}

// This Month
function setMonth() {
    let now = new Date();
    let firstDay = new Date(now.getFullYear(), now.getMonth(), 1);

    document.querySelector('[name="from"]').value = formatDate(firstDay);
    document.querySelector('[name="to"]').value = formatDate(now);
}

// Financial Year (India)
function setFY() {
    let now = new Date();
    let year = now.getMonth() < 3 ? now.getFullYear() - 1 : now.getFullYear();

    let from = new Date(year, 3, 1); // April 1
    let to = new Date(year + 1, 2, 31); // March 31

    document.querySelector('[name="from"]').value = formatDate(from);
    document.querySelector('[name="to"]').value = formatDate(to);
}
</script>

@endsection
