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
use App\Models\transactions;
use App\Models\approval;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use DB;

class ApprovalController extends Controller
{
    function __construct()
    {
         $this->middleware('permission:approval-list|approval-create|approval-edit|approval-delete', ['only' => ['index','show']]);
         $this->middleware('permission:approval-list|approval-create|approval-edit|approval-delete', ['only' => ['index1','show']]);
         $this->middleware('permission:approval-create', ['only' => ['create','store']]);
         $this->middleware('permission:approval-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:approval-delete', ['only' => ['destroy']]);
    }
    
    
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
   public function index()
{
    $userId = Auth::id();

    $approvals = DB::table('channel_of_approval')
        ->where('user_id', $userId)
        ->get();

    if ($approvals->isEmpty()) {
        abort(403, 'Unauthorized action.');
    }

    $query = Transactions::query();

    $query->where(function ($q) use ($approvals) {

        foreach ($approvals as $approval) {

            $q->orWhere(function ($sub) use ($approval) {

                $sub->where('transactions.status', $approval->status);

                if ($approval->bank != 'all') {
                    $sub->where('transactions.bank', $approval->bank);
                }

            });
        }
    });

    $payorders = $query->get();

    return view('approval.index', compact('payorders'));
}


   

    function approve($id)
{   

    if (Auth::user()->id == 570 OR Auth::user()->id == 576  OR Auth::user()->id == 51  OR Auth::user()->id == 101 OR Auth::user()->id == 433) 
    {
        //$titles = DB::table('transactions')->where('id','=',$id)->first()->sum;
        $titles = DB::table('ledgers')->where('transaction_id','=',$id)->where('cr_dr','=','Dr')->sum('amount');
        $limit = 50001; 
        if($titles >= $limit ) {
        $iddd = 2;
        }
        else { 
        $iddd = 3;
        }
    }
    elseif (Auth::user()->id == 720 ) 
    {
        $iddd = 4;
    }
    elseif (Auth::user()->id == 571)
    {
        $iddd = 4;
    }

    elseif (Auth::user()->id == 49)
    {
        $iddd = 4;
    }
    $id1 = Auth::user()->id;
    $setting = new approval;
    $setting->transaction_id = $id;
    $setting->user_id = $id1;
    $setting->status = 1;
    $setting->created_at = Carbon::now();
    $setting->save();
    transactions::find($id)->update(['status' => $iddd]);
    return redirect()->route('approval.index')
                        ->with('success','Approved successfully, Forwarding Section: '.$id);
}



// function approveledger($id)
// {   

//     if (Auth::user()->id == 570 OR Auth::user()->id == 576 ) 
//     {

     
//         Tally::find($id)->update(['status' => 1]);
//     return redirect()->route('tallies.index')
//                         ->with('success','Approved successfully.');
// }
// }


// public function indeex()
// {
//     $payorders=Tally::where('status','!=','1')->get();

//     return view('add.tallyhead.approve',compact('payorders'));
// }

public function approvebulk(Request $request)
{   
    $ids = $request->input('ckeck_user'); // Assuming array of IDs from checkboxes
    $userId = Auth::user()->id;
    $approvedCount = 0;
    $errors = [];

    if (!empty($ids) && is_array($ids)) {
        foreach ($ids as $id) {
            try {
                // Determine next status based on user and amount
                $nextStatus = null;
                if (in_array($userId, [570, 576, 51, 101])) {
                    $titles = DB::table('ledgers')->where('transaction_id', '=', $id)->where('cr_dr', '=', 'Dr')->sum('amount');
                    $limit = 50001;
                    $nextStatus = ($titles >= $limit) ? 2 : 3;
                } elseif ($userId == 720) {
                    $nextStatus = 4;
                } elseif ($userId == 571) {
                    $nextStatus = 4;
                }

                if ($nextStatus !== null) {
                    // Create approval record
                    $setting = new approval;
                    $setting->transaction_id = $id;
                    $setting->user_id = $userId;
                    $setting->status = 1;
                    $setting->created_at = Carbon::now();
                    $setting->save();

                    // Update transaction status
                    transactions::find($id)->update(['status' => $nextStatus]);
                    $approvedCount++;
                } else {
                    $errors[] = "Invalid status for transaction ID: $id";
                }
            } catch (\Exception $e) {
                $errors[] = "Error approving transaction ID $id: " . $e->getMessage();
            }
        }
    }

    $message = $approvedCount > 0 ? "Successfully approved $approvedCount transaction(s)." : "No transactions approved.";
    if (!empty($errors)) {
        $message .= " Errors: " . implode(', ', $errors);
    }

    return redirect()->route('approval.index')
                        ->with('success', $message);
}








// function reject($id)
// {
//     transactions::find($id)->update(['status' => '0']);
//     $id1 = Auth::user()->id;
//     $setting = new approval;
//     $setting->transaction_id = $id;
//     $setting->user_id = $id1;
//     $setting->status = 1;
//     $setting->created_at = Carbon::now();
  
//     $setting->save();


//     return redirect()->route('approval.index')
//                         ->with('success','Rejected successfully.');
// }
}