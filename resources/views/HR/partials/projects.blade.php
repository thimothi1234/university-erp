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
                    <!-- Header Section -->
                    <div class="card-header">
                        Completed and Ongoing Projects (Sponsored/Consultancy) Handled at IITH by {{ $application->name }}
                    </div>

                    @if($projects->count() > 0)
                        @php
                            $total_cost = $projects->sum('cost');
                            $total_projects = $projects->count();
                            $pi_count = $projects->where('pi_type', 'PI')->count();
                            $co_pi_count = $projects->where('pi_type', 'CO-PI')->count();
                        @endphp

                        <!-- Summary Section -->
                        <div class="summary-box">
                            <div class="summary-item">
                                Total Projects
                                <span>{{ $total_projects }}</span>
                            </div>
                            <div class="summary-item">
                                Total Cost (₹ in Lakhs)
                                <span>{{ number_format($total_cost, 2) }}</span>
                            </div>
                            <div class="summary-item">
                                As PI
                                <span>{{ $pi_count }}</span>
                            </div>
                            <div class="summary-item">
                                As Co-PI
                                <span>{{ $co_pi_count }}</span>
                            </div>
                        </div>

                        <!-- Projects Table -->
                        <div class="table-responsive">
                            <table class="table table-sm table-borderless mb-0">
                                <thead class="table-light">
                                    <tr>
                                        <th width="5%" class="text-center">Sl. No.</th>
                                        <th width="10%">As PI or Co-PI</th>
                                        <th width="25%">Project Title</th>
                                        <th width="20%">Sponsoring Agency</th>
                                        <th width="15%">Period of Project</th>
                                        <th width="15%" class="text-end">Project Cost (₹ in Lakhs)</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($projects as $index => $project)
                                    <tr class="align-middle">
                                        <td class="text-center">{{ $index + 1 }}</td>
                                        <td>{{ $project->pi_type }}</td>
                                        <td>{{ $project->project_title }}</td>
                                        <td>{{ $project->sponsoring_agency }}</td>
                                        <td>{{ $project->period }}</td>
                                        <td class="text-end">₹{{ number_format($project->cost, 2) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                              
                            </table>
                        </div>
                    @else
                        <p class="text-muted small mb-0">No project records available.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection
