<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cea;
use Illuminate\Support\Facades\Auth;

use App\Models\transactions;
use App\Models\bank;
use App\Models\pfms;
use App\Models\project;
use App\Models\employee;
use App\Models\Tally;
use App\Models\costcentre;
use App\Models\ledger;
use App\Models\approval;
use App\Models\ta;
use App\Models\bulk;
use App\Models\project_head;
use DB;
use PDF;

class ProcessController extends Controller
{
    

    public function ceaindex()
    {
        $idd = Auth::user()->id;
        $payorders=cea::where('status','=',$idd)
        ->get();
        return view('process.ceaindex',compact('payorders'));
    }

    public function ceaprocess($id)
    {

        $payorders=bank::all();
        $pfms_schemes=pfms::all();
        $states=project::all();
        $bank_accounts=employee::all();
        $bud=Tally::all();
        $budss=Tally::where('group','=','2.1')->get();
        $buud=costcentre::all();
        $user = transactions::find($id);
        
        $ledger = ledger::where('transaction_id','=',$id)
        ->where('banks','!=',1)
        ->get();
        $cea=cea::where('id','=',$id)
        ->firstOrFail();


        $ledgerr = ledger::where('transaction_id','=',$id)
        ->where('banks','=',1)
        ->first();
        $sub = DB::table('ledgers')->where('id', $id)->pluck('costcentre');
        $subbu=project_head::where('project_id','=',$sub)->get();

        $countries = DB::table('projects')->pluck("name","id")->all();
       
        $countrie = DB::table('projects')->pluck("name","id")->all();

        return view('process.cea',compact('user','ledger','payorders','pfms_schemes','states','bank_accounts','bud','budss','buud','ledgerr','countries','subbu','countrie','cea'));
    }
}
