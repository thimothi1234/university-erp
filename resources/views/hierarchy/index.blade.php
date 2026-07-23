 <!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Financial Hierarchy Dashboard</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
<style>
:root {
--primary: #4361ee;
--secondary: #3f37c9;
--success: #4cc9f0;
--bg-gradient: linear-gradient(135deg, #f5f7fa 0%, #c3cfe2 100%);
--card-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
}

body {
background: var(--bg-gradient);
padding: 1rem;
font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.dashboard-header {
background: linear-gradient(120deg, var(--primary), var(--secondary));
color: white;
border-radius: 12px;
padding: 1.5rem;
margin-bottom: 1.5rem;
box-shadow: var(--card-shadow);
}

.card {
border-radius: 12px;
box-shadow: var(--card-shadow);
border: none;
margin-bottom: 1.5rem;
}

.stat-card {
text-align: center;
padding: 1.5rem;
}

.stat-value {
font-size: 2.2rem;
font-weight: 700;
color: var(--primary);
margin: 10px 0;
}

.table-wrapper {
background: #fff;
border-radius: 12px;
overflow: hidden;
box-shadow: var(--card-shadow);
}

.parent-row {
background-color: rgba(67, 97, 238, 0.05);
border-left: 4px solid var(--primary);
cursor: pointer;
}

.child-row {
background-color: rgba(76, 201, 240, 0.08);
border-left: 4px solid var(--success);
cursor: pointer;
}

            .expand-icon {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: var(--bs-primary); /* Bootstrap primary */
            color: white;
        }

        .expand-icon1 {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: var(--bs-success); /* Bootstrap success */
            color: white;
        }

        .expand-icon2 {
            display: inline-flex;
            align-items: center;
            justify-content: center;
            width: 24px;
            height: 24px;
            border-radius: 50%;
            background: var(--bs-danger); /* Bootstrap info */
            color: white;
        }
.progress-bar {
height: 8px;
border-radius: 4px;
background-color: #e9ecef;
}

.progress-value {
height: 100%;
border-radius: 4px;
background: linear-gradient(to right, var(--success), var(--primary));
}

.loading-indicator {
text-align: center;
padding: 15px;
color: #4361ee;
}
</style>
</head>
<body>
    <div class="mb-3">
    <a href="{{ url()->previous() }}" class="btn btn-secondary">
        <i class="fas fa-arrow-left me-1"></i> Back
    </a>
</div>
<div class="container-fluid">
<!-- Dashboard Header -->
<div class="dashboard-header">
<div class="row align-items-center">
<div class="col-md-6">
<h1><i class="fas fa-sitemap me-3"></i>Budget wise funds status</h1>
</div>
</div>
</div>
<div class="card mb-3">
    <div class="card-body">
        <form id="filterForm" class="row g-3">
            <div class="col-md-4">
                <label for="bank" class="form-label">Bank</label>
                <select name="bank" id="bank" class="form-select">
                    <option value="">-- Select Bank --</option>
                    @foreach($banks as $id => $name)
                        <option value="{{ $id }}" {{ request('bank') == $id ? 'selected' : '' }}>{{ $name }}</option>

                    @endforeach
                </select>
            </div>
            <div class="col-md-3">
                <label for="from" class="form-label">From</label>
              <input type="date" name="from" id="from" class="form-control" value="{{ request('from') }}">
            </div>
            <div class="col-md-3">
                <label for="to" class="form-label">To</label>
          <input type="date" name="to" id="to" class="form-control" value="{{ request('to') }}">
            </div>
            <div class="col-md-2 d-flex align-items-end">
                <button type="submit" class="btn btn-primary w-100">Filter</button>
            </div>
        </form>
    </div>
</div>

<!-- Stats Summary -->
<div class="row mb-4">
@php
$totalBudget = $parents->sum(function($item) {
return floatval($item->sanctioned);
});

$totalUtilized = $parents->sum(function($item) {
return floatval($item->count);
});

$utilizationPercentage = ($totalBudget > 0) ? ($totalUtilized / $totalBudget) * 100 : 0;
@endphp



<!-- Main Table -->
<div class="card">
<div class="card-body p-0">
<div class="table-wrapper">
    <div id="loading" class="loading-indicator d-none">
    <i class="fas fa-spinner fa-spin"></i> Loading...
</div>

<table class="table table-hover parent-dt mb-0">
<thead>
<tr>
<th style="width: 40px;"></th>
<th>Budget Head</th>
<th>Budget (₹)</th>
<th>Utilized (₹)</th>
<th>Progress</th>
</tr>
</thead>
<tbody>
@foreach ($parents as $parent)
@php
$sanctioned = floatval($parent->sanctioned);
$count = floatval($parent->count);
$progress = ($sanctioned > 0) ? ($count / $sanctioned) * 100 : 0;
@endphp
<tr class="expandable parent-row" data-id="{{ $parent->id }}">
<td><span class="expand-icon"><i class="fas fa-chevron-right"></i></span></td>
<td>{{ $parent->name }}</td>
<td>₹{{ number_format($sanctioned, 2) }}</td>
<td>₹{{ number_format($count, 2) }}</td>
<td>
<div class="progress-bar">
<div class="progress-value" style="width: {{ $progress }}%"></div>
</div>
</td>
</tr>
<tr class="child-container" id="children-{{ $parent->id }}"></tr>
@endforeach
</tbody>
</table>
</div>
</div>
</div>
</div>


<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- DataTables -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<!-- Font Awesome (optional, already in your code) -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/js/all.min.js"></script>

<!-- Your custom script here -->


<script>
const safeUrl = (path, id) => {
    const base = "{{ urlencode(url('')) }}";
    return decodeURIComponent(base) + '/' + path + '/' + id;
};





function setIcon($row, level, expanded) {
    const icon = expanded 
        ? (level === 'parent' ? 'fa-chevron-down' : 'fa-minus')
        : (level === 'parent' ? 'fa-chevron-right' : 'fa-plus');
    $row.find(`.expand-icon${level === 'child' ? '1' : ''} i`)
        .removeClass('fa-chevron-down fa-chevron-right fa-plus fa-minus')
        .addClass(icon);
}

// Parent click → load child rows
$(document).on('click', '.parent-row', function () {
    const $row = $(this);
    if ($row.hasClass('loading')) return;

    const parentId = $row.data('id');
    const container = $('#children-' + parentId);

    if ($row.hasClass('expanded')) {
        container.html('');
        $row.removeClass('expanded');
        setIcon($row, 'parent', false);
        return;
    }

    $row.addClass('loading');
    setIcon($row, 'parent', true);
    container.html(`<td colspan="5"><div class="loading-indicator"><i class="fas fa-spinner fa-spin"></i> Loading...</div></td>`);

   const bank = $('#bank').val();
const from = $('#from').val();
const to = $('#to').val();
$.get(safeUrl('children', parentId) + `?bank=${bank}&from=${from}&to=${to}`, function (response) {

        let html = `<td colspan="5" class="p-0 border-0">
        <div class="nested-table-container">
        <table class="table table-sm mb-0 child-dt nested-datatable">
        <thead><tr>
        <th></th><th>ID</th><th>Subhead</th><th>Amount</th>
        </tr></thead><tbody>`;

        response.data.forEach(child => {
            html += `<tr class="expandable child-row" data-id="${child.id}" data-base="${response.base_url}">
            <td class="ps-4"><span class="expand-icon1"><i class="fas fa-plus"></i></span></td>
            <td>${child.id}</td>
            <td>${child.name}</td>
            <td>${child.count}</td>
            </tr>
            <tr class="grandchild-container" id="grandchildren-${child.id}"></tr>`;
        });

        html += `</tbody></table></div></td>`;
        container.html(html);
        $row.addClass('expanded').removeClass('loading');
        setIcon($row, 'parent', true);

        const dataTable = initializeNestedTable(`#children-${parentId} .child-dt`);
        dataTable.columns.adjust().responsive.recalc();
    });
});

// Child click → load grandchild rows
$(document).on('click', '.child-row', function () {
    const $row = $(this);
    if ($row.hasClass('loading')) return;

    const childId = $row.data('id');
    const baseUrl = decodeURIComponent($row.data('base'));
    const container = $('#grandchildren-' + childId);

    if ($row.hasClass('expanded')) {
        container.html('');
        $row.removeClass('expanded');
        setIcon($row, 'child', false);
        return;
    }

    $row.addClass('loading');
    setIcon($row, 'child', true);
    container.html(`<td colspan="5"><div class="loading-indicator"><i class="fas fa-spinner fa-spin"></i> Loading...</div></td>`);

   const bank = $('#bank').val();
const from = $('#from').val();
const to = $('#to').val();
const parentId = $row.closest('.child-container').prev('.parent-row').data('id') || 0;
$.get(`${baseUrl}/grandchildren/${childId}/${parentId}?bank=${bank}&from=${from}&to=${to}`, function (response) {


        let html = `<td colspan="5" class="p-0 border-0">
        <div class="nested-table-container">
        <table class="table table-sm mb-0 grandchild-dt nested-datatable">
        <thead><tr>
        <th></th><th></th><th>Voucher No</th><th>Vendor Name</th><th>Amount</th>
        </tr></thead><tbody>`;

        response.data.forEach(gc => {
            html += `<tr class="grandchild-row">
            <td class="ps-5"><span class="expand-icon2"><i class="fas fa-circle"></i></span></td>
            <td class="ps-5"></td>
            <td>${gc.id}</td>
            <td>${gc.name}</td>
            <td>${gc.count}</td>
            </tr>`;
        });

        html += `</tbody></table></div></td>`;
        container.html(html);
        $row.addClass('expanded').removeClass('loading');
        setIcon($row, 'child', true);

        const dataTable = initializeNestedTable(`#grandchildren-${childId} .grandchild-dt`);
        dataTable.columns.adjust().responsive.recalc();
    });
});
</script>
<script>
$('#filterForm').on('submit', function(e) {
    e.preventDefault();
    $('#loading').removeClass('d-none');
    this.submit(); // let the form submit normally after showing loading
});
$('#bank, #from, #to').on('change', function () {
    $('#filterForm').submit();
});

</script>

</body>
</html>