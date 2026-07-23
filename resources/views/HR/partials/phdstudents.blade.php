@extends('project.admin_master')

@section('project')
<style>
    .card-header {
        background: #007bff;
        color: white;
        padding: 8px 15px;
        font-size: 16px;
        font-weight: 600;
    }

    .summary-box {
        display: flex;
        justify-content: space-between;
        background: #f8f9fa;
        border: 1px solid #dee2e6;
        border-radius: 6px;
        padding: 8px 12px;
        margin-bottom: 10px;
        font-size: 0.9rem;
    }

    .summary-item {
        flex: 1;
        text-align: center;
        font-weight: 500;
    }

    .summary-item span {
        display: block;
        font-size: 1rem;
        font-weight: 700;
        color: #007bff;
    }

    .sub-section-title {
        font-weight: 600;
        background-color: #e9ecef;
        padding: 6px 10px;
        border-radius: 4px;
        margin-top: 10px;
        margin-bottom: 6px;
    }
</style>

<div class="sl-mainpanel">
    <div class="row">
        <div class="col-lg-12">
            <div class="card document-style">
                <div class="card-body p-2">
                    <!-- Header Section -->
                    <div class="card-header">
                        PhD Guidance: List of Graduated and Ongoing PhD Students at IITH by {{ $application->name }}
                    </div>

                    @php
                        $graduatedPhD = $phdStudents->where('student_type', 'graduated');
                        $ongoingPhD = $phdStudents->where('student_type', 'ongoing');
                        $totalPhD = $phdStudents->count();
                        $graduatedCount = $graduatedPhD->count();
                        $ongoingCount = $ongoingPhD->count();
                        $graduationRate = $totalPhD > 0 ? ($graduatedCount / $totalPhD) * 100 : 0;
                    @endphp

                    @if($phdStudents->count() > 0)
                        <!-- Summary Section -->
                        <div class="summary-box">
                            <div class="summary-item">
                                Total Students
                                <span>{{ $totalPhD }}</span>
                            </div>
                            <div class="summary-item">
                                Graduated
                                <span>{{ $graduatedCount }}</span>
                            </div>
                            <div class="summary-item">
                                Ongoing
                                <span>{{ $ongoingCount }}</span>
                            </div>
                            <div class="summary-item">
                                Graduation %
                                <span>{{ number_format($graduationRate, 2) }}%</span>
                            </div>
                        </div>
                    @endif

                    <!-- Graduated PhD Students -->
                    @if($graduatedPhD->count() > 0)
                        <div class="sub-section-title">PhD Students — Graduated</div>
                        <div class="table-responsive">
                            <table class="table table-sm table-borderless mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th width="5%" class="text-center">Sl. No.</th>
                                        <th width="35%">Name of the Student</th>
                                        <th width="20%">Year of Graduation</th>
                                        <th width="40%">Current Position</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($graduatedPhD as $index => $phd)
                                    <tr class="align-middle">
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td>{{ $phd->student_name }}</td>
                                        <td>{{ $phd->year }}</td>
                                        <td>{{ $phd->status_position }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                    <!-- Ongoing PhD Students -->
                    @if($ongoingPhD->count() > 0)
                        <div class="sub-section-title">PhD Students — Ongoing</div>
                        <div class="table-responsive">
                            <table class="table table-sm table-borderless mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th width="5%" class="text-center">Sl. No.</th>
                                        <th width="35%">Name of the Student</th>
                                        <th width="20%">Year of Joining</th>
                                        <th width="40%">Current Status</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($ongoingPhD as $index => $phd)
                                    <tr class="align-middle">
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td>{{ $phd->student_name }}</td>
                                        <td>{{ $phd->year }}</td>
                                        <td>{{ $phd->status_position }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @endif

                    @if($phdStudents->count() === 0)
                        <p class="text-muted small mb-0">No PhD student records available.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
