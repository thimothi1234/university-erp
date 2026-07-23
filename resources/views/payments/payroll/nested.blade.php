@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Budget Heads along with Sub-Heads</h1>
    <table class="table">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>status</th>
                <th>subs</th>
            </tr>
        </thead>
        <tbody>
            @foreach($employees as $employee)
            <tr>
                <td>{{ $employee->id }}</td>
                <td>{{ $employee->name }}</td>
                <td>{{ $employee->status }}</td>
                <td>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Sub Head ID</th>
                                <th>Project Name</th>
                                <th>Start Date</th>
                                <th>End Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($employee->head as $project)
                            <tr>
                                <td>{{ $project->id }}</td>
                                <td>{{ $project->head }}</td>
                                <td>{{ $project->amount }}</td>
                                <td>{{ $project->project_id }}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
