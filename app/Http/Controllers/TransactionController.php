<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\transactions;
use App\Models\pfms;
use App\Models\project;
use App\Models\employee;
use App\Models\Tally;
use App\Models\ledger;
use App\Models\approval;
use App\Models\ta;
use App\Models\bulk;
use App\Models\project_head;
use DB;
use Illuminate\Support\Facades\Auth;
use PDF;




class TransactionController extends Controller
{


    function __construct()
    {
         $this->middleware('permission:voucher-list|voucher-create|voucher-edit|voucher-delete', ['only' => ['index','show']]);
         $this->middleware('permission:voucher-create', ['only' => ['create','store']]);
         $this->middleware('permission:voucher-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:voucher-delete', ['only' => ['destroy']]);
         $this->middleware('permission:claim-create', ['only' => ['pos']]);
         $this->middleware('permission:claim-create', ['only' => ['mybills']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $id = Auth::user()->id;
        $payorders=transactions::where('debit_credit','=','Payment')
        ->where('entered','=',$id )
        ->where('vendor','!=',518 )
        ->orderBy('id', 'DESC')
        ->get();
      

        return view('payments.voucher.index',compact('payorders'));
    }
    public function mybills()
    {   
        $id = Auth::user()->email;
       
                $payorders = DB::table('transactions')
                ->select ('transactions.sum as sum','transactions.id as id',
                'transactions.narration','transactions.status','transactions.chequeno','transactions.created_at',
                'transactions.transactiondate','employees.name as ven')
                ->join('employees','transactions.vendor', '=', 'employees.id')
                ->where('employees.Mail_ID', '=', $id)
                ->get();


                $queries = DB::table('transactions')
                ->select ('bulks.net as sum','transactions.id as id',
                'transactions.narration','transactions.status','transactions.chequeno','transactions.created_at',
                'transactions.transactiondate','employees.name as ven')
                ->leftJoin('bulks','transactions.id', '=','bulks.transaction_id')
                ->join('employees', 'bulks.name', '=', 'employees.id')
                ->where('employees.Mail_ID', '=', $id)
                ->get();


        return view('payments.voucher.mybills',compact('payorders','queries'));
    }

    public function pos()
    {   
        $id = Auth::user()->name;
        $payorderss=transactions::where('vendor','=',$id)
        ->get();

         
         $payorders = DB::table('transactions')
        ->select ((DB::raw("COALESCE(bulks.net,transactions.sum) as sum")),'employees.Account_Number',
        'transactions.id','transactions.created_at','transactions.narration','transactions.status',
        'transactions.po as inwardsno','transactions.chequeno','transactions.transactiondate','employees.name as ven')
        ->leftJoin('bulks','transactions.id', '=','bulks.transaction_id')
        ->join('employees', (DB::raw("COALESCE(bulks.name,transactions.vendor)")), '=', 'employees.id')
        ->where('transactions.po', 'like', '%IITH/PUR%')
        ->orWhere('transactions.po', 'like', '%IITH/AMAND%')
        ->orWhere('transactions.po', 'like', '%GEM%')
        ->orWhere('transactions.po', 'like', '%IIITR/PUR%')
        ->get();
        return view('payments.voucher.pos',compact('payorders'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        
        $pfms_schemes=pfms::orderBy('id', 'DESC')
        ->get();
        $states=project::where('status','=','1')->get();
        $bank_accounts=DB::table('employees')->where('status','=','1')
        ->groupBy('Account_Number')->get();
        $bank_vend=DB::table('employees')->where('status','=','1')
        ->groupBy('Account_Number')->get();
        $bud=Tally::where('status','=',1)->get();
        $buad=Tally::all();
        $budss=Tally::where('group','=','2.1')->where('status','=','1')->get();
        $buud=project::where('status','=','1')->get();
        $countries = DB::table('projects')->where('status','=','1')->pluck("name","id")->all();
        $countrie = DB::table('projects')->where('status','=','1')->pluck("name","id")->all();

        return view('payments.voucher.create',compact('pfms_schemes','states','bank_accounts','bud','budss','buud','countries','countrie','buad','bank_vend'));
    
    }

    public function createi()
    {
        
   
        $pfms_schemes=pfms::orderBy('id', 'DESC')
        ->get();
        $states=project::where('status','=','1')->get();
        $bank_accounts=DB::table('employees')->where('status','=','1')
        ->groupBy('Account_Number')->get();
        $bud=Tally::where('status','=',1)->get();
        $buad=Tally::all();
        $adv=transactions::where('debit_credit','=','Advance')->where('vendor','!=','Advance')->get();
        $com=transactions::where('debit_credit','=','commitment')->get();
        $budss=Tally::where('group','=','2.1')->where('status','=','1')->get();
        $buud=project::where('status','=','1')->get();
        $countries = DB::table('projects')->where('status','=','1')->pluck("name","id")->all();
        $countrie = DB::table('projects')->where('status','=','1')->pluck("name","id")->all();

        return view('payments.voucher.create1',compact('pfms_schemes','states','bank_accounts','bud','budss','buud','countries','countrie','buad','adv','com'));
    
    }

    public function createiss()
    {
        
        
        $pfms_schemes=pfms::orderBy('id', 'DESC')
        ->get();
        $states=project::where('status','=','1')->get();
        $bank_accounts=DB::table('employees')->where('status','=','1')
        ->groupBy('Account_Number')->get();
        $bud=Tally::where('status','=',1)->get();
        $buad=Tally::all();
        $budss=Tally::where('group','=','2.1')->where('status','=','1')->get();
        $buud=project::where('status','=','1')->get();
        $countries = DB::table('projects')->where('status','=','1')->pluck("name","id")->all();
        $countrie = DB::table('projects')->where('status','=','1')->pluck("name","id")->all();

        return view('payments.voucher1.create',compact('pfms_schemes','states','bank_accounts','bud','budss','buud','countries','countrie','buad'));
    
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {       

        $project = transactions::create($request->all());
        $iid = $project->id;

        foreach ($request->addmore as $key => $value) {
            $value['transaction_id'] = $iid;
            ledger::create($value);
        }
        foreach ($request->addmoreee as $key => $value) {
            $value['transaction_id'] = $iid;
            ledger::create($value);
        }
        $gross=ledger::where('cr_dr','=','Dr')->where('transaction_id','=',$iid)->sum('amount');
        $row = transactions::where("id",$iid )->update(["drtotal" => $gross]);
        

        return redirect()->route('voucher.index')
                        ->with('success','Voucher Entry successfully.');

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
      

        $rai = ledger::where('transaction_id','=',$id)
        ->where('banks','=',1)
        ->first();


        
        $entries=transactions::find($id);
        $ledger=ledger::where('transaction_id','=',$id)
    
        ->where('amount','!=',0)
        ->orderBy('id', 'ASC')
        ->get();

        $ledgerr=ledger::where('transaction_id','=',$id)
        ->orderBy('banks', 'ASC')
        ->first();
        $ledge=ledger::where('transaction_id','=',$id)
        ->where('cr_dr','=','Cr')
        ->orderBy('id', 'ASC')
        ->get();
        $leg=ledger::where('transaction_id','=',$id)
        ->where('cr_dr','=','Cr')
        ->get()
        ->sum('amount');


        $ledge = DB::table('ledgers')
        ->select('ledgers.amount')
        ->join('tallies', 'tallies.id', '=', 'ledgers.ledger')
        ->where('ledgers.banks','=',1)
        ->where('ledgers.transaction_id','=',$id)
        


        ->get();


        $ar=approval::where('transaction_id','=',$id)
        ->whereIn('user_id', [570, 363, 576,565,51,101,433])
        ->first();

       

        $dr=approval::where('transaction_id','=',$id)
        ->whereIn('user_id', [571, 572, 720,49])
        ->first();


        $dra=approval::where('transaction_id','=',$id)
        ->where('user_id','=',571)
        ->first();

        $so=approval::where('transaction_id','=',$id)
        ->where('user_id','=',363)
        ->first();


        $draa=approval::where('transaction_id','=',$id)
        ->where('user_id','=',720)
        ->first();


        $bulk=bulk::where('transaction_id','=',$id)
        ->get();
        $path= 'file://10.6.160.10/FnA_Digital_Vouchers/44160.pdf';
        
        $data=compact('entries','ledger','ar','dr','ledge','ledgerr','bulk','leg','rai','path');

        
    
        $pdf = PDF::loadView('payments.voucher.print',$data);
        return $pdf->stream($id.''.'-Voucher.pdf');
    }


    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
     
        $conni = DB::table('transactions')->where('id','=',$id)->pluck("status")->first();
        $ind = Auth::user()->id;
      
    if ( $ind == 46   || in_array($conni, [1, 2, 3, 4])) {
        

    
        $pfms_schemes=pfms::orderBy('id', 'DESC')
        ->get();
        $states=project::where('status','=','1')->get();
        $bank_accounts=DB::table('employees')->where('status','=','1')
        ->get();
        $bank_accountss=DB::table('employees')->where('status','=','1')
        ->get();
        $bud=Tally::where('status','=',1)->get();
        $budss=Tally::where('group','=','2.1')->where('status','=','1')->get();
   
        $user = transactions::find($id);
        
        $ledger = ledger::where('transaction_id','=',$id)
        ->where('banks','!=',1)
        ->get();


        $ledgerr = ledger::where('transaction_id','=',$id)
        ->where('banks','=',1)
        ->first();
        $sub = DB::table('ledgers')->where('id', $id)->pluck('costcentre');
        // $subbu=project_head::where('project_id','=',$sub)->get();

          $countries = DB::table('projects')->where('status','=','1')->pluck("name","id")->all();
        $countrie = DB::table('projects')->where('status','=','1')->pluck("name","id")->all();

        return view('payments.voucher.edit',compact('user','ledger','pfms_schemes','states','bank_accounts','bank_accountss','bud','budss','ledgerr','countries','countrie'));
    }
   
    else {

echo "You can't edit this voucher";

    }
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
        $input = $request->all();
       
    
        $user = transactions::find($id);
        $user->update($input);

       

        $scores = $request->input('addmore');  //here scores is the input array param 

        foreach($scores as $row){
            $score = ledger::find($row['id']); 
            $score->ledger = $row['ledger']; 
            $score->costcentre = $row['costcentre']; 
            $score->sub = $row['sub']; 
            $score->cr_dr = $row['cr_dr']; 
            $score->amount = $row['amount']; 
            $score->save(); 
        }
        $scoress = $request->input('addmoreee');  //here scores is the input array param 

        foreach($scoress as $row){
            $score1 = ledger::find($row['id']); 
            $score1->ledger = $row['ledger']; 
            $score1->costcentre = $row['costcentre']; 
            $score1->cr_dr = $row['cr_dr']; 
            $score1->amount = $row['amount']; 
            $score1->save(); 
        }

        if($request->addmor === NULL){
       
    }
    else{

        $request->validate([
            'addmor.*.ledger' => 'required',
            'addmor.*.costcentre' => 'required',
            'addmor.*.cr_dr' => 'required',
            'addmor.*.amount' => 'required'
        ]);

        foreach ($request->addmor as $key => $value) {
            $value['transaction_id'] = $id;
            ledger::create($value);

        }
    }

    $gross=ledger::where('cr_dr','=','Dr')->where('transaction_id','=',$id)->sum('amount');
        $row = transactions::where("id",$id )->update(["drtotal" => $gross]);
       
    
        return redirect()->route('voucher.index')
                        ->with('success','Voucher updated successfully');





    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       
        transactions::where('id', $id)->delete();
        ledger::where('transaction_id', '=', $id)->delete();
        return redirect()->route('voucher.index')
                        ->with('success','Voucher Deleted successfully');
    }


   
}
