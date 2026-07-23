<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\PaySheet;

class Dependentdropdown extends Component
{
    public $employees ;
    public $months = []; // Initialize as an empty array
    public $selectedEmployee = null;
    public $selectedMonth = null;

    public function mount()
    {
        // Retrieve distinct employee names
        $this->employees = PaySheet::distinct()->pluck('name')->toArray();
    }

    public function updatedSelectedEmployee($selectedEmployee)
    {
        //Update months based on selected employee
        // $this->months = PaySheet::where('name', $selectedEmployee)
        //                         ->pluck('month_with_year')
        //                         ->toArray();

       dd($selectedEmployee);
    }

    public function render()
    {
        return view('livewire.Dependentdropdown');
    }
}
