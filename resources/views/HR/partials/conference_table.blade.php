@if($data->count() > 0)
<table class="table table-sm table-bordered table-striped">
    <thead>
        <tr>
            <th>Sl. No.</th>
            <th>Title</th>
            <th>Conference Name</th>
            <th>Author List</th>
            <th>Year</th>
            <th>Volume</th>
            <th>Standard (A/A*)</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $index => $pub)
        <tr>
            <td class="text-center">{{ $index + 1 }}</td>
            <td>{{ $pub->title ?: 'N/A' }}</td>
            <td>{{ $pub->journal_name ?: 'N/A' }}</td>
            <td>{{ $pub->authors ?: 'N/A' }}</td>
            <td>{{ $pub->year ?: 'N/A' }}</td>
            <td>{{ $pub->volume ?: 'N/A' }}</td>
            <td>{{ $pub->impact_factor ?: 'N/A' }}</td>
        </tr>
        @endforeach
    </tbody>
</table>
@else
<tr style="color: #666; font-style: italic;">No conference proceedings in this section.</tr>
@endif
