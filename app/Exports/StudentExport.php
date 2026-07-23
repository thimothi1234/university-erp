<?php 
namespace App\Exports;
 
use App\Models\tally;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\FromCollection;
 
class StudentExport implements FromCollection,WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */ 
    public function headings():array{
        return[
            'id',
            'name',
            'group',
            'balance',
            'Created_at',
            'Updated_at' 
        ];
    } 
    public function collection()
    {
        return tally::all();
    }
}