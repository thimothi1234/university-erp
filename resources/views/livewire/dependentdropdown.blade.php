<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dependent Dropdown</title>
    
</head>
<body>
    <div>
        <!-- Employee Selection -->
        <label for="employee">Select Employee:</label>
        <select wire:model="selectedEmployee" id="employee" class="form-control">
            <option value="">Select Name</option>
            @foreach($employees as $employee)
                <option value="{{ $employee }}">{{ $employee }}</option>
            @endforeach
        </select>

        <!-- Month Selection -->
        <label for="month">Select Month:</label>
        <select wire:model="selectedMonth" id="month" class="form-control">
            <option value="">Select Month</option>
            @if(is_array($months) && count($months) > 0)
                @foreach($months as $month)
                    <option value="{{ $month }}">{{ $month }}</option>
                @endforeach
            @endif
        </select>
    </div>

    
</body>
</html>
