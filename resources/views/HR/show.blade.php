

<style>
.document-style {
    font-family: 'Times New Roman', Times, serif;
    line-height: 1.4;
    color: #000;
    background: #fff;
    padding: 20px;
}

.document-style .table {
    border: 1px solid #000;
    margin-bottom: 20px;
    width: 100%;
    border-collapse: collapse;
}

.document-style .table th,
.document-style .table td {
    border: 1px solid #000;
  
    vertical-align: top;
    text-align: left;
}

.document-style .table th {
    background-color: #f0f0f0;
    font-weight: bold;
    text-align: center;
}



.logo-section {
    display: flex;
    align-items: center;
    justify-content: center;
    margin-bottom: 20px;
}

.logo {
    width: 300px;
    height: 80px;
  
    display: flex;
    align-items: right;
    justify-content: right;
    margin-right: 20px;
}

.institute-name {
    font-size: 18px;
    font-weight: bold;
    text-align: center;
}



.publication-section {
    margin-bottom: 25px;
}

.info-row {
    margin-bottom: 10px;
    padding: 5px 0;
}

.info-label {
    font-weight: bold;
    display: inline-block;
    width: 300px;
}

.page-break {
    page-break-before: always;
}

@media print {
    .no-print {
        display: none !important;
    }
    .document-style {
        padding: 0;
        margin: 0;
    }
}

.back-button {
    margin-bottom: 20px;
}

.empty-row {
    height: 25px;
    background-color: #f8f9fa;
}

.empty-row td {
    border: 1px solid #dee2e6 !important;
}
</style>

 <style>
.basic-table {
    width: 100%;
    border-collapse: collapse;
    font-size: 10pt;
    margin-bottom: 15px;
}

.basic-table th,
.basic-table td {
    border: 1px solid #000;
    padding: 2px 2px;
    vertical-align: middle;
}

.basic-table th {
    width: 40%;
    background: #f2f2f2;
    text-align: left;
  
}
</style>
    
<div class="sl-mainpanel">
 

    <div class="row">
        <div class="col-lg-12">
            <div class="card no-print">
            <title>APPLICATION FOR THE INTERNAL PROMOTION {{ $application->id }}</title>
            </div>

            <div class="card document-style">
                <div class="card-body">
                    <!-- Header Section -->
                    <div class="header-section">
                        <div class="logo-section">
                      
                            <div class="logo">
                                      <img src="IITlogo.png" alt="IITH">
                            </div>
                            <hr style="height:1px;border-width:0;color:black;background-color:black; margin-top: 5px; margin-bottom: 0x;">
                            <div class="institute-name">
                                APPLICATION FOR THE INTERNAL PROMOTION<br>
                            
                            </div>
                            <hr style="height:1px;border-width:0;color:black;background-color:black; margin-top: 5px; margin-bottom: 0x;">
                        </div>
                        
                      
                        
                        <div style="text-align: right; font-size: 14px;">
                            Application ID:IITH/HR/2016-{{ $application->id }}<br>
                            Submitted on: {{ \Carbon\Carbon::parse($application->created_at)->format('d-M-Y') }}
                        </div>
                    </div>

             

<table class="basic-table">
    <tr>
        <th>1. Faculty ID</th>
        <td>{{ $application->fid }}</td>
    </tr>
    <tr>
        <th>2. Name of the Faculty</th>
        <td>{{ $application->name }}</td>
    </tr>
    <tr>
        <th>3. Date of Joining in the Institute</th>
        <td>{{ \Carbon\Carbon::parse($application->doj)->format('d-M-Y') }}</td>
    </tr>
    <tr>
        <th>4. Date of Joining in the Current Designation</th>
        <td>{{ \Carbon\Carbon::parse($application->dojcd)->format('d-M-Y') }}</td>
    </tr>
    <tr>
        <th>5. Name of the Department</th>
        <td>{{ $application->department }}</td>
    </tr>
    <tr>
        <th>6. Post Applied</th>
        <td>{{ $application->post }}</td>
    </tr>
</table>

             <!-- Teaching Summary with SCORE -->
<div class="section-title"><strong>7. Teaching Summary after Joining IITH</strong> </div>

@if($teachingSummaries->count() > 0)
    <table class="table">
        <thead>
            <tr>
                <th width="5%">Sl No.</th>
                <th width="10%">Acad Year</th>
                <th width="10%">Academic Period</th>
                <th width="10%">Course Code</th>
                <th width="20%">Course Name</th>
                <th width="8%">Credits</th>
                <th width="12%">Instructors</th>
                <th width="8%">No of Students Registered</th>
                <th width="12%">No of Students submitted feedback</th>
                <th width="5%">% Response</th>
                <th width="5%">SCORE</th>
            </tr>
        </thead>
        <tbody>
            @foreach($teachingSummaries as $index => $teaching)
            <tr>
                <td style="text-align: center;">{{ $index + 1 }}</td>
                <td>{{ $teaching->year_semester }}</td>
                <td>{{ $teaching->ap ?? 'N/A' }}</td>
                <td>{{ $teaching->course_number }}</td>
                <td>{{ $teaching->course_title }}</td>
                <td style="text-align: center;">{{ $teaching->credits }}</td>
                <td>{{ $teaching->instructors ?? 'N/A' }}</td>
                <td style="text-align: center;">{{ $teaching->students }}</td>
                <td>{{ $teaching->feedback }}</td>
                <td style="text-align: center;">{{ $teaching->response ?? 'N/A' }}</td>
              <td style="text-align: center;">
{{ isset($teaching->SCORE) && is_numeric($teaching->SCORE) ? number_format($teaching->SCORE, 2) : $teaching->SCORE }}

                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
@else
    <p style="color: #666; font-style: italic;">No teaching records available.</p>
@endif
                    <!-- Publications Section -->
<div class="section-title"><strong>
8. Publications
</strong> </div>
 <div class="info-row">
                        <span class="info-label">8A. Scopus Link:</span>
                        <strong>{{ $application->slink }}</strong>
                    </div>
@if($application->post === 'Associate Professor')
    <!-- AP to ASP Publications -->
    <div class="sub-section-title">8B: For AP to ASP</div>
    
    <!-- Section A -->
    <div class="sub-section-title">Section A: List of publications after joining IITH with no student from IITH as a co-author</div>
    
    <div class="publication-section">
        <strong>Journal Publications</strong>
        @if($categorizedPublications['section_a_journal']->count() > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th width="5%">Sl. No.</th>
                        <th width="30%">Title</th>
                        <th width="30%">Name</th>
                        <th width="30%">Author list</th>
                        <th width="10%">Year</th>
                        <th width="15%">Volume</th>
                        <th width="10%">Impact Factor</th>
                        <th width="10%">Quartile (Q1, Q2 only)</th>
                    </tr>

                    

                </thead>
                <tbody>
                    @foreach($categorizedPublications['section_a_journal'] as $index => $pub)
                     <tr>
                        <td style="text-align: center;">{{ $index + 1 }}</td>
                        <td>{{ $pub->title ?: 'N/A'}}</td>
                         <td>{{ $pub->journal_name ?: 'N/A'}}</td>
                          <td>{{ $pub->authors ?: 'N/A'}}</td>
                           <td>{{ $pub->year ?: 'N/A'}}</td>
                            <td>{{ $pub->volume ?: 'N/A'}}</td>
                        <td>{{ $pub->impact_factor ?: 'N/A' }}</td>
                        <td>{{ $pub->quartile ?: 'N/A' }}</td>
                    </tr>

                   

                    @endforeach
                </tbody>
            </table>
        @else
            <p style="color: #666; font-style: italic;">No journal publications in this section.</p>
        @endif

        <strong>Conference Proceedings</strong>
        @if($categorizedPublications['section_a_conference']->count() > 0)
            <table class="table">
                <thead>
                   <tr>
                        <th width="5%">Sl. No.</th>
                        <th width="20%">Title</th>
                        <th width="20%">Name</th>
                        <th width="30%">Author list</th>
                        <th width="10%">Year</th>
                        <th width="15%">Volume</th>
                        <th width="20%">Standard of Conference (A, A* only)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categorizedPublications['section_a_conference'] as $index => $pub)
                    <tr>
                        <td style="text-align: center;">{{ $index + 1 }}</td>
                        <td>{{ $pub->title }}</td>
                       <td>{{ $pub->journal_name ?: 'N/A'}}</td>
                          <td>{{ $pub->authors ?: 'N/A'}}</td>
                           <td>{{ $pub->year ?: 'N/A'}}</td>
                            <td>{{ $pub->volume ?: 'N/A'}}</td>
                        <td>{{ $pub->impact_factor ?: 'N/A' }}</td>
                    </tr>                    @endforeach
                </tbody>
            </table>
        @else
            <p style="color: #666; font-style: italic;">No conference proceedings in this section.</p>
        @endif
    </div>

    <!-- Section B -->
    <div class="sub-section-title">Section B: List of publications after joining IITH with students from IITH as co-authors</div>
    
    <div class="publication-section">
        <strong>Journal Publications</strong>
        @if($categorizedPublications['section_b_journal']->count() > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th width="5%">Sl. No.</th>
                        <th width="30%">Title</th>
                        <th width="30%">Name</th>
                        <th width="30%">Author list</th>
                        <th width="10%">Year</th>
                        <th width="15%">Volume</th>
                        <th width="10%">Impact Factor</th>
                        <th width="10%">Quartile (Q1, Q2 only)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categorizedPublications['section_b_journal'] as $index => $pub)
                     <tr>
                        <td style="text-align: center;">{{ $index + 1 }}</td>
                        <td>{{ $pub->title ?: 'N/A'}}</td>
                         <td>{{ $pub->journal_name ?: 'N/A'}}</td>
                          <td>{{ $pub->authors ?: 'N/A'}}</td>
                           <td>{{ $pub->year ?: 'N/A'}}</td>
                            <td>{{ $pub->volume ?: 'N/A'}}</td>
                        <td>{{ $pub->impact_factor ?: 'N/A' }}</td>
                        <td>{{ $pub->quartile ?: 'N/A' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p style="color: #666; font-style: italic;">No journal publications in this section.</p>
        @endif

        <strong>Conference Proceedings</strong>
        @if($categorizedPublications['section_b_conference']->count() > 0)
            <table class="table">
                <thead>
                   <tr>
                        <th width="5%">Sl. No.</th>
                        <th width="20%">Title</th>
                        <th width="20%">Name</th>
                        <th width="30%">Author list</th>
                        <th width="10%">Year</th>
                        <th width="15%">Volume</th>
                        <th width="20%">Standard of Conference (A, A* only)</th>
                    </tr>

                    
                </thead>
                <tbody>
                    @foreach($categorizedPublications['section_b_conference'] as $index => $pub)
                    <tr>
                        <td style="text-align: center;">{{ $index + 1 }}</td>
                        <td>{{ $pub->title }}</td>
                       <td>{{ $pub->journal_name ?: 'N/A'}}</td>
                          <td>{{ $pub->authors ?: 'N/A'}}</td>
                           <td>{{ $pub->year ?: 'N/A'}}</td>
                            <td>{{ $pub->volume ?: 'N/A'}}</td>
                        <td>{{ $pub->impact_factor ?: 'N/A' }}</td>
                    </tr>
                
                    @endforeach
                </tbody>
            </table>
        @else
            <p style="color: #666; font-style: italic;">No conference proceedings in this section.</p>
        @endif
    </div>

@else
    <!-- ASP to P Publications -->
    <div class="sub-section-title">8B: For ASP to P</div>
    
    <!-- Section A -->
    <div class="sub-section-title">Section A: List of publications before becoming ASP (after becoming AP) with no student from IITH as a co-author</div>
    
    <div class="publication-section">
        <strong>Journal Publications</strong>
        @if($categorizedPublications['section_a_journal']->count() > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th width="5%">Sl. No.</th>
                        <th width="30%">Title</th>
                        <th width="30%">Name</th>
                        <th width="30%">Author list</th>
                        <th width="10%">Year</th>
                        <th width="15%">Volume</th>
                        <th width="10%">Impact Factor</th>
                        <th width="10%">Quartile (Q1, Q2 only)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categorizedPublications['section_a_journal'] as $index => $pub)
                     <tr>
                        <td style="text-align: center;">{{ $index + 1 }}</td>
                        <td>{{ $pub->title ?: 'N/A'}}</td>
                         <td>{{ $pub->journal_name ?: 'N/A'}}</td>
                          <td>{{ $pub->authors ?: 'N/A'}}</td>
                           <td>{{ $pub->year ?: 'N/A'}}</td>
                            <td>{{ $pub->volume ?: 'N/A'}}</td>
                        <td>{{ $pub->impact_factor ?: 'N/A' }}</td>
                        <td>{{ $pub->quartile ?: 'N/A' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p style="color: #666; font-style: italic;">No journal publications in this section.</p>
        @endif

        <strong>Conference Proceedings</strong>
        @if($categorizedPublications['section_a_conference']->count() > 0)
            <table class="table">
                <thead>
                   <tr>
                        <th width="5%">Sl. No.</th>
                        <th width="20%">Title</th>
                        <th width="20%">Name</th>
                        <th width="30%">Author list</th>
                        <th width="10%">Year</th>
                        <th width="15%">Volume</th>
                        <th width="20%">Standard of Conference (A, A* only)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categorizedPublications['section_a_conference'] as $index => $pub)
                    <tr>
                        <td style="text-align: center;">{{ $index + 1 }}</td>
                        <td>{{ $pub->title }}</td>
                       <td>{{ $pub->journal_name ?: 'N/A'}}</td>
                          <td>{{ $pub->authors ?: 'N/A'}}</td>
                           <td>{{ $pub->year ?: 'N/A'}}</td>
                            <td>{{ $pub->volume ?: 'N/A'}}</td>
                        <td>{{ $pub->impact_factor ?: 'N/A' }}</td>
                    </tr>                    @endforeach
                </tbody>
            </table>
        @else
            <p style="color: #666; font-style: italic;">No conference proceedings in this section.</p>
        @endif
    </div>

    <!-- Section B -->
    <div class="sub-section-title">Section B: List of publications before becoming ASP (after becoming AP), with students from IITH as co-authors</div>
    
    <div class="publication-section">
        <strong>Journal Publications</strong>
        @if($categorizedPublications['section_b_journal']->count() > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th width="5%">Sl. No.</th>
                        <th width="30%">Title</th>
                        <th width="30%">Name</th>
                        <th width="30%">Author list</th>
                        <th width="10%">Year</th>
                        <th width="15%">Volume</th>
                        <th width="10%">Impact Factor</th>
                        <th width="10%">Quartile (Q1, Q2 only)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categorizedPublications['section_b_journal'] as $index => $pub)
                     <tr>
                        <td style="text-align: center;">{{ $index + 1 }}</td>
                        <td>{{ $pub->title ?: 'N/A'}}</td>
                         <td>{{ $pub->journal_name ?: 'N/A'}}</td>
                          <td>{{ $pub->authors ?: 'N/A'}}</td>
                           <td>{{ $pub->year ?: 'N/A'}}</td>
                            <td>{{ $pub->volume ?: 'N/A'}}</td>
                        <td>{{ $pub->impact_factor ?: 'N/A' }}</td>
                        <td>{{ $pub->quartile ?: 'N/A' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p style="color: #666; font-style: italic;">No journal publications in this section.</p>
        @endif

        <strong>Conference Proceedings</strong>
        @if($categorizedPublications['section_b_conference']->count() > 0)
            <table class="table">
                <thead>
                   <tr>
                        <th width="5%">Sl. No.</th>
                        <th width="20%">Title</th>
                        <th width="20%">Name</th>
                        <th width="30%">Author list</th>
                        <th width="10%">Year</th>
                        <th width="15%">Volume</th>
                        <th width="20%">Standard of Conference (A, A* only)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categorizedPublications['section_b_conference'] as $index => $pub)
                    <tr>
                        <td style="text-align: center;">{{ $index + 1 }}</td>
                        <td>{{ $pub->title }}</td>
                       <td>{{ $pub->journal_name ?: 'N/A'}}</td>
                          <td>{{ $pub->authors ?: 'N/A'}}</td>
                           <td>{{ $pub->year ?: 'N/A'}}</td>
                            <td>{{ $pub->volume ?: 'N/A'}}</td>
                        <td>{{ $pub->impact_factor ?: 'N/A' }}</td>
                    </tr>                    @endforeach
                </tbody>
            </table>
        @else
            <p style="color: #666; font-style: italic;">No conference proceedings in this section.</p>
        @endif
    </div>

    <!-- Section C -->
    <div class="sub-section-title">Section C: List of publications after becoming ASP with no student from IITH as co-author</div>
    
    <div class="publication-section">
        <strong>Journal Publications</strong>
        @if($categorizedPublications['section_c_journal']->count() > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th width="5%">Sl. No.</th>
                        <th width="30%">Title</th>
                        <th width="30%">Name</th>
                        <th width="30%">Author list</th>
                        <th width="10%">Year</th>
                        <th width="15%">Volume</th>
                        <th width="10%">Impact Factor</th>
                        <th width="10%">Quartile (Q1, Q2 only)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categorizedPublications['section_c_journal'] as $index => $pub)
                     <tr>
                        <td style="text-align: center;">{{ $index + 1 }}</td>
                        <td>{{ $pub->title ?: 'N/A'}}</td>
                         <td>{{ $pub->journal_name ?: 'N/A'}}</td>
                          <td>{{ $pub->authors ?: 'N/A'}}</td>
                           <td>{{ $pub->year ?: 'N/A'}}</td>
                            <td>{{ $pub->volume ?: 'N/A'}}</td>
                        <td>{{ $pub->impact_factor ?: 'N/A' }}</td>
                        <td>{{ $pub->quartile ?: 'N/A' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p style="color: #666; font-style: italic;">No journal publications in this section.</p>
        @endif

        <strong>Conference Proceedings</strong>
        @if($categorizedPublications['section_c_conference']->count() > 0)
            <table class="table">
                <thead>
                   <tr>
                        <th width="5%">Sl. No.</th>
                        <th width="20%">Title</th>
                        <th width="20%">Name</th>
                        <th width="30%">Author list</th>
                        <th width="10%">Year</th>
                        <th width="15%">Volume</th>
                        <th width="20%">Standard of Conference (A, A* only)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categorizedPublications['section_c_conference'] as $index => $pub)
                    <tr>
                        <td style="text-align: center;">{{ $index + 1 }}</td>
                        <td>{{ $pub->title }}</td>
                       <td>{{ $pub->journal_name ?: 'N/A'}}</td>
                          <td>{{ $pub->authors ?: 'N/A'}}</td>
                           <td>{{ $pub->year ?: 'N/A'}}</td>
                            <td>{{ $pub->volume ?: 'N/A'}}</td>
                        <td>{{ $pub->impact_factor ?: 'N/A' }}</td>
                    </tr>                    @endforeach
                </tbody>
            </table>
        @else
            <p style="color: #666; font-style: italic;">No conference proceedings in this section.</p>
        @endif
    </div>

    <!-- Section D -->
    <div class="sub-section-title">Section D: List of publications after becoming ASP with student from IITH as co-author</div>
    
    <div class="publication-section">
        <strong>Journal Publications</strong>
        @if($categorizedPublications['section_d_journal']->count() > 0)
            <table class="table">
                <thead>
                    <tr>
                        <th width="5%">Sl. No.</th>
                        <th width="30%">Title</th>
                        <th width="30%">Name</th>
                        <th width="30%">Author list</th>
                        <th width="10%">Year</th>
                        <th width="15%">Volume</th>
                        <th width="10%">Impact Factor</th>
                        <th width="10%">Quartile (Q1, Q2 only)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categorizedPublications['section_d_journal'] as $index => $pub)
                     <tr>
                        <td style="text-align: center;">{{ $index + 1 }}</td>
                        <td>{{ $pub->title ?: 'N/A'}}</td>
                         <td>{{ $pub->journal_name ?: 'N/A'}}</td>
                          <td>{{ $pub->authors ?: 'N/A'}}</td>
                           <td>{{ $pub->year ?: 'N/A'}}</td>
                            <td>{{ $pub->volume ?: 'N/A'}}</td>
                        <td>{{ $pub->impact_factor ?: 'N/A' }}</td>
                        <td>{{ $pub->quartile ?: 'N/A' }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p style="color: #666; font-style: italic;">No journal publications in this section.</p>
        @endif

        <strong>Conference Proceedings</strong>
        @if($categorizedPublications['section_d_conference']->count() > 0)
            <table class="table">
                <thead>
                   <tr>
                        <th width="5%">Sl. No.</th>
                        <th width="20%">Title</th>
                        <th width="20%">Name</th>
                        <th width="30%">Author list</th>
                        <th width="10%">Year</th>
                        <th width="15%">Volume</th>
                        <th width="20%">Standard of Conference (A, A* only)</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categorizedPublications['section_d_conference'] as $index => $pub)
                    <tr>
                        <td style="text-align: center;">{{ $index + 1 }}</td>
                        <td>{{ $pub->title }}</td>
                       <td>{{ $pub->journal_name ?: 'N/A'}}</td>
                          <td>{{ $pub->authors ?: 'N/A'}}</td>
                           <td>{{ $pub->year ?: 'N/A'}}</td>
                            <td>{{ $pub->volume ?: 'N/A'}}</td>
                        <td>{{ $pub->impact_factor ?: 'N/A' }}</td>
                    </tr>                    @endforeach
                </tbody>
            </table>
        @else
            <p style="color: #666; font-style: italic;">No conference proceedings in this section.</p>
        @endif
    </div>
@endif

                    <!-- PhD Guidance -->
                    <div class="section-title"><strong>
9. PhD guidance: List of graduated and ongoing PhD students at IITH
                    </strong> </div>
                    
                    @php
                        $graduatedPhD = $phdStudents->where('student_type', 'graduated');
                        $ongoingPhD = $phdStudents->where('student_type', 'ongoing');
                    @endphp

                    @if($graduatedPhD->count() > 0)
                        <div class="sub-section-title">PhD students -- Graduated</div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th width="5%">Sl. No.</th>
                                    <th width="35%">Name of the Student</th>
                                    <th width="20%">Year of graduation</th>
                                    <th width="40%">Current position</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($graduatedPhD as $index => $phd)
                                <tr>
                                    <td style="text-align: center;">{{ $index + 1 }}</td>
                                    <td>{{ $phd->student_name }}</td>
                                    <td>{{ $phd->year }}</td>
                                    <td>{{ $phd->status_position }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif

                    @if($ongoingPhD->count() > 0)
                        <div class="sub-section-title">PhD students -- Ongoing</div>
                        <table class="table">
                            <thead>
                                <tr>
                                    <th width="5%">Sl. No.</th>
                                    <th width="35%">Name of the Student</th>
                                    <th width="20%">Year of Joining</th>
                                    <th width="40%">Current Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($ongoingPhD as $index => $phd)
                                <tr>
                                    <td style="text-align: center;">{{ $index + 1 }}</td>
                                    <td>{{ $phd->student_name }}</td>
                                    <td>{{ $phd->year }}</td>
                                    <td>{{ $phd->status_position }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @endif

                    @if($phdStudents->count() === 0)
                        <p style="color: #666; font-style: italic;">No PhD student records available.</p>
                    @endif
<hr>
                    <!-- Awards -->
                    <div class="section-title"> <strong>10. Awards/Honors received after joining IITH:</strong> </div>

                       {!! nl2br(e($application->awards)) ?: 'No awards/honors mentioned.' !!}
                
<hr>
                    <!-- Projects -->
                    <div class="section-title"> <strong>11. Completed and ongoing Projects (sponsored/Consultancy) in the following format handled at IITH:</strong> </div>
                    
                    @if($projects->count() > 0)
                        <table class="table">
                            <thead>
                                <tr>
                                    <th width="5%">Sl. No.</th>
                                    <th width="10%">As PI or Co-PI</th>
                                    <th width="25%">Project Title</th>
                                    <th width="20%">Sponsoring Agency</th>
                                    <th width="15%">Period of project</th>
                                    <th width="15%">Project Cost (in ₹, in Lakhs)</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($projects as $index => $project)
                                <tr>
                                    <td style="text-align: center;">{{ $index + 1 }}</td>
                                    <td>{{ $project->pi_type }}</td>
                                    <td>{{ $project->project_title }}</td>
                                    <td>{{ $project->sponsoring_agency }}</td>
                                    <td>{{ $project->period }}</td>
                                    <td style="text-align: right;">₹{{ number_format($project->cost, 2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    @else
                        <p style="color: #666; font-style: italic;">No project records available.</p>
                    @endif

                    <!-- Additional Sections -->
                    <div class="section-title"><strong>12. Patents, if any: Granted and filed from IITH</strong> </div>
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
<hr>
                    <div class="section-title"><strong> 13. Technology developed and transferred, if any from IITH</strong></div>
                   
                        {!! nl2br(e($application->technology))  ?: 'No technology development mentioned.' !!}
                    <hr>

                    <div class="section-title"><strong>14. Infrastructure established at IITH</strong></div>
                   
                        {!! nl2br(e($application->infrastructure))  ?: 'No infrastructure establishment mentioned.' !!}
                  
<hr>
                    <div class="section-title"><strong>15. Administrative Activities at IITH</strong></div>
                   
                        {!! nl2br(e($application->admin_activities))  ?: 'No administrative activities mentioned.' !!}
                   
<hr>
                    <div class="section-title"><strong>16. Outreach Activities at IITH (if any)</strong></div>
                   
                        {!! nl2br(e($application->outreach))  ?: 'No outreach activities mentioned.' !!}
            
<hr>
                    <div class="section-title"><strong>17. National level responsibilities, if any</strong></div>
                   
                        {!! nl2br(e($application->national_responsibilities))  ?: 'No national level responsibilities mentioned.' !!}
<hr>
                <div class="section-title"><strong>18. Any other activities</strong></div>
                   
                        {!! nl2br(e($application->anyother)) ?: 'No Any other activities.' !!}
                       

                    <!-- Submission Date -->
                    <div style="margin-top: 40px; text-align: right;">
                        <div style="border-top: 1px solid #000; padding-top: 10px; display: inline-block;">
                            <strong>Date of Submission of Application:</strong><br>
                            {{ \Carbon\Carbon::parse($application->created_at)->format('d-M-Y') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

