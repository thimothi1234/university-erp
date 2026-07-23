@extends('project.admin_master')

@section('project')

<div class="sl-mainpanel">
    <nav class="breadcrumb sl-breadcrumb">
        <a class="breadcrumb-item" href="">HR</a>
        <span class="breadcrumb-item active">Faculty Applications</span>
    </nav>

    <div class="row">
        <div class="col-lg-16">
            <div class="card card-default">
                <div class="card-header card-header-border-bottom">
                    <h4>FACULTY APPLICATIONS</h4>
                    <!-- <a href="{{ route('HRM.create') }}" class="btn btn-primary btn-sm">+ New Application</a> -->
                   <STRONG>Window Closed</STRONG>  
                </div>
                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                      <th>ID</th>
                                    <th>Faculty ID</th>
                                    <th>Name</th>
                                    <th>Department</th>
                                    <th>Post Applied</th>
                                     <th>CV</th>
                                    <th>Status</th>
                                    <th>Last Updated</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($applications as $application)
                                <tr>
                                    <td>{{ $application->id }}</td>
                                    <td>{{ $application->fid }}</td>
                                    <td>{{ $application->name }}</td>
                                    <td>{{ $application->department }}</td>
                                    <td>{{ $application->post }}</td>
                                    <td><a href="{{asset($application->cv_path)}}" target="_blank">Open</a></td>
                                    <td>
                                        @if($application->form_status == 'draft')
                                            <span class="badge bg-warning">Draft</span>
                                        @else
                                            <span class="badge bg-success">Submitted</span>
                                        @endif
                                    </td>
                                    <td></td>
                                    <td>
                                        @if($application->form_status == 'draft')
                                            <a href="{{ route('HRM.edit', $application->id) }}" class="btn btn-sm btn-primary">
                                                Continue Editing
                                            </a>
                                             <a href="{{ route('HRM.show', $application->id) }}" class="btn btn-sm btn-info">
                                                View
                                            </a>
                                        @else
                                           <a href="{{ route('HRM.show', $application->id) }}" class="btn btn-sm btn-info">
                                                View
                                            </a>
                                        @endif
                                        
                                        @if($application->form_status == 'draft')
                                        <form action="{{ route('HRM.destroy', $application->id) }}" method="POST" class="d-inline">
                                            @csrf
                                            @method('DELETE')
                                          
                                        </form>
                                        
                                        @endif
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="7" class="text-center">No applications found.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection