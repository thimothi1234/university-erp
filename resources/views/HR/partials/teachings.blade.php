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
</style>

<div class="sl-mainpanel">
    <div class="row">
        <div class="col-lg-12">
            <div class="card document-style">
                <div class="card-body p-2">
                    <!-- Teaching Summary Header -->
                    <div class="card-header">
                        Teaching Summary after Joining IITH of {{ $application->name }}
                    </div>

                    @if($teachingSummaries->count() > 0)
                        @php
                            $totalCourses = $teachingSummaries->count();
                            $totalStudents = $teachingSummaries->sum('students');
                            $avgResponse = $teachingSummaries->avg('response');
                            $avgScore = $teachingSummaries->avg('SCORE');
                        @endphp

                        <!-- Summary Section -->
                        <div class="summary-box">
                            <div class="summary-item">
                                Total Courses
                                <span>{{ $totalCourses }}</span>
                            </div>
                            <div class="summary-item">
                                Total Students
                                <span>{{ $totalStudents }}</span>
                            </div>
                            <div class="summary-item">
                                Avg. Response (%)
                                <span>{{ number_format($avgResponse ?? 0, 2) }}</span>
                            </div>
                            <div class="summary-item">
                                Avg. SCORE
                                <span>{{ number_format($avgScore ?? 0, 2) }}</span>
                            </div>
                        </div>

                        <!-- Table Section -->
                        <div class="table-responsive">
                            <table class="table table-sm table-borderless mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th class="text-center" style="width: 4%; font-size: 0.8rem;">Sl No.</th>
                                        <th style="width: 8%; font-size: 0.8rem;">Acad Year</th>
                                        <th style="width: 8%; font-size: 0.8rem;">Academic Period</th>
                                        <th style="width: 8%; font-size: 0.8rem;">Course Code</th>
                                        <th style="width: 18%; font-size: 0.8rem;">Course Name</th>
                                        <th class="text-center" style="width: 6%; font-size: 0.8rem;">Credits</th>
                                        <th style="width: 10%; font-size: 0.8rem;">Instructors</th>
                                        <th class="text-center" style="width: 6%; font-size: 0.8rem;">No of Students Registered</th>
                                        <th style="width: 10%; font-size: 0.8rem;">No of Students submitted feedback</th>
                                        <th class="text-center" style="width: 4%; font-size: 0.8rem;">% Response</th>
                                        <th class="text-center" style="width: 4%; font-size: 0.8rem;">SCORE</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($teachingSummaries as $index => $teaching)
                                    <tr class="align-middle">
                                        <td class="text-center py-1">{{ $index + 1 }}</td>
                                        <td class="py-1">{{ $teaching->year_semester }}</td>
                                        <td class="py-1">{{ $teaching->ap ?? 'N/A' }}</td>
                                        <td class="py-1">{{ $teaching->course_number }}</td>
                                        <td class="py-1">{{ $teaching->course_title }}</td>
                                        <td class="text-center py-1">{{ $teaching->credits }}</td>
                                        <td class="py-1">{{ $teaching->instructors ?? 'N/A' }}</td>
                                        <td class="text-center py-1">{{ $teaching->students }}</td>
                                        <td class="py-1">{{ $teaching->feedback }}</td>
                                        <td class="text-center py-1">{{ $teaching->response ?? 'N/A' }}</td>
                                        <td class="text-center py-1 fw-bold">
                                            {{ isset($teaching->SCORE) && is_numeric($teaching->SCORE) ? number_format($teaching->SCORE, 2) : $teaching->SCORE }}
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-muted small mb-0">No teaching records available.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
