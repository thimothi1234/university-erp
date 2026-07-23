@extends('project.admin_master')

@section('project')

<style>
/* Compact Form Styling */
body {
  background-color: #f8fafc;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.card {
  border: none;
  border-radius: 8px;
  box-shadow: 0 2px 8px rgba(0,0,0,0.08);
  margin-bottom: 15px;
  transition: box-shadow 0.3s ease-in-out;
}

.card:hover {
  box-shadow: 0 4px 12px rgba(0,0,0,0.12);
}

.card-header {
  background: linear-gradient(90deg, #0e243bff, #c28787ff);
  color: white;
  border-top-left-radius: 8px;
  border-top-right-radius: 8px;
  padding: 12px 20px;
}

.card-header h4 {
  margin: 0;
  font-weight: 600;
  font-size: 1.1rem;
}

.card-body {
  padding: 15px;
}

.form-control {
  border-radius: 6px;
  font-size: 0.9rem;
  padding: 6px 10px;
  height: 36px;
  border: 1px solid #ced4da;
  transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
}

.form-control:focus {
  border-color: #0e243b;
  box-shadow: 0 0 0 0.2rem rgba(14, 36, 59, 0.25);
  outline: none;
}

.form-label {
  font-weight: 500;
  color: #333;
  font-size: 0.9rem;
  margin-bottom: 4px;
}

.required {
  color: #dc3545;
  font-weight: bold;
}

/* Breadcrumb Styling */
.sl-breadcrumb {
  background: #fff;
  padding: 15px;
  border-radius: 6px;
  margin-bottom: 20px;
  box-shadow: 0 1px 3px rgba(0,0,0,0.1);
}

.breadcrumb-item a {
  color: #0e243b;
  text-decoration: none;
  font-weight: 500;
}

.breadcrumb-item a:hover {
  color: #c28787;
}

.breadcrumb-item.active {
  color: #6c757d;
  font-weight: 500;
}

/* Section Styling */
.section-card {
  margin-bottom: 20px;
  border: 1px solid #dee2e6;
  border-radius: 8px;
  overflow: hidden;
  transition: border-color 0.3s ease;
}

.section-card:hover {
  border-color: #0e243b;
}

.section-header {
  background: #f8f9fa;
  padding: 12px 20px;
  border-bottom: 1px solid #dee2e6;
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.section-title {
  margin: 0;
  font-size: 1.1rem;
  font-weight: 600;
  color: #495057;
}

.section-body {
  padding: 20px;
}

/* Publication Upload Styling */
.publication-section, .teaching-record-section {
    background: #f8fafc;
    padding: 20px;
    border-radius: 8px;
    margin-bottom: 20px;
    border: 1px solid #e9ecef;
}

.publication-section h6, .teaching-record-section h6 {
    background: #004aad;
    color: #fff;
    padding: 10px 15px;
    border-radius: 6px;
    font-weight: 600;
    font-size: 14px;
    margin-bottom: 15px;
    box-shadow: 0 2px 4px rgba(0, 74, 173, 0.2);
}

.publication-section table, .teaching-record-section table {
    width: 100%;
    border-collapse: collapse;
    background-color: #fff;
    border-radius: 6px;
    overflow: hidden;
    box-shadow: 0 1px 3px rgba(0,0,0,0.1);
}

.publication-section table th,
.publication-section table td,
.teaching-record-section table th,
.teaching-record-section table td {
    border: 1px solid #dee2e6;
    padding: 8px 12px;
    text-align: left;
    font-size: 13px;
}

.publication-section table th,
.teaching-record-section table th {
  background-color: #f8f9fa;
  font-weight: 600;
  color: #495057;
}

.publication-section table tr:hover,
.teaching-record-section table tr:hover {
  background-color: #f8f9fa;
}

.upload-progress {
    display: none;
    margin: 10px 0;
}

.progress-bar {
    height: 20px;
    background-color: #e9ecef;
    border-radius: 4px;
    overflow: hidden;
}

.progress-fill {
    height: 100%;
    background-color: #28a745;
    transition: width 0.3s ease;
    width: 0%;
}

.upload-status {
    margin-top: 5px;
    font-size: 12px;
    color: #6c757d;
}

.excel-preview {
    max-height: 200px;
    overflow-y: auto;
    margin: 10px 0;
    border: 1px solid #dee2e6;
    border-radius: 4px;
    padding: 10px;
    background: #f8f9fa;
    display: none;
}

.preview-table {
    width: 100%;
    font-size: 11px;
}

.preview-table th {
    background-color: #e9ecef;
    padding: 4px 6px;
    font-weight: 600;
    color: #495057;
}

.preview-table td {
    padding: 4px 6px;
    border-bottom: 1px solid #dee2e6;
}

.preview-table tr:hover {
  background-color: #f8f9fa;
}

.save-buttons {
    background: white;
    padding: 15px;
    border-top: 1px solid #dee2e6;
    margin-top: 20px;
    text-align: center;
    border-radius: 0 0 8px 8px;
    box-shadow: 0 -1px 3px rgba(0,0,0,0.05);
}

.btn {
    border-radius: 6px;
    padding: 8px 16px;
    font-size: 0.85rem;
    margin: 0 5px;
    transition: all 0.2s ease-in-out;
    font-weight: 500;
    border: none;
}

.btn:hover {
  transform: translateY(-1px);
  box-shadow: 0 2px 4px rgba(0,0,0,0.1);
}

.btn-primary {
  background-color: #0e243b;
  border-color: #0e243b;
}

.btn-primary:hover {
  background-color: #c28787;
  border-color: #c28787;
}

.btn-outline-primary {
  color: #0e243b;
  border-color: #0e243b;
}

.btn-outline-primary:hover {
  background-color: #0e243b;
  color: white;
}

/* Hide sections by default */
.section-6A, .section-6B {
    display: none;
}

.dynamic-item {
    background: #f8f9fa;
    border: 1px solid #dee2e6;
    border-radius: 6px;
    padding: 10px;
    margin-bottom: 8px;
    position: relative;
    transition: background-color 0.2s ease;
}

.dynamic-item:hover {
  background: #e9ecef;
}

.remove-item {
    position: absolute;
    top: 5px;
    right: 10px;
    background: #dc3545;
    color: white;
    border: none;
    border-radius: 50%;
    width: 25px;
    height: 25px;
    font-size: 0.8rem;
    cursor: pointer;
    transition: background-color 0.2s ease;
}

.remove-item:hover {
  background: #c82333;
}

.add-btn {
    margin-bottom: 0;
    background-color: #28a745;
    border-color: #28a745;
}

.add-btn:hover {
  background-color: #218838;
  border-color: #218838;
}

/* File Upload Styling */
.file-upload-section {
    background: #f8f9fa;
    padding: 15px;
    border-radius: 6px;
    margin: 15px 0;
    border: 1px solid #dee2e6;
}

.file-upload-info {
    font-size: 0.8rem;
    color: #6c757d;
    margin-top: 5px;
}

.file-preview {
    margin-top: 10px;
    padding: 10px;
    background: #e9ecef;
    border-radius: 4px;
    font-size: 0.8rem;
    border-left: 3px solid #0e243b;
}

/* Modal specific styles */
.modal-preview-content {
    max-height: 60vh;
    overflow-y: auto;
}

.modal-content {
  border-radius: 8px;
  box-shadow: 0 4px 20px rgba(0,0,0,0.15);
}

.modal-header {
  background: linear-gradient(90deg, #0e243b, #c28787);
  color: white;
  border-top-left-radius: 8px;
  border-top-right-radius: 8px;
}

.modal-title {
  font-weight: 600;
}

/* CV Upload Specific */
.cv-upload-section {
    background: #e8f5e8;
    border: 2px dashed #28a745;
    padding: 20px;
    border-radius: 8px;
    margin: 15px 0;
    transition: border-color 0.3s ease;
}

.cv-upload-section:hover {
  border-color: #218838;
}

.cv-upload-section label {
    font-weight: 600;
    color: #155724;
}

/* Alert Styling */
.alert {
  border-radius: 6px;
  border: none;
  padding: 12px 16px;
}

.alert-success {
  background-color: #d4edda;
  color: #155724;
  border-left: 4px solid #28a745;
}

.alert-danger {
  background-color: #f8d7da;
  color: #721c24;
  border-left: 4px solid #dc3545;
}

/* Textarea Styling */
textarea.form-control {
  resize: vertical;
  min-height: 80px;
}

.text-muted {
  color: #6c757d !important;
  font-style: italic;
}

/* Responsive adjustments */
@media (max-width: 768px) {
  .section-header {
    flex-direction: column;
    align-items: flex-start;
    gap: 10px;
  }
  
  .btn {
    width: 100%;
    margin: 5px 0;
  }
  
  .row {
    margin-bottom: 15px;
  }
}



</style>

<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="">HR</a>
        <a class="breadcrumb-item" href="">Faculty</a>
        <span class="breadcrumb-item active">Insert</span>
    </nav>

    <div class="row">
        <div class="col-lg-16">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom">
                    <h4>       &nbsp;&nbsp;&nbsp;&nbsp;APPLICATION FOR THE INTERNAL PROMOTION</h4>
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form action="{{ route('HRM.store') }}" method="POST" id="facultyForm" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="form_status" id="formStatus" value="draft">

                        <div class="container-fluid">
                         
                            <!-- SECTION 1: GENERAL DETAILS -->
                            <div class="card section-card">
                                <div class="section-header">
                                    <h5 class="section-title">General Details</h5>
                                </div>
                                <div class="section-body">
                                    <div class="row mb-2">
                                        <div class="col-md-2">
                                            <label for="fid" class="form-label">1. Faculty ID <span class="required">*</span></label>
                                            <input type="text" name="fid" class="form-control" placeholder="Faculty ID" value="{{ old('fid') }}" required>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="name" class="form-label">2. Name <span class="required">*</span></label>
                                            <input type="text" name="name" class="form-control" placeholder="Enter Faculty Name" value="{{ old('name') }}" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="department" class="form-label">3. Department <span class="required">*</span></label>
                                            <select name="department" class="form-control" required>
                                                <option value="">-- Select Department --</option>
                                                <option value="Artificial Intelligence" {{ old('department') == 'Artificial Intelligence' ? 'selected' : '' }}>Artificial Intelligence</option>
                                                <option value="Biomedical Engineering" {{ old('department') == 'Biomedical Engineering' ? 'selected' : '' }}>Biomedical Engineering</option>
                                                <option value="Biotechnology" {{ old('department') == 'Biotechnology' ? 'selected' : '' }}>Biotechnology</option>
                                                <option value="Chemical Engineering" {{ old('department') == 'Chemical Engineering' ? 'selected' : '' }}>Chemical Engineering</option>
                                                <option value="Climate Change" {{ old('department') == 'Climate Change' ? 'selected' : '' }}>Climate Change</option>
                                                <option value="Civil Engineering" {{ old('department') == 'Civil Engineering' ? 'selected' : '' }}>Civil Engineering</option>
                                                <option value="Computer Science and Engineering" {{ old('department') == 'Computer Science and Engineering' ? 'selected' : '' }}>Computer Science and Engineering</option>
                                                <option value="Electrical Engineering" {{ old('department') == 'Electrical Engineering' ? 'selected' : '' }}>Electrical Engineering</option>
                                                <option value="Materials Science and Metallurgical Engineering" {{ old('department') == 'Materials Science and Metallurgical Engineering' ? 'selected' : '' }}>Materials Science and Metallurgical Engineering</option>
                                                <option value="Mechanical & Aerospace Engineering" {{ old('department') == 'Mechanical & Aerospace Engineering' ? 'selected' : '' }}>Mechanical & Aerospace Engineering</option>
                                                <option value="Chemistry" {{ old('department') == 'Chemistry' ? 'selected' : '' }}>Chemistry</option>
                                                <option value="Physics" {{ old('department') == 'Physics' ? 'selected' : '' }}>Physics</option>
                                                <option value="Mathematics" {{ old('department') == 'Mathematics' ? 'selected' : '' }}>Mathematics</option>
                                                <option value="Liberal Arts" {{ old('department') == 'Liberal Arts' ? 'selected' : '' }}>Liberal Arts</option>
                                                <option value="Design" {{ old('department') == 'Design' ? 'selected' : '' }}>Design</option>
                                                <option value="Entrepreneurship and Management" {{ old('department') == 'Entrepreneurship and Management' ? 'selected' : '' }}>Entrepreneurship and Management</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="row mb-3 align-items-end">
                                        <div class="col-md-4">
                                            <label for="doj" class="form-label">4. Date of Joining at IITH <span class="required">*</span></label>
                                            <input type="date" name="doj" class="form-control" value="{{ old('doj') }}" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="dojcd" class="form-label">5. Date of joining in the Current Designation <span class="required">*</span></label>
                                            <input type="date" name="dojcd" class="form-control" value="{{ old('dojcd') }}" required>
                                        </div>
                                        <div class="col-md-4">
                                            <label for="post" class="form-label">6. Post Applied <span class="required">*</span></label>
                                            <select name="post" id="postSelect" class="form-control" required>
                                                <option value="">-- Select Post --</option>
                                                <option value="Associate Professor" {{ old('post') == 'Associate Professor' ? 'selected' : '' }}>Associate Professor</option>
                                                <option value="Professor" {{ old('post') == 'Professor' ? 'selected' : '' }}>Professor</option>
                                            </select>
                                        </div>
                                    </div>

                                    <!-- CV Upload in General Details Section -->
                                  
                            </div>

                            <!-- SECTION 2: TEACHING RECORD -->
                            <div class="card section-card">
                                <div class="section-header">
                                    <h5 class="section-title">7. Teaching Summary after Joining IITH as <span class="promotionPost"></span>.</h5>
                                </div>
                                <div class="section-body">
                                    <!-- Teaching Record Upload Section -->
                                    <div class="teaching-record-section">
                                        <h6>Teaching Record Upload</h6>
                                       
                                        <div id="teachingUploadProgress" class="upload-progress">
                                            <div class="progress-bar">
                                                <div class="progress-fill"></div>
                                            </div>
                                            <div class="upload-status" id="teachingUploadStatus">Processing...</div>
                                        </div>

                                        <table>
                                            <tr>
                                                <td width="5%"></td>
                                                <td width="25%">Teaching Records</td>
                                                <td width="20%">
                                                    <a href="{{ asset('excel_formats/Teaching_Summary after Joining IITH.xlsx') }}" target="_blank">Download Format</a>
                                                </td>
                                                <td width="30%">
                                                    <input type="file" class="teaching-excel-upload" data-section="teaching" data-type="record" accept=".xlsx,.xls" />
                                                </td>
                                                <td width="20%">
                                                    <!-- <button type="button" class="btn btn-sm btn-outline-primary teaching-preview-btn" data-section="teaching" data-type="record">Preview</button> -->
                                                </td>
                                            </tr>
                                        </table>

                                        <div id="teachingRecordsContainer"></div>
                                    </div>

                                    <!-- Teaching Summary -->
                                    <div class="section-body">
                                     <i>  <p class="text-muted mb-3">Teaching Summary after Joining IITH as <span class="promotionPost"></span>.</p></i> 
                                    </div>
                                    <div id="teachingSummaryContainer"></div>
                                </div>
                            </div>

                            <!-- SECTION 3: PUBLICATIONS -->
                            <div class="card section-card">
                                <div class="section-header">
                                    <h5 class="section-title">8. Publications after Joining IITH as <span class="promotionPost"></span>.</h5>
                                </div>

                                <div class="col-md-6">
                                            <label for="fid" class="form-label">8A. Scopus Link: <span class="required">*</span></label>
                                            <input type="text" name="slink" class="form-control" placeholder="Scopus Link" value="{{ old('slink') }}" required>
                                        </div>
                                <div class="section-body">
                                    <!-- Publications Section 6A -->
                                    <div class="section-6A">

                                    
                                        <div class="publication-section">
                                            <h6>8B. Publications for Assistant Professor to Associate Professor</h6>
                                           
                                            <div id="uploadProgress" class="upload-progress">
                                                <div class="progress-bar">
                                                    <div class="progress-fill"></div>
                                                </div>
                                                <div class="upload-status" id="uploadStatus">Processing...</div>
                                            </div>
                                                 
                                            <table>
                                               <tr><td colspan="5" style="color: red;"><strong>Section A:</strong> List of publications after joining IITH with no student from IITH as a co-author. Only Q1 journal publications should be listed. <br> In case AI, CSE, EE (Communications specialization) and  Maths disciplines, Conference proceedings are allowed to be listed provided they are A and A* venues as per CORE Ranking. </td></tr>
                                           
                                                <tr>
                                                    <td width="5%"></td>
                                                    <td width="25%">Journal Publications</td>
                                                    <td width="20%">
                                                        <a href="{{ asset('excel_formats/journal_format.xlsx') }}" target="_blank">Download Format</a>
                                                    </td>
                                                    <td width="30%">
                                                        <input type="file" class="excel-upload" data-section="A" data-type="journal" data-post="ap_asp" accept=".xlsx,.xls" />
                                                    </td>
                                                    <td width="20%">
                                                        <button type="button" class="btn btn-sm btn-outline-primary preview-btn" data-section="A" data-type="journal">Preview</button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td>Conference Proceedings</td>
                                                    <td>
                                                        <a href="{{ asset('excel_formats/conference_format.xlsx') }}" target="_blank">Download Format</a>
                                                    </td>
                                                    <td>
                                                        <input type="file" class="excel-upload" data-section="A" data-type="conference" data-post="ap_asp" accept=".xlsx,.xls" />
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-outline-primary preview-btn" data-section="A" data-type="conference">Preview</button>
                                                    </td>
                                                </tr>

                                                <tr><td colspan="5" style="color: red;"><strong>Section B: </strong>List of publications after joining IITH with students from IITH as co-authors. Only Q1 journal publications should be listed. <br> In case AI, CSE, EE (Communications specialization) and Maths disciplines, Conference proceedings are allowed to be listed provided they are A and A* venues as per CORE Ranking. </td></tr>
                                                <tr>
                                                    <td></td>
                                                    <td>Journal Publications</td>
                                                    <td>
                                                        <a href="{{ asset('excel_formats/journal_format.xlsx') }}" target="_blank">Download Format</a>
                                                    </td>
                                                    <td>
                                                        <input type="file" class="excel-upload" data-section="B" data-type="journal" data-post="ap_asp" accept=".xlsx,.xls" />
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-outline-primary preview-btn" data-section="B" data-type="journal">Preview</button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td>Conference Proceedings</td>
                                                    <td>
                                                        <a href="{{ asset('excel_formats/conference_format.xlsx') }}" target="_blank">Download Format</a>
                                                    </td>
                                                    <td>
                                                        <input type="file" class="excel-upload" data-section="B" data-type="conference" data-post="ap_asp" accept=".xlsx,.xls" />
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-outline-primary preview-btn" data-section="B" data-type="conference">Preview</button>
                                                    </td>
                                                </tr>
                                            </table>

                                            <div id="publications6AContainer"></div>
                                        </div>
                                    </div>

                                    <!-- Publications Section 6B -->
                                    <div class="section-6B">
                                        <div class="publication-section">
                                            <h6>8B. Publications for Associate Professor to Professor</h6>
                                           
                                            <div id="uploadProgress6B" class="upload-progress">
                                                <div class="progress-bar">
                                                    <div class="progress-fill"></div>
                                                </div>
                                                <div class="upload-status" id="uploadStatus6B">Processing...</div>
                                            </div>

                                            <table>
                                              <!-- <tr><td colspan="5"><strong>Section A:</strong> List of publications before becoming ASP (after becoming AP) with no student from IITH as a co-author.</td></tr>
                                                <tr><b><p style="color: red;">In case of Journals, the Impact Factor of the journal and whether it is a Q1 should be <br>
                                                    clearly mentioned for each publication. Any publication other than Q1 need not be listed. <br> <br>
                                                    In the case of Conference proceedings only for AI, CSE, EE (Communications specialization) and Maths disciplines, the quality of the venue (A or A*) should be clearly <br>
                                                    mentioned for every publication. Any conference paper other than A or A* need not be listed.</p></b> </tr>
                                                  <tr>

                                                    <td width="5%"></td>
                                                    <td width="25%">Journal Publications</td>
                                                    <td width="20%">
                                                        <a href="{{ asset('excel_formats/journal_format.xlsx') }}" target="_blank">Download Format</a>
                                                    </td>
                                                    <td width="30%">
                                                        <input type="file" class="excel-upload" data-section="A" data-type="journal" data-post="asp_p" accept=".xlsx,.xls" />
                                                    </td>
                                                    <td width="20%">
                                                        <button type="button" class="btn btn-sm btn-outline-primary preview-btn" data-section="A" data-type="journal">Preview</button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td>Conference Proceedings</td>
                                                    <td>
                                                        <a href="{{ asset('excel_formats/conference_format.xlsx') }}" target="_blank">Download Format</a>
                                                    </td>
                                                    <td>
                                                        <input type="file" class="excel-upload" data-section="A" data-type="conference" data-post="asp_p" accept=".xlsx,.xls" />
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-outline-primary preview-btn" data-section="A" data-type="conference">Preview</button>
                                                    </td>
                                                </tr>

                                                <tr><td colspan="5"><strong>Section B:</strong> List of publications before becoming ASP (after becoming AP), with students from IITH as co-authors.</td></tr>
                                                <tr>
                                                    <td></td>
                                                    <td>Journal Publications</td>
                                                    <td>
                                                        <a href="{{ asset('excel_formats/journal_format.xlsx') }}" target="_blank">Download Format</a>
                                                    </td>
                                                    <td>
                                                        <input type="file" class="excel-upload" data-section="B" data-type="journal" data-post="asp_p" accept=".xlsx,.xls" />
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-outline-primary preview-btn" data-section="B" data-type="journal">Preview</button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td>Conference Proceedings</td>
                                                    <td>
                                                        <a href="{{ asset('excel_formats/conference_format.xlsx') }}" target="_blank">Download Format</a>
                                                    </td>
                                                    <td>
                                                        <input type="file" class="excel-upload" data-section="B" data-type="conference" data-post="asp_p" accept=".xlsx,.xls" />
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-outline-primary preview-btn" data-section="B" data-type="conference">Preview</button>
                                                    </td>
                                                </tr> -->

                                               <tr><td colspan="5" style="color: red;"><strong>Section A:</strong> List of publications after joining IITH with no student from IITH as a co-author. Only Q1 journal publications should be listed. <br> In case AI, CSE, EE (Communications specialization) and  Maths disciplines, Conference proceedings are allowed to be listed provided they are A and A* venues as per CORE Ranking. </td></tr>
                                                <tr>
                                                    <td></td>
                                                    <td>Journal Publications</td>
                                                    <td>
                                                        <a href="{{ asset('excel_formats/journal_format.xlsx') }}" target="_blank">Download Format</a>
                                                    </td>
                                                    <td>
                                                        <input type="file" class="excel-upload" data-section="C" data-type="journal" data-post="asp_p" accept=".xlsx,.xls" />
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-outline-primary preview-btn" data-section="C" data-type="journal">Preview</button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td>Conference Proceedings</td>
                                                    <td>
                                                        <a href="{{ asset('excel_formats/conference_format.xlsx') }}" target="_blank">Download Format</a>
                                                    </td>
                                                    <td>
                                                        <input type="file" class="excel-upload" data-section="C" data-type="conference" data-post="asp_p" accept=".xlsx,.xls" />
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-outline-primary preview-btn" data-section="C" data-type="conference">Preview</button>
                                                    </td>
                                                </tr>

                                                <tr><td colspan="5" style="color: red;"><strong>Section B: </strong>List of publications after joining IITH with students from IITH as co-authors. Only Q1 journal publications should be listed. <br> In case AI, CSE, EE (Communications specialization) and Maths disciplines, Conference proceedings are allowed to be listed provided they are A and A* venues as per CORE Ranking. </td></tr>
                                                <tr>
                                                    <td></td>
                                                    <td>Journal Publications</td>
                                                    <td>
                                                        <a href="{{ asset('excel_formats/journal_format.xlsx') }}" target="_blank">Download Format</a>
                                                    </td>
                                                    <td>
                                                        <input type="file" class="excel-upload" data-section="D" data-type="journal" data-post="asp_p" accept=".xlsx,.xls" />
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-outline-primary preview-btn" data-section="D" data-type="journal">Preview</button>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td>Conference Proceedings</td>
                                                    <td>
                                                        <a href="{{ asset('excel_formats/conference_format.xlsx') }}" target="_blank">Download Format</a>
                                                    </td>
                                                    <td>
                                                        <input type="file" class="excel-upload" data-section="D" data-type="conference" data-post="asp_p" accept=".xlsx,.xls" />
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn btn-sm btn-outline-primary preview-btn" data-section="D" data-type="conference">Preview</button>
                                                    </td>
                                                </tr>
                                            </table>

                                            <div id="publications6BContainer"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                                   <!-- SECTION 6: PhD students -->
                            <div class="card section-card">
                                <div class="section-header">
                                      <h5 class="section-title">9. PhD guidance: List of graduated and ongoing PhD students at IITH as <span class="promotionPost"></span>..</h5>
                                        <button type="button" class="btn btn-primary btn-sm add-btn" data-bs-toggle="modal" data-bs-target="#phdModal">
                                            + Add PhD Student
                                        </button>
                                </div>
                                <div class="section-body">
                                    <p class="text-muted mb-3">PhD guidance: List of graduated and ongoing PhD students at IITH.</p>
                                    <div id="phdContainer" class="mb-4"></div>
                            

                                    <!-- Other text areas -->
                                    
                                   
                                        </div>
                            </div>

                            <!-- SECTION 4: PROJECTS -->
                            <div class="card section-card">
                                <div class="section-header">
                                    <h5 class="section-title">10. Projects after Joining IITH as <span class="promotionPost"></span>.</h5>
                                    <button type="button" class="btn btn-primary btn-sm add-btn" data-bs-toggle="modal" data-bs-target="#projectModal">
                                        + Add Project
                                    </button>
                                </div>
                                <div class="section-body">
                                    <p class="text-muted mb-3">Completed and ongoing Projects (sponsored/Consultancy) handled at IITH:</p>
                                    <div id="projectContainer"></div>
                                </div>
                            </div>

                            <!-- SECTION 5: PATENTS -->
                            <div class="card section-card">
                                <div class="section-header">
                                    <h5 class="section-title">11. Patents after Joining IITH as <span class="promotionPost"></span>.</h5>
                                    <button type="button" class="btn btn-primary btn-sm add-btn" data-bs-toggle="modal" data-bs-target="#patentModal">
                                        + Add Patent
                                    </button>
                                </div>
                                <div class="section-body">
                                    <p class="text-muted mb-3">Patents, if any: Granted and filed from IITH.</p>
                                    <div id="patentContainer"></div>
                                </div>
                            </div>

                            
                     

                            

                            <!-- SECTION 6: OTHER DETAILS -->
                            <div class="card section-card">
                                <div class="section-header">
                                    <h5 class="section-title">Other Details after Joining IITH  as <span class="promotionPost"></span>.</h5>
                                </div>
                                <div class="section-body">
                                    <!-- PhD guidance -->
                                    <div class="section-header">
                                     

                                    

                                    </div>

                                     <div class="mb-3">
                                        <label class="form-label">12. Awards/Honors received after joining IITH as <span class="promotionPost"></span>.</label>
                                        <textarea name="awards" class="form-control" rows="2" placeholder="Awards/Honors received after joining IITH">{{ old('awards') }}</textarea>
                                    </div>
                                      <div class="mb-3">
                                        <label class="form-label">13. Technology developed and transferred, if any from IITH as <span class="promotionPost"></span>..</label>
                                        <textarea name="technology" class="form-control" rows="2" placeholder="Technology developed and transferred">{{ old('technology') }}</textarea>
                                    </div>

                                    
                                    <div class="mb-3">
                                        <label class="form-label">14. Infrastructure established at IITH as <span class="promotionPost"></span>. (those with institute/JICA funds and those from individual project funds should be specified separately)</label>
                                        <textarea name="infrastructure" class="form-control" rows="2" placeholder="Infrastructure established at IITH">{{ old('infrastructure') }}</textarea>
                                    </div>  

                                      <div class="mb-3">
                                        <label class="form-label">15. Administrative Activities at IITH as <span class="promotionPost"></span>.:</label>
                                        <textarea name="admin_activities" class="form-control" rows="2" placeholder="Administrative Activities at IITH">{{ old('admin_activities') }}</textarea>
                                    </div>

                                                         


                                  

                                    <div class="mb-3">
                                        <label class="form-label">16. Outreach Activities at IITH as <span class="promotionPost"></span>.:</label>
                                        <textarea name="outreach" class="form-control" rows="2" placeholder="Outreach Activities at IITH">{{ old('outreach') }}</textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">17. National level responsibilities, if any at IITH as <span class="promotionPost"></span>.:</label>
                                        <textarea name="national_responsibilities" class="form-control" rows="2" placeholder="National level responsibilities">{{ old('national_responsibilities') }}</textarea>
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label">18. Any other Information at IITH as <span class="promotionPost"></span>.:</label>
                                        <textarea name="anyother" class="form-control" rows="2" placeholder="Any other Information">{{ old('anyother') }}</textarea>
                                    </div>


                                      <div class="cv-upload-section">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <label for="cv_upload" class="form-label">Upload CV (PDF only, max 2MB) <span class="required">*</span></label>
                                                <input type="file" name="cv_upload" id="cv_upload" class="form-control" accept=".pdf" required>
                                                <div class="file-upload-info">
                                                    <small>Please upload your CV in PDF format. Maximum file size: 2MB.</small>
                                                </div>
                                                <div id="cv_preview" class="file-preview" style="display: none;">
                                                    <strong>Selected File:</strong> <span id="cv_file_name"></span> (<span id="cv_file_size"></span>)
                                                </div>
                                                <div id="cv_error" class="text-danger mt-1" style="display: none;"></div>
                                            </div>
                                        </div>
                                    </div>
                                

                            <div class="form-group mt-3">
                                <div style="display:flex; align-items:flex-start;">
                              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;      
                            <input type="checkbox" id="declaration" value="1" name="declaration" style="transform: scale(1.8); margin-top:8px; margin-right:15px; cursor:pointer;" required>
                                    <label for="declaration" style="line-height:1.7;color:#000; ">
                                        <strong>Declaration:</strong>  
                                        I hereby declare that the information provided above is true, complete, and correct to the best of my knowledge. <br> I understand that if any information furnished by me is found to be false, incorrect, misleading, or incomplete at any stage, <br> my application is liable to be rejected without any further notice.
                                    </label>

                                </div>
                            </div>
                                    </div>

</div>
                                </div>
                            </div>

                            <!-- Save Buttons -->
                            <div class="save-buttons">
                                <button type="button" class="btn btn-outline-primary" id="saveDraftBtn">
                                    Save as Draft
                                </button>
                                <button type="submit" class="btn btn-primary" id="submitBtn">
                                    Submit Application
                                </button>
                                <span class="text-muted ms-3" id="saveStatus"></span>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

<!-- Modals (keep the same modals as before) -->
<!-- Excel Preview Modal -->
<div class="modal fade" id="excelPreviewModal" tabindex="-1">
    <div class="modal-dialog modal-xl">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="excelPreviewModalTitle">Excel Data Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body modal-preview-content">
                <div id="excelPreviewContent"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-success" id="confirmUploadBtn">Confirm & Save</button>
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
            </div>
        </div>
    </div>
</div>

<!-- PhD, Project, Patent Modals (keep the same as before) -->
<div class="modal fade" id="phdModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add PhD Student</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                   <span class="required">All fields are Mandatory</span> 
                <div class="row">
                  
                    <div class="col-md-6 mb-3">
                       
                        <label class="form-label">Status of the Student<span class="required">*</span></label>
                        <select class="form-control" id="phdStatus">
                            <option value="">-- Select --</option>
                            <option value="Graduated">Graduated</option>
                            <option value="Ongoing">Ongoing</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Student Name<span class="required">*</span></label>
                        <input type="text" class="form-control" id="phdName" placeholder="Student Name">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Year of graduation (if Graduated)/Year of Joining (if ongoing)<span class="required">* ex:"2012"(✓)"3rd year"(x)</span></label>
                <input type="number" class="form-control year-only-picker" id="phdYear" min="1900" max="2099" step="1" placeholder="YYYY">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Current employement Position (if Graduated)/Current year of PhD (if ongoing)<span class="required">*</span></label>
                        <input type="text" class="form-control" id="phdPosition" placeholder="Position if Graduated/current year if ongoing">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="addPhdRecord()">Add Student</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="projectModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Project</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <span class="required">All fields are Mandatory</span> 
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">PI/Co-PI<span class="required">*</span></label>
                        <select class="form-control" id="projectPI">
                            <option value="PI">PI</option>
                            <option value="CO-PI">CO-PI</option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Project Title <span class="required">*</span></label>
                        <input type="text" class="form-control" id="projectTitle" placeholder="Project Title">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Sponsoring Agency<span class="required">*</span></label>
                        <input type="text" class="form-control" id="projectAgency" placeholder="Agency">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Period<span class="required">*</span></label>
                        <input type="text" class="form-control" id="projectPeriod" placeholder="Period">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Cost (₹ Lakhs)<span class="required">*</span></label>
                        <input type="number" class="form-control" id="projectCost" placeholder="Cost">
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="addProjectRecord()">Add Project</button>
            </div>
        </div>
    </div>
</div>

<div class="modal fade" id="patentModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add Patent</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <span class="required">All fields are Mandatory</span> 
                <div class="row">
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Patent No.<span class="required">*</span></label>
                        <input type="text" class="form-control" id="patentNo" placeholder="Patent No.">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Patent Name<span class="required">*</span></label>
                        <input type="text" class="form-control" id="patentName" placeholder="Patent Name">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Inventors<span class="required">*</span></label>
                        <input type="text" class="form-control" id="patentInventor" placeholder="Inventors">
                    </div>
                    <div class="col-md-6 mb-3">
                        <label class="form-label">Status<span class="required">*</span></label>
                        <select class="form-control" id="patentStatus">
                            <option value="Granted">Granted</option>
                            <option value="Filed">Filed</option>
                            <option value="Published">Published</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="addPatentRecord()">Add Patent</button>
            </div>
        </div>
    </div>
</div>
</div>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>

<script>
// Global variables
let teachingCount = 0;
let phdCount = 0;
let projectCount = 0;
let patentCount = 0;
let currentUploadData = null;
let currentUploadConfig = null;

// Teaching record specific variables
let teachingUploadCount = 0;
let currentTeachingUploadData = null;

// Initialize when document is ready
$(document).ready(function() {
    // Post selection change
    $('#postSelect').change(function() {
        toggleSections();
    });

    // Teaching record upload handler
    $(document).on('change', '.teaching-excel-upload', function(e) {
        const file = e.target.files[0];
        if (!file) return;

        readTeachingExcelFile(file);
    });

    // Teaching record preview button handler
    $(document).on('click', '.teaching-preview-btn', function() {
        loadSavedTeachingPreview();
    });

    // Confirm upload handler for all uploads
    $(document).on('click', '#confirmUploadBtn', function() {
        console.log('Confirm button clicked');
       
        if (currentTeachingUploadData) {
            saveTeachingExcelData(currentTeachingUploadData);
            $('#excelPreviewModal').modal('hide');
        } else if (currentUploadData && currentUploadConfig) {
            // This is for publications
            saveExcelData(currentUploadData, currentUploadConfig);
            $('#excelPreviewModal').modal('hide');
        } else {
            alert('No data to save. Please upload a file first.');
        }
    });

 // Save draft handler
$('#saveDraftBtn').on('click', function() {
    $(this).prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2"></span>Saving...');
    $('#formStatus').val('draft');
    $('#facultyForm').submit();
});

// Submit handler
$('#submitBtn').on('click', function() {
    if (confirm('Are you sure you want to submit the application? This action cannot be undone.')) {
        $(this).prop('disabled', true).html('<span class="spinner-border spinner-border-sm me-2"></span>Submitting...');
        $('#formStatus').val('submitted');
        $('#facultyForm').submit();
    }
});
    // Publication upload handlers
    $(document).on('change', '.excel-upload', function(e) {
        const file = e.target.files[0];
        if (!file) return;

        currentUploadConfig = {
            section: $(this).data('section'),
            type: $(this).data('type'),
            post: $(this).data('post')
        };

        readExcelFile(file);
    });

    // Publication preview button handler - FIXED
    $(document).on('click', '.preview-btn:not(.teaching-preview-btn)', function() {
        const section = $(this).data('section');
        const type = $(this).data('type');
        const post = $(this).closest('.section-6A, .section-6B').hasClass('section-6A') ? 'ap_asp' : 'asp_p';
        console.log('Preview clicked:', section, type, post);
        loadSavedPreview(section, type, post);
    });

    // CV upload preview
    $('#cv_upload').on('change', function() {
        const file = this.files[0];
        const preview = $('#cv_preview');
        const errorDiv = $('#cv_error');
       
        if (file) {
            // Check file type
            if (file.type !== 'application/pdf') {
                errorDiv.text('Please upload a PDF file.').show();
                preview.hide();
                return;
            }
           
            // Check file size (2MB = 2 * 1024 * 1024 bytes)
            if (file.size > 2 * 1024 * 1024) {
                errorDiv.text('File size must be less than 2MB.').show();
                preview.hide();
                return;
            }
           
            // Show preview
            errorDiv.hide();
            $('#cv_file_name').text(file.name);
            $('#cv_file_size').text((file.size / (1024 * 1024)).toFixed(2) + ' MB');
            preview.show();
        }
    });

    // Initialize sections
    toggleSections();
});

// Toggle sections based on post selection
function toggleSections() {
    const postSelect = document.getElementById('postSelect');
    const section6A = document.querySelector('.section-6A');
    const section6B = document.querySelector('.section-6B');
   
    if (postSelect.value === 'Associate Professor') {
        section6A.style.display = 'block';
        section6B.style.display = 'none';
    } else if (postSelect.value === 'Professor') {
        section6A.style.display = 'none';
        section6B.style.display = 'block';
    } else {
        section6A.style.display = 'none';
        section6B.style.display = 'none';
    }
}

// ==============================================
// TEACHING RECORD UPLOAD FUNCTIONS (SEPARATE)
// ==============================================

function readTeachingExcelFile(file) {
    const reader = new FileReader();
   
    reader.onload = function(e) {
        try {
            const data = new Uint8Array(e.target.result);
            const workbook = XLSX.read(data, { type: 'array' });
            const firstSheet = workbook.Sheets[workbook.SheetNames[0]];
            const jsonData = XLSX.utils.sheet_to_json(firstSheet, { header: 1 });
           
            displayTeachingExcelPreview(jsonData);
            showTeachingUploadProgress();
        } catch (error) {
            alert('Error reading Excel file: ' + error.message);
            $('#teachingUploadProgress').hide();
        }
    };
   
    reader.onerror = function() {
        alert('Error reading file');
        $('#teachingUploadProgress').hide();
    };
   
    reader.readAsArrayBuffer(file);
}

function displayTeachingExcelPreview(data) {
    const previewContent = $('#excelPreviewContent');
    previewContent.empty();

    if (data.length === 0) {
        previewContent.html('<p>No data found in Excel file</p>');
    } else {
        let tableHtml = '<table class="preview-table"><thead><tr>';
       
        // Header row
        if (data.length > 0) {
            data[0].forEach(cell => {
                tableHtml += `<th>${cell || ''}</th>`;
            });
            tableHtml += '</tr></thead><tbody>';
           
            // Data rows (limit to 10 for preview)
            for (let i = 1; i < Math.min(data.length, 11); i++) {
                tableHtml += '<tr>';
                data[i].forEach(cell => {
                    tableHtml += `<td>${cell || ''}</td>`;
                });
                tableHtml += '</tr>';
            }
            tableHtml += '</tbody></table>';
           
            if (data.length > 10) {
                tableHtml += `<p>... and ${data.length - 10} more rows</p>`;
            }
        }

        previewContent.html(tableHtml);
    }

    $('#excelPreviewModalTitle').text('Teaching Records Preview - Confirm to Save');
    $('#excelPreviewModal').modal('show');
    currentTeachingUploadData = data;
}

function showTeachingUploadProgress() {
    $('#teachingUploadProgress').show();
    const progressFill = $('#teachingUploadProgress .progress-fill');
    const statusText = $('#teachingUploadStatus');
   
    let progress = 0;
    const interval = setInterval(() => {
        progress += 10;
        progressFill.css('width', progress + '%');
       
        if (progress >= 100) {
            clearInterval(interval);
            statusText.text('Processing complete - Ready to save');
        }
    }, 100);
}

function saveTeachingExcelData(data) {
    console.log('Saving teaching data:', data);
   
    const teachingRecords = [];
   
    // Skip header row and process data
    for (let i = 1; i < data.length; i++) {
        const row = data[i];
        // Check if row has valid data (first cell not empty)
        if (row && row.length > 0 && row[0] && row[0].toString().trim() !== '') {
            const teachingRecord = {
                course: row[3] || '',
                title: row[4] || '',
                semester: row[1] || '',
                credits: row[5] || '',
                students: row[7] || '',
                feedback: row[8] || '',
                instructors: row[6] || '',
                response : row[9] || '',
                SCORE: row[10] || '',
                ap: row[2] || '',
            };
            teachingRecords.push(teachingRecord);
        }
    }

    if (teachingRecords.length === 0) {
        alert('No valid teaching records found in the Excel file. Please check the format.');
        $('#teachingUploadProgress').hide();
        return;
    }

    // Clear existing teaching records first
    $('#teachingSummaryContainer').empty();
    teachingUploadCount = 0;
   
    // Add teaching records to the summary container
    addTeachingRecordsFromExcel(teachingRecords);

    // Hide progress and reset
    $('#teachingUploadProgress').hide();
    currentTeachingUploadData = null;
   
    // Clear file input
    $('.teaching-excel-upload').val('');
   
    alert(`Successfully imported ${teachingRecords.length} teaching records`);
    updateSaveStatus('Teaching records saved successfully!');
}

function addTeachingRecordsFromExcel(records) {
    const container = $('#teachingSummaryContainer');
   
    records.forEach((record, index) => {
        const itemId = `teaching_${teachingUploadCount}`;
       
        const itemHTML = ` <div class="dynamic-item" id="${itemId}">
        <button type="button" class="remove-item" onclick="removeTeachingRecord('${itemId}')">×</button>
        <input type="hidden" name="teaching[${teachingUploadCount}][course]" value="${record.course}">
        <input type="hidden" name="teaching[${teachingUploadCount}][title]" value="${record.title}">
        <input type="hidden" name="teaching[${teachingUploadCount}][semester]" value="${record.semester}">
        <input type="hidden" name="teaching[${teachingUploadCount}][credits]" value="${record.credits}">
        <input type="hidden" name="teaching[${teachingUploadCount}][students]" value="${record.students}">
        <input type="hidden" name="teaching[${teachingUploadCount}][feedback]" value="${record.feedback}">
        <input type="hidden" name="teaching[${teachingUploadCount}][instructors]" value="${record.instructors}">
        <input type="hidden" name="teaching[${teachingUploadCount}][response]" value="${record.response}">
        <input type="hidden" name="teaching[${teachingUploadCount}][SCORE]" value="${record.SCORE}">
        <input type="hidden" name="teaching[${teachingUploadCount}][ap]" value="${record.ap}">
       
        <strong>${record.course || 'N/A'}</strong> - ${record.title || 'N/A'}<br>
        <small>Semester: ${record.semester || 'N/A'} | Credits: ${record.credits || 'N/A'} | Students: ${record.students || 'N/A'} | Feedback: ${record.feedback || 'N/A'} | Instructors: ${record.instructors || 'N/A'}</small>
    </div>`;

        container.append(itemHTML);
        teachingUploadCount++;
    });
}

function removeTeachingRecord(itemId) {
    $('#' + itemId).remove();
}

function loadSavedTeachingPreview() {
    // Get current teaching records from the form
    const records = [];
    $('#teachingSummaryContainer .dynamic-item').each(function() {
        const $item = $(this);
        const record = {
            course: $item.find('input[name*="[course]"]').val(),
            title: $item.find('input[name*="[title]"]').val(),
            semester: $item.find('input[name*="[semester]"]').val(),
            credits: $item.find('input[name*="[credits]"]').val(),
            students: $item.find('input[name*="[students]"]').val(),
            feedback: $item.find('input[name*="[feedback]"]').val(),
            instructors: $item.find('input[name*="[instructors]"]').val(),
            response: $item.find('input[name*="[response]"]').val(),
            SCORE: $item.find('input[name*="[SCORE]"]').val(),
            ap: $item.find('input[name*="[ap]"]').val(),
        };
        records.push(record);
    });

    console.log('Found records:', records); // Debug line

    if (records.length === 0) {
        alert('No teaching records found. Please upload an Excel file first.');
        return;
    }

    displaySavedTeachingPreview(records);
}

function displaySavedTeachingPreview(records) {
    const previewContent = $('#excelPreviewContent');
    previewContent.empty();

    if (records.length === 0) {
        previewContent.html('<p>No teaching records found</p>');
    } else {
        let tableHtml = '<th>Course Number</th><th>Course Title</th><th>Acad Year</th><th>AP</th><th>Credits</th><th>Instructors</th><th>No. of Students</th><th>Instructor Feedback</th><th>Response Rate</th><th>Instructor Feedback obtained</th></tr></thead><tbody>';

records.forEach(record => {
    tableHtml += `<tr>
        <td>${record.course || ''}</td>
        <td>${record.title || ''}</td>
        <td>${record.semester || ''}</td>
        <td>${record.ap || ''}</td>
        <td>${record.credits || ''}</td>
        <td>${record.instructors || ''}</td>
        <td>${record.students || ''}</td>
        <td>${record.feedback || ''}</td>
        <td>${record.response || ''}</td>
        <td>${record.SCORE || ''}</td>
    </tr>`;
        });
       
        tableHtml += '</tbody></table>';
        previewContent.html(tableHtml);
    }

    $('#excelPreviewModalTitle').text('Current Teaching Records');
    $('#confirmUploadBtn').hide();
    $('#excelPreviewModal').modal('show');
   
    $('#excelPreviewModal').on('hidden.bs.modal', function() {
        $('#confirmUploadBtn').show();
    });
}

// ==============================================
// PUBLICATION FUNCTIONS (FIXED)
// ==============================================

function readExcelFile(file) {
    const reader = new FileReader();
   
    reader.onload = function(e) {
        try {
            const data = new Uint8Array(e.target.result);
            const workbook = XLSX.read(data, { type: 'array' });
            const firstSheet = workbook.Sheets[workbook.SheetNames[0]];
            const jsonData = XLSX.utils.sheet_to_json(firstSheet, { header: 1 });
           
            displayExcelPreview(jsonData);
            showUploadProgress();
        } catch (error) {
            alert('Error reading Excel file: ' + error.message);
        }
    };
   
    reader.onerror = function() {
        alert('Error reading file');
    };
   
    reader.readAsArrayBuffer(file);
}

function displayExcelPreview(data) {
    const previewContent = $('#excelPreviewContent');
    previewContent.empty();

    if (data.length === 0) {
        previewContent.html('<p>No data found in Excel file</p>');
    } else {
        let tableHtml = '<table class="preview-table"><thead><tr>';
       
        // Header row
        if (data.length > 0) {
            data[0].forEach(cell => {
                tableHtml += `<th>${cell || ''}</th>`;
            });
            tableHtml += '</tr></thead><tbody>';
           
            // Data rows (limit to 10 for preview)
            for (let i = 1; i < Math.min(data.length, 11); i++) {
                tableHtml += '<tr>';
                data[i].forEach(cell => {
                    tableHtml += `<td>${cell || ''}</td>`;
                });
                tableHtml += '</tr>';
            }
            tableHtml += '</tbody></table>';
           
            if (data.length > 10) {
                tableHtml += `<p>... and ${data.length - 10} more rows</p>`;
            }
        }

        previewContent.html(tableHtml);
    }

    // Set modal title based on current section
    const sectionTitle = getSectionTitle(currentUploadConfig.section, currentUploadConfig.type, currentUploadConfig.post);
    $('#excelPreviewModalTitle').text(`Excel Data Preview - ${sectionTitle}`);
   
    // Show modal
    $('#excelPreviewModal').modal('show');
    currentUploadData = data;
}

function getSectionTitle(section, type, post) {
    const postText = post === 'ap_asp' ? 'AP to ASP' : 'ASP to Professor';
    const sectionText = `Section ${section}`;
    const typeText = type === 'journal' ? 'Journal' : 'Conference';
   
    return `${postText} - ${sectionText} - ${typeText}`;
}

function showUploadProgress() {
    // Determine which progress element to use based on current section
    let progressElement, statusElement;
   
    if (currentUploadConfig.post === 'ap_asp') {
        progressElement = $('#uploadProgress');
        statusElement = $('#uploadStatus');
    } else {
        progressElement = $('#uploadProgress6B');
        statusElement = $('#uploadStatus6B');
    }
   
    progressElement.show();
    const progressFill = progressElement.find('.progress-fill');
    const statusText = statusElement;
   
    let progress = 0;
    const interval = setInterval(() => {
        progress += 10;
        progressFill.css('width', progress + '%');
       
        if (progress >= 100) {
            clearInterval(interval);
            statusText.text('Processing complete');
        }
    }, 100);
}

function saveExcelData(data, config) {
    const publications = [];
   
    // Skip header row and process data
    for (let i = 1; i < data.length; i++) {
        const row = data[i];
        if (row.length >= 1 && row[0] && row[0].toString().trim() !== '') {
            const publication = {
                title: row[1] || '',
                name: row[2] || '',
                authors: row[3] || '',
                year: row[4] || '',
                volume: row[5] || '',
                standard: row[6] || '',
                quartile: row[7] || '',
            };
            publications.push(publication);
        }
    }

    // Store in hidden field for form submission
    const fieldName = `excel_${config.post}_${config.section}_${config.type}`;
   
    // Remove existing hidden field if any
    $(`input[name="${fieldName}"]`).remove();
   
    // Add new hidden field
    $('<input>').attr({
        type: 'hidden',
        name: fieldName,
        value: JSON.stringify(publications)
    }).appendTo('#facultyForm');

    // Update UI - hide the correct progress based on section
    if (config.post === 'ap_asp') {
        $('#uploadProgress').hide();
    } else {
        $('#uploadProgress6B').hide();
    }
   
    currentUploadData = null;
    currentUploadConfig = null;
   
    // Clear file input
    $(`.excel-upload[data-section="${config.section}"][data-type="${config.type}"][data-post="${config.post}"]`).val('');
   
    alert(`Successfully imported ${publications.length} publications`);
    updateSaveStatus('Excel data saved successfully!');
}

function loadSavedPreview(section, type, post) {
    const fieldName = `excel_${post}_${section}_${type}`;
    console.log('Looking for saved data with field name:', fieldName);
   
    const savedData = $(`input[name="${fieldName}"]`).val();
    console.log('Saved data found:', savedData);
   
    if (savedData) {
        try {
            const publications = JSON.parse(savedData);
            console.log('Parsed publications:', publications);
            displaySavedPreview(publications, section, type, post);
        } catch (e) {
            console.error('Error parsing saved data:', e);
            alert('Error loading saved data: ' + e.message);
        }
    } else {
        alert('No saved data found for this section. Please upload and save data first.');
    }
}

function displaySavedPreview(publications, section, type, post) {
    const previewContent = $('#excelPreviewContent');
    previewContent.empty();

    if (publications.length === 0) {
        previewContent.html('<p>No saved publications</p>');
    } else {
        let tableHtml = '<table class="preview-table"><thead><tr>';
        tableHtml += '<th>Title</th><th>Name</th><th>Authors</th><th>Year</th><th>Volume</th><th>Standard / Impact Factor</th><th>Quartile</th></tr></thead><tbody>';

        publications.forEach(pub => {
            tableHtml += `<tr>
                <td>${pub.title || ''}</td>
                <td>${pub.name || ''}</td>
                <td>${pub.authors || ''}</td>
                <td>${pub.year || ''}</td>
                <td>${pub.volume || ''}</td>
                <td>${pub.standard || ''}</td>
                <td>${pub.quartile || ''}</td>
            </tr>`;
        });
       
        tableHtml += '</tbody></table>';
        previewContent.html(tableHtml);
    }

    // Set modal title
    const sectionTitle = getSectionTitle(section, type, post);
    $('#excelPreviewModalTitle').text(`Saved Data Preview - ${sectionTitle}`);
   
    // Show modal but hide confirm button for saved data preview
    $('#confirmUploadBtn').hide();
    $('#excelPreviewModal').modal('show');
   
    // Restore confirm button when modal is hidden
    $('#excelPreviewModal').on('hidden.bs.modal', function() {
        $('#confirmUploadBtn').show();
    });
}

function updateSaveStatus(message) {
    $('#saveStatus').text(message);
    setTimeout(() => $('#saveStatus').empty(), 3000);
}

// Record management functions
function addPhdRecord() {
    const status = $('#phdStatus').val();
    const name = $('#phdName').val();
    const year = $('#phdYear').val();
    const position = $('#phdPosition').val();

    if (!status || !name) {
        alert('Please fill required fields');
        return;
    }

    const container = $('#phdContainer');
    const itemId = `phd_${phdCount}`;

    const itemHTML = `
        <div class="dynamic-item" id="${itemId}">
            <button type="button" class="remove-item" onclick="removeItem('${itemId}')">×</button>
            <input type="hidden" name="phd_graduated[${phdCount}][statusphd]" value="${status}">
            <input type="hidden" name="phd_graduated[${phdCount}][name]" value="${name}">
            <input type="hidden" name="phd_graduated[${phdCount}][year]" value="${year}">
            <input type="hidden" name="phd_graduated[${phdCount}][position]" value="${position}">
           
            <strong>${name}</strong> - ${status}<br>
            <small>Year: ${year || 'N/A'} | Position: ${position || 'N/A'}</small>
        </div>
    `;

    container.append(itemHTML);
    phdCount++;
    $('#phdModal').modal('hide');
    resetModal('phdModal');
}

function addProjectRecord() {
    const pi = $('#projectPI').val();
    const title = $('#projectTitle').val();
    const agency = $('#projectAgency').val();
    const period = $('#projectPeriod').val();
    const cost = $('#projectCost').val();

    if (!title || !agency) {
        alert('Please fill required fields');
        return;
    }

    const container = $('#projectContainer');
    const itemId = `project_${projectCount}`;

    const itemHTML = `
        <div class="dynamic-item" id="${itemId}">
            <button type="button" class="remove-item" onclick="removeItem('${itemId}')">×</button>
            <input type="hidden" name="projects[${projectCount}][pi]" value="${pi}">
            <input type="hidden" name="projects[${projectCount}][title]" value="${title}">
            <input type="hidden" name="projects[${projectCount}][agency]" value="${agency}">
            <input type="hidden" name="projects[${projectCount}][period]" value="${period}">
            <input type="hidden" name="projects[${projectCount}][cost]" value="${cost}">
           
            <strong>${title}</strong> (${pi})<br>
            <small>Agency: ${agency} | Period: ${period} | Cost: ₹${cost} Lakhs</small>
        </div>
    `;

    container.append(itemHTML);
    projectCount++;
    $('#projectModal').modal('hide');
    resetModal('projectModal');
}

function addPatentRecord() {
    const no = $('#patentNo').val();
    const name = $('#patentName').val();
    const inventor = $('#patentInventor').val();
    const status = $('#patentStatus').val();

    if (!no || !name) {
        alert('Please fill required fields');
        return;
    }

    const container = $('#patentContainer');
    const itemId = `patent_${patentCount}`;

    const itemHTML = `
        <div class="dynamic-item" id="${itemId}">
            <button type="button" class="remove-item" onclick="removeItem('${itemId}')">×</button>
            <input type="hidden" name="patents[${patentCount}][no]" value="${no}">
            <input type="hidden" name="patents[${patentCount}][name]" value="${name}">
            <input type="hidden" name="patents[${patentCount}][inventor]" value="${inventor}">
            <input type="hidden" name="patents[${patentCount}][status]" value="${status}">
           
            <strong>${no}</strong> - ${name}<br>
            <small>Inventors: ${inventor} | Status: ${status}</small>
        </div>
    `;

    container.append(itemHTML);
    patentCount++;
    $('#patentModal').modal('hide');
    resetModal('patentModal');
}

function removeItem(itemId) {
    $('#' + itemId).remove();
}

function resetModal(modalId) {
    $('#' + modalId).find('input, select, textarea').val('');
}
</script>

    <script>
  const postSelect = document.getElementById('postSelect');

    function updatePromotionPost() {
        let displayText = '';

        if (postSelect.value === 'Associate Professor') {
            displayText = 'Assistant Professor';
        } else if (postSelect.value === 'Professor') {
            displayText = 'Associate Professor';
        }

        document.querySelectorAll('.promotionPost').forEach(span => {
            span.textContent = displayText;
        });
    }

    // Initial display
    updatePromotionPost();

    // Update on change
    postSelect.addEventListener('change', updatePromotionPost);
</script>
@endsection
