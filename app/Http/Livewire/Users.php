<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\models\transactions;
use DB;

class Users extends Component
{
    public $users, $transactiondate, $chequeno, $user_id;
    public $updateMode = false;



   

    public function render()
    {
        $this->users = transactions::where('status','=','4')
        ->get();
        return view('livewire.users');
        
    }

    private function resetInputFields(){
        $this->transactiondate = '';
        $this->chequeno = '';
        $this->sum = '';
    }

    

    public function edit($id)
    {
        $this->updateMode = true;
        $user = transactions::where('id',$id)->first();
        $this->user_id = $id;
        $this->transactiondate = $user->transactiondate;
        $this->chequeno = $user->chequeno;
        $this->sum = $user->sum;
        
    }

    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();


    }

    public function update()
    {
        $validatedDate = $this->validate([
            'transactiondate' => 'required',
            'chequeno' => 'required',
            'sum' => 'required',
        ]);

        if ($this->user_id) {
            $user = transactions::find($this->user_id);

          
        $payorders = transactions::max('voucherno_bvrno');
            
            $user->update([
                'transactiondate' => $this->transactiondate,
                'chequeno' => $this->chequeno,
                'sum' => $this->sum,
                'status' => 'paid',
                'voucherno_bvrno' => $payorders+1
            ]);
            $this->updateMode = false;
            session()->flash('message', 'Users Updated Successfully.');
            $this->resetInputFields();

        }
    }

    public function delete($id)
    {
        if($id){
            transactions::where('id',$id)->delete();
            session()->flash('message', 'Users Deleted Successfully.');
        }
    }
}
