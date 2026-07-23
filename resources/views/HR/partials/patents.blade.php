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
    .report-highlight {
        background-color: #fff3cd;
        border: 1px solid #ffeaa7;
        border-radius: 5px;
        padding: 15px;
        margin-bottom: 20px;
    }
    .report-highlight .row > div {
        font-size: 16px;
        font-weight: bold;
        color: #856404;
    }
    </style>
<div class="sl-mainpanel">
    <div class="row">
        <div class="col-lg-12">
            <div class="card no-print"></div>

            <div class="card document-style">
                <div class="card-body p-2">
                    <!-- Header Section -->
                    <div class="header-section mb-1"></div>

                    <!-- Report Summary: Totals by Status -->
                    @php
                        $statusCounts = $patents->groupBy('status')->map(function ($group) {
                            return $group->count();
                        });
                        $totalPatents = $patents->count();
                        $filedCount = $statusCounts->get('Filed', 0); // Adjust status string as per your data (e.g., 'Filed', 'filed')
                        $grantedCount = $statusCounts->get('Granted', 0); // Adjust as needed
                        $publishedCount = $statusCounts->get('Published', 0); // Adjust as needed
                    @endphp

                    <div class="card-header">Patent Status Report: Totals for {{$application->name}}</div>
                    <div class="report-highlight mb-3">
                        <div class="row">
                            <div class="col-md-3">
                                <strong>Total Patents:</strong> {{ $totalPatents }}
                            </div>
                            <div class="col-md-3">
                                Filed: {{ $filedCount }}
                            </div>
                            <div class="col-md-3">
                                Granted: {{ $grantedCount }}
                            </div>
                            <div class="col-md-3">
                                Published: {{ $publishedCount }}
                            </div>
                            @if($statusCounts->count() > 3)
                                @foreach($statusCounts as $status => $count)
                                    @if(!in_array($status, ['Filed', 'Granted', 'Published']))
                                        <div class="col-md-3">
                                            {{ $status }}: {{ $count }}
                                        </div>
                                    @endif
                                @endforeach
                            @endif
                        </div>
                    </div>

                    <!-- Teaching Summary with SCORE -->
                      <div class="card-header">Patents, if any: Granted and filed from IITH of {{$application->name}}</div>

                    @if($patents->count() > 0)
                        <table class="table">
                            <thead>
                                <tr>
                                    <th width="15%">Patent No.</th>
                                    <th width="35%">Patent Name</th>
                                    <th width="30%">Inventors</th>
                                    <th width="20%">Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($patents as $patent)
                                <tr>
                                    <td>{{ $patent->patent_number }}</td>
                                    <td>{{ $patent->patent_name }}</td>
                                    <td>{{ $patent->inventors }}</td>
                                    <td>{{ $patent->status }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p style="color: #666; font-style: italic;">No patent records available.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>

@endsection