<?php
namespace App\Imports;

use App\Models\AddIncome;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class AddIncomeImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        return new AddIncome([
            'eid'     => $row['eid'],
            'fy'      => $row['fy'],
            'type'    => $row['type'],
            'gross'   => $row['gross'],
            'tds'     => $row['tds'],
            'month'   => $row['month'],
            'remarks' => $row['remarks'],
        ]);
    }
}
