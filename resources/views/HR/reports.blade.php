@extends('project.admin_master')

@section('project')

<style>
    /* --- Compact Page Styling --- */
    .card {
        border-radius: 6px;
        box-shadow: 0 1px 3px rgba(0, 0, 0, 0.08);
        border: 1px solid #e0e0e0;
        margin-bottom: 15px;
    }
    .card-header {
        background: linear-gradient(135deg, #007bff, #0056b3);
        color: white;
        padding: 6px 12px;
        font-size: 14px;
        font-weight: 600;
        border-bottom: 1px solid #dee2e6;
    }
    
    /* One-line summary section */
    .summary-line {
        background-color: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 4px;
        padding: 6px 10px;
        margin-bottom: 12px;
        font-size: 13px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        flex-wrap: wrap;
    }
    .summary-item {
        display: flex;
        align-items: center;
        margin-right: 15px;
    }
    .summary-label {
        font-weight: 600;
        color: #495057;
        margin-right: 5px;
    }
    .summary-value {
        font-weight: 600;
        color: #007bff;
        background: #fff;
        padding: 1px 6px;
        border-radius: 3px;
        border: 1px solid #dee2e6;
        min-width: 20px;
        text-align: center;
    }
    .summary-divider {
        color: #dee2e6;
        margin: 0 5px;
    }
    .publication-type {
        display: inline-block;
        margin-left: 8px;
        font-size: 12px;
    }
    .journal-count {
        color: #28a745;
        font-weight: 600;
    }
    .conference-count {
        color: #dc3545;
        font-weight: 600;
    }
    
    /* Section styling */
    .section-title {
        font-size: 15px;
        font-weight: 600;
        color: #2c3e50;
        margin: 8px 0 5px;
        padding-bottom: 3px;
        border-bottom: 1px solid #007bff;
        display: inline-block;
    }
    .sub-section-title {
        font-size: 13px;
        color: #0056b3;
        font-weight: 600;
        margin: 10px 0 5px;
        background-color: #f0f7ff;
        padding: 4px 8px;
        border-radius: 3px;
    }
    .publication-section {
        margin-bottom: 8px;
        padding: 0 5px;
    }
    .publication-label {
        font-size: 12px;
        font-weight: 600;
        color: #495057;
        margin: 5px 0 3px;
        padding: 3px 8px;
        border-radius: 3px;
        display: inline-block;
    }
    .journal-label {
        background-color: #e8f5e8;
        color: #2d5016;
        border-left: 3px solid #28a745;
    }
    .conference-label {
        background-color: #e3f2fd;
        color: #0d47a1;
        border-left: 3px solid #2196f3;
    }
    
    /* Complete table color coding */
    .journal-table {
        background-color: #f1f8e9;
        border: 1px solid #c8e6c9;
        border-radius: 4px;
        margin-bottom: 10px;
        overflow: hidden;
    }
    .journal-table .table {
        background-color: #f1f8e9;
        margin-bottom: 0;
        border: none;
    }
    .journal-table .table thead th {
        background: #e8f5e8;
        color: #2d5016;
        border-bottom: 2px solid #c8e6c9;
        border-right: 1px solid #c8e6c9;
    }
    .journal-table .table thead th:last-child {
        border-right: none;
    }
    .journal-table .table tbody tr {
        background-color: #f1f8e9;
    }
    .journal-table .table tbody tr:nth-of-type(even) {
        background-color: #e8f5e8;
    }
    .journal-table .table tbody tr:hover {
        background-color: #dcedc8;
    }
    .journal-table .table th,
    .journal-table .table td {
        border: 1px solid #c8e6c9;
        border-bottom: 1px solid #c8e6c9;
        border-right: 1px solid #c8e6c9;
    }
    .journal-table .table th:last-child,
    .journal-table .table td:last-child {
        border-right: none;
    }
    
    .conference-table {
        background-color: #e1f5fe;
        border: 1px solid #bbdefb;
        border-radius: 4px;
        margin-bottom: 10px;
        overflow: hidden;
    }
    .conference-table .table {
        background-color: #e1f5fe;
        margin-bottom: 0;
        border: none;
    }
    .conference-table .table thead th {
        background: #e3f2fd;
        color: #0d47a1;
        border-bottom: 2px solid #bbdefb;
        border-right: 1px solid #bbdefb;
    }
    .conference-table .table thead th:last-child {
        border-right: none;
    }
    .conference-table .table tbody tr {
        background-color: #e1f5fe;
    }
    .conference-table .table tbody tr:nth-of-type(even) {
        background-color: #e3f2fd;
    }
    .conference-table .table tbody tr:hover {
        background-color: #b3e5fc;
    }
    .conference-table .table th,
    .conference-table .table td {
        border: 1px solid #bbdefb;
        border-bottom: 1px solid #bbdefb;
        border-right: 1px solid #bbdefb;
    }
    .conference-table .table th:last-child,
    .conference-table .table td:last-child {
        border-right: none;
    }
    
    /* Base table styling */
    .table {
        font-size: 11px;
        margin-bottom: 8px;
        border-collapse: separate;
        border-spacing: 0;
    }
    .table th, .table td {
        padding: 4px 6px !important;
        vertical-align: middle;
    }
    .table thead th {
        text-align: center;
        font-weight: 600;
    }
    
    /* Alert and general styling */
    .alert {
        font-size: 12px;
        padding: 6px 10px;
        margin-bottom: 10px;
    }
    .sl-mainpanel {
        padding: 8px 12px;
    }
    .breadcrumb {
        margin-bottom: 10px;
        padding: 4px 10px;
        font-size: 13px;
    }
</style>

<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb mb-2">
        <a class="breadcrumb-item" href="">HR</a>
        <span class="breadcrumb-item active">Faculty Publications</span>
    </nav>

    <div class="card">
        <div class="card-header">Publications & Conference Proceedings of {{$application->name}}</div>
        <div class="card-body">

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
                </div>
            @endif

            <!-- One-line Summary Section -->
            <div class="summary-line">
                <div class="summary-item">
                    <span class="summary-label">Total:</span>
                    <span class="summary-value">
                        @php
                            $total = 0;
                            foreach($categorizedPublications as $section) {
                                $total += count($section);
                            }
                            echo $total;
                        @endphp
                    </span>
                    <span class="publication-type">
                        (<span class="journal-count">
                            @php
                                $journalTotal = 0;
                                $conferenceTotal = 0;
                                foreach($categorizedPublications as $key => $section) {
                                    if (strpos($key, 'journal') !== false) {
                                        $journalTotal += count($section);
                                    } else if (strpos($key, 'conference') !== false) {
                                        $conferenceTotal += count($section);
                                    }
                                }
                                echo "Journals :" . $journalTotal;
                            @endphp
                        </span>
                        <span class="conference-count">
                            @php
                                echo "  Conferences :" . $conferenceTotal;
                            @endphp
                        </span>)
                    </span>
                </div>
                
                <span class="summary-divider">|</span>
                
                @if($application->post === 'Associate Professor')
                    <div class="summary-item">
                        <span class="summary-label">Sec A:</span>
                        <span class="summary-value">
                            {{ count($categorizedPublications['section_a_journal'] ?? []) + count($categorizedPublications['section_a_conference'] ?? []) }}
                        </span>
                        <span class="publication-type">
                            (<span class="journal-count">Journals :{{ count($categorizedPublications['section_a_journal'] ?? []) }}</span>
                            <span class="conference-count"> Conference Proceedings :{{ count($categorizedPublications['section_a_conference'] ?? []) }}</span>)
                        </span>
                    </div>
                    
                    <span class="summary-divider">|</span>
                    
                    <div class="summary-item">
                        <span class="summary-label">Sec B:</span>
                        <span class="summary-value">
                            {{ count($categorizedPublications['section_b_journal'] ?? []) + count($categorizedPublications['section_b_conference'] ?? []) }}
                        </span>
                        <span class="publication-type">
                            (<span class="journal-count">Journals :{{ count($categorizedPublications['section_b_journal'] ?? []) }}</span>
                            <span class="conference-count"> Conference Proceedings :{{ count($categorizedPublications['section_b_conference'] ?? []) }}</span>)
                        </span>
                    </div>
                @else
                    <div class="summary-item">
                        <span class="summary-label">Sec A:</span>
                        <span class="summary-value">
                            {{ count($categorizedPublications['section_a_journal'] ?? []) + count($categorizedPublications['section_a_conference'] ?? []) }}
                        </span>
                        <span class="publication-type">
                            (<span class="journal-count">Journals :{{ count($categorizedPublications['section_a_journal'] ?? []) }}</span>
                            <span class="conference-count"> Conference Proceedings :{{ count($categorizedPublications['section_a_conference'] ?? []) }}</span>)
                        </span>
                    </div>
                    
                    <span class="summary-divider">|</span>
                    
                    <div class="summary-item">
                        <span class="summary-label">Sec B:</span>
                        <span class="summary-value">
                            {{ count($categorizedPublications['section_b_journal'] ?? []) + count($categorizedPublications['section_b_conference'] ?? []) }}
                        </span>
                        <span class="publication-type">
                            (<span class="journal-count">Journals :{{ count($categorizedPublications['section_b_journal'] ?? []) }}</span>
                            <span class="conference-count"> Conference Proceedings :{{ count($categorizedPublications['section_b_conference'] ?? []) }}</span>)
                        </span>
                    </div>
                    
                    <span class="summary-divider">|</span>
                    
                    <div class="summary-item">
                        <span class="summary-label">Sec C :</span>
                        <span class="summary-value">
                            {{ count($categorizedPublications['section_c_journal'] ?? []) + count($categorizedPublications['section_c_conference'] ?? []) }}
                        </span>
                        <span class="publication-type">
                            (<span class="journal-count">Journals :{{ count($categorizedPublications['section_c_journal'] ?? []) }}</span>
                            <span class="conference-count"> Conference Proceedings :{{ count($categorizedPublications['section_c_conference'] ?? []) }}</span>)
                        </span>
                    </div>
                    
                    <span class="summary-divider">|</span>
                    
                    <div class="summary-item">
                        <span class="summary-label">Sec D:</span>
                        <span class="summary-value">
                            {{ count($categorizedPublications['section_d_journal'] ?? []) + count($categorizedPublications['section_d_conference'] ?? []) }}
                        </span>
                        <span class="publication-type">
                            (<span class="journal-count">Journals :{{ count($categorizedPublications['section_d_journal'] ?? []) }}</span>
                            <span class="conference-count"> Conference Proceedings :{{ count($categorizedPublications['section_d_conference'] ?? []) }}</span>)
                        </span>
                    </div>
                @endif
            </div>

            <div class="table-responsive">
                <div class="section-title">6. Publications</div>

                {{-- CONDITIONAL: Associate Professor --}}
                @if($application->post === 'Associate Professor')
                    <div class="sub-section-title">6A: For Assistant Professor to Associate Professor</div>

                    {{-- SECTION A --}}
                    <div class="sub-section-title">Section A: After joining IITH (No IITH student co-author)</div>
                    <div class="publication-section">
                        <div class="publication-label journal-label">Journal Publications</div>
                        <div class="journal-table">
                            @include('hr.partials.publication_table', ['data' => $categorizedPublications['section_a_journal']])
                        </div>

                        <div class="publication-label conference-label">Conference Proceedings</div>
                        <div class="conference-table">
                            @include('hr.partials.conference_table', ['data' => $categorizedPublications['section_a_conference']])
                        </div>
                    </div>

                    {{-- SECTION B --}}
                    <div class="sub-section-title">Section B: After joining IITH (With IITH student co-authors)</div>
                    <div class="publication-section">
                        <div class="publication-label journal-label">Journal Publications</div>
                        <div class="journal-table">
                            @include('hr.partials.publication_table', ['data' => $categorizedPublications['section_b_journal']])
                        </div>

                        <div class="publication-label conference-label">Conference Proceedings</div>
                        <div class="conference-table">
                            @include('hr.partials.conference_table', ['data' => $categorizedPublications['section_b_conference']])
                        </div>
                    </div>

                @else
                    {{-- ASP to Professor --}}
                    <div class="sub-section-title">6B: For Associate Professor to Professor</div>

                    {{-- SECTION A --}}
                    <div class="sub-section-title">Section A: Before becoming ASP (No IITH student co-author)</div>
                    <div class="publication-section">
                        <div class="publication-label journal-label">Journal Publications</div>
                        <div class="journal-table">
                            @include('hr.partials.publication_table', ['data' => $categorizedPublications['section_a_journal']])
                        </div>

                        <div class="publication-label conference-label">Conference Proceedings</div>
                        <div class="conference-table">
                            @include('hr.partials.conference_table', ['data' => $categorizedPublications['section_a_conference']])
                        </div>
                    </div>

                    {{-- SECTION B --}}
                    <div class="sub-section-title">Section B: Before becoming ASP (With IITH student co-authors)</div>
                    <div class="publication-section">
                        <div class="publication-label journal-label">Journal Publications</div>
                        <div class="journal-table">
                            @include('hr.partials.publication_table', ['data' => $categorizedPublications['section_b_journal']])
                        </div>

                        <div class="publication-label conference-label">Conference Proceedings</div>
                        <div class="conference-table">
                            @include('hr.partials.conference_table', ['data' => $categorizedPublications['section_b_conference']])
                        </div>
                    </div>

                    {{-- SECTION C --}}
                    <div class="sub-section-title">Section C: After becoming ASP (No IITH student co-author)</div>
                    <div class="publication-section">
                        <div class="publication-label journal-label">Journal Publications</div>
                        <div class="journal-table">
                            @include('hr.partials.publication_table', ['data' => $categorizedPublications['section_c_journal']])
                        </div>

                        <div class="publication-label conference-label">Conference Proceedings</div>
                        <div class="conference-table">
                            @include('hr.partials.conference_table', ['data' => $categorizedPublications['section_c_conference']])
                        </div>
                    </div>

                    {{-- SECTION D --}}
                    <div class="sub-section-title">Section D: After becoming ASP (With IITH student co-authors)</div>
                    <div class="publication-section">
                        <div class="publication-label journal-label">Journal Publications</div>
                        <div class="journal-table">
                            @include('hr.partials.publication_table', ['data' => $categorizedPublications['section_d_journal']])
                        </div>

                        <div class="publication-label conference-label">Conference Proceedings</div>
                        <div class="conference-table">
                            @include('hr.partials.conference_table', ['data' => $categorizedPublications['section_d_conference']])
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

@endsection