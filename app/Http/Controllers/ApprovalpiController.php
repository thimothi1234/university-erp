<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\bank;
use App\Models\pfms;
use App\Models\project;
use App\Models\vendor;
use App\Models\Tally;
use App\Models\costcentre;
use App\Models\ledger;
use App\Models\ta;
use App\Models\approval;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use DB;

class ApprovalpiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    { 

        $id=Auth::user()->name;
        $payorders=DB::table('tas')
        ->select('tas.id as id', 'tas.created_at as created_at','tas.total as amount','tas.class as project','tas.name as vendor')
        ->where('tas.status','=',$id)
        ->get();
                return view('approvalpi.index',compact('payorders'));
    }
    public function date()
    {   
        
        
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $id=Auth::user()->name;
        $payorders=DB::table('transactions')
        ->select('transactions.id as id', 'transactions.created_at as created_at','transactions.sum as amount','projects.name as project','vendors.name as vendor')
        ->join('pis','transactions.project', '=', 'pis.PROJECT')
        ->join('users','pis.name', '=', 'users.name')
        ->join('vendors','transactions.vendor', '=', 'vendors.id')
        ->join('projects','transactions.project', '=', 'projects.id')
        ->where('transactions.status','=',2)
        ->where('transactions.debit_credit','=','Payment')
        ->where('users.name','=',$id)
        ->get();
                return view('approval.index',compact('payorders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $payorders = transactions::whereBetween('created_at', [$request->get('from'), $request->get('to')])->get();

        return redirect()->route('voucher.index', compact('payorders'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

   


    function approve($id)
{   

    $id1 = Auth::user()->id;
    $setting = new approval;
    $setting->transaction_id = $id;
    $setting->user_id = $id1;


    $setting->status = 1;
    $setting->created_at = Carbon::now();
  
    $setting->save();
    ta::find($id)->update(['status' => 'Approved by PI']);
    return redirect()->route('approvalpi.index')
                        ->with('success','Approved successfully.');
}


function reject($id)
{
    ta::find($id)->update(['status' => '0']);
    $id1 = Auth::user()->id;
    $setting = new approval;
    $setting->transaction_id = $id;
    $setting->user_id = $id1;
    $setting->externel = 'PI';

    $setting->status = 'Rejected by PI';
    $setting->created_at = Carbon::now();
  
    $setting->save();


    return redirect()->route('approval.index')
                        ->with('success','Rejected successfully.');
}
}