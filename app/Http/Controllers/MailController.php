<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\TestUserMail;
use Mail;
use DB;

class MailController extends Controller
{
    /**
     * Write Your Code..
     *
     * @return string
    */
    public function index()
    {
        $payorder=DB::table('bulks')
        
        ->join('transactions', 'transactions.id', '=','bulks.transaction_id')
        ->join('employees','bulks.name', '=', 'employees.id')
        ->select('employees.*','bulks.id')
         ->where('transactions.vendor','=',518)
        ->where('bulks.mail','=',0)
        ->get();

        return view('usersb', compact('payorder'));
    }    

    public function index2()
    {
        


         $payorder2=DB::table('transactions')
        ->join('employees', 'transactions.vendor', '=', 'employees.id')
        ->select('employees.*','transactions.id')
        ->where('transactions.mail','=',0)
        ->where('transactions.vendor','!=',518)
        ->get();

        return view('users', compact('payorder2'));
    }   

    /**
     * Write Your Code..
     *
     * @return string
    */
    public function sendMail(Request $request)
    {
     

         $users2=DB::table('transactions')
        ->join('employees', 'transactions.vendor', '=', 'employees.id')
        ->select('transactions.id as id','transactions.narration as narration'
        ,'transactions.sum as sum'
        ,'transactions.chequeno as chequeno'
        ,'transactions.transactiondate as transactiondate'
        ,'employees.name as name'
        ,'employees.Account_Number as Account_Number'
        ,'employees.Mail_ID as Mail_ID')
        ->whereIn('transactions.id',$request->ids)
        ->get();


        if ($users2->count() > 0) {
            foreach($users2 as $key => $value){
                if (!empty($value->Mail_ID)) {
                    $details = [
                        'id' => $value->id,
                      'subject' => $value->narration,
                      'amount' => $value->sum,
                      'chequeno' => $value->chequeno,
                      'transactiondate' => $value->transactiondate,
                      'name' => $value->name,
                      'Account_Number' => $value->Account_Number,
                      'Mail_ID' => $value->Mail_ID
                    ];

                    Mail::to($value->Mail_ID)->send(new TestUserMail($details));
                }
            }
        }

        return response()->json(['done']);
    }

    public function sendMail1(Request $request)
    {
 
        $users2 = DB::table('bulks')
        
        ->join('transactions', 'transactions.id', '=','bulks.transaction_id')
        ->join('employees','bulks.name', '=', 'employees.id')
        ->select('transactions.id as id','transactions.narration as narration'
        ,'bulks.net as sum'
        ,'transactions.chequeno as chequeno'
        ,'transactions.transactiondate as transactiondate'
        ,'employees.name as name'
        ,'employees.Account_Number as Account_Number'
        ,'employees.Mail_ID as Mail_ID')
        ->whereIn('bulks.id',$request->ids)
        ->get();

  
        if ($users2->count() > 0) {
            foreach($users2 as $key => $value){
                if (!empty($value->Mail_ID)) {
                    $details = [
                        'subject' => $value->narration,
                        'amount' => $value->sum,
                        'chequeno' => $value->chequeno,
                        'transactiondate' => $value->transactiondate,
                        'name' => $value->name,
                        'Account_Number' => $value->Account_Number,
                        'Mail_ID' => $value->Mail_ID
                    ];

                    Mail::to($value->Mail_ID)->send(new TestUserMail($details));
                }
            }
        }

        return response()->json(['done']);
    }
}
