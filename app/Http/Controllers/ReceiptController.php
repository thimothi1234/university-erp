<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\transactions;
use App\Models\bank;
use App\Models\bulk;
use App\Models\pfms;
use App\Models\project;
use App\Models\employee;
use App\Models\Tally;
use App\Models\costcentre;
use App\Models\ledger;
use App\Models\project_head;
Use Carbon\Carbon;
Use DB;
use Illuminate\Support\Facades\Auth;





class ReceiptController extends Controller
{

    function __construct()
    {
         $this->middleware('permission:voucher-list|voucher-create|voucher-edit|voucher-delete', ['only' => ['index','show']]);
         $this->middleware('permission:voucher-create', ['only' => ['create','store']]);
         $this->middleware('permission:voucher-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:product-delete', ['only' => ['destroy','allbills']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
  

        $id = Auth::user()->id;
        $payorders=transactions::where('debit_credit','=','Receipt')
        ->where('entered','=',$id )
        ->get();

        return view('payments.receipt.index',compact('payorders'));
    }

    public function advancedsearch()
    {
  

     
        $paymenttype=transactions::all()->unique('debit_credit');
        $employees=employee::select('name','id')->get();


        

        return view('payments.allvouchers.create',compact('paymenttype','employees'));
    }




    public function allbills(Request $request)
{
    $searchTerm = $request->input('search');

    $allowedBanks = DB::table('bank_access')
        ->where('user_id', Auth::id())
        ->pluck('bank')
        ->toArray();

    $hasAllAccess = in_array('all', $allowedBanks);

    if ($searchTerm) {

        $results = DB::table('transactions')
            ->select(
                'transactions.sum as sum',
                'transactions.drtotal as gross',
                'transactions.id as id',
                'transactions.narration',
                'transactions.status',
                'transactions.chequeno',
                'transactions.voucherno_bvrno',
                'transactions.fy',
                'transactions.transactiondate',
                'transactions.debit_credit',
                'employees.name as ven'
            )
            ->join('employees', 'transactions.vendor', '=', 'employees.id')
            ->where('transactions.vendor', '<>', 518);

        if (!$hasAllAccess) {
            $results->whereIn('transactions.bank', $allowedBanks);
        }

        $results = $results
            ->where(function ($query) use ($searchTerm) {
                $query->where('employees.name', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('transactions.narration', 'LIKE', "%{$searchTerm}%");
            })
            ->orderBy('transactions.id', 'desc')
            ->simplePaginate(200);



        $resultsb = DB::table('transactions')
            ->select(
                'bulks.net as sum',
                'bulks.gross as gross',
                'transactions.id as id',
                'transactions.narration',
                'transactions.status',
                'transactions.chequeno',
                'transactions.voucherno_bvrno',
                'transactions.fy',
                'transactions.transactiondate',
                'transactions.debit_credit',
                'employees.name as ven'
            )
            ->leftJoin('bulks', 'transactions.id', '=', 'bulks.transaction_id')
            ->join('employees', 'bulks.name', '=', 'employees.id');

        if (!$hasAllAccess) {
            $resultsb->whereIn('transactions.bank', $allowedBanks);
        }

        $resultsb = $resultsb
            ->where(function ($query) use ($searchTerm) {
                $query->where('employees.name', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('transactions.narration', 'LIKE', "%{$searchTerm}%");
            })
            ->orderBy('transactions.id', 'desc')
            ->simplePaginate(200);

    } else {

        $results = DB::table('transactions')
            ->select(
                'transactions.sum as sum',
                'transactions.drtotal as gross',
                'transactions.id as id',
                'transactions.narration',
                'transactions.status',
                'transactions.chequeno',
                'transactions.narration',
                'transactions.voucherno_bvrno',
                'transactions.fy',
                'transactions.transactiondate',
                'transactions.debit_credit',
                'employees.name as ven'
            )
            ->join('employees', 'transactions.vendor', '=', 'employees.id')
            ->where('transactions.vendor', '<>', 518);

        if (!$hasAllAccess) {
            $results->whereIn('transactions.bank', $allowedBanks);
        }

        $results = $results
            ->orderBy('transactions.id', 'desc')
            ->limit(2000)
            ->get();



        $resultsb = DB::table('transactions')
            ->select(
                'bulks.net as sum',
                'bulks.gross as gross',
                'transactions.id as id',
                'transactions.narration',
                'transactions.status',
                'transactions.chequeno',
                'transactions.narration',
                'transactions.voucherno_bvrno',
                'transactions.fy',
                'transactions.transactiondate',
                'transactions.debit_credit',
                'employees.name as ven'
            )
            ->leftJoin('bulks', 'transactions.id', '=', 'bulks.transaction_id')
            ->join('employees', 'bulks.name', '=', 'employees.id');

        if (!$hasAllAccess) {
            $resultsb->whereIn('transactions.bank', $allowedBanks);
        }

        $resultsb = $resultsb
            ->orderBy('transactions.id', 'desc')
            ->limit(2000)
            ->get();
    }

    return view('payments.allvouchers.index', compact('results', 'resultsb'));
}


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      
        $pfms_schemes=pfms::all();
        $states=project::where('status','=','1')->get();
        $bank_accounts=employee::all();
        $bud=Tally::all();
        $budss=Tally::where('group','=','2.1')->get();
        $countries = DB::table('projects')->where('status','=','1')->pluck("name","id")->all();
        $countrie = DB::table('projects')->where('status','=','1')->pluck("name","id")->all();

        return view('payments.receipt.create',compact('pfms_schemes','states','bank_accounts','bud','budss','countries','countrie'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        request()->validate([
            'narration' => 'required|min:50',
            
        ]);

        

        $price = DB::table('transactions')
        ->where('debit_credit','=','Receipt')
        ->where('fy','=','21-22')
                ->max('voucherno_bvrno');




        $project = transactions::create($request->all());
        $iid = $project->id;


        transactions::where('id', $iid)
        ->update([
            'voucherno_bvrno' => $price+1
         ]);
       
         foreach ($request->addmore as $key => $value) {
            $value['transaction_id'] = $iid;
            ledger::create($value);

        }

        foreach ($request->addmoreee as $key => $value) {
            $value['transaction_id'] = $iid;
            ledger::create($value);

        }

        

        return redirect()->route('receipt.index')
                        ->with('success','Receipt Entry successfully.');
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
        
        $pfms_schemes=pfms::all();
        $states=project::where('status','=','1')->get();
        $bank_accounts=employee::all();
        $bud=Tally::all();
        $budss=Tally::where('group','=','2.1')->get();

        $user = transactions::find($id);
        
        $ledger = ledger::where('transaction_id','=',$id)
        ->where('banks','!=',1)
        ->get();


        $ledgerr = ledger::where('transaction_id','=',$id)
        ->where('banks','=',1)
        ->first();

        $sub = DB::table('transactions')->where('id', $id)->pluck('project');
        $subbu=project_head::where('project_id','=',$sub)->get();
        $countries = DB::table('projects')->where('status','=','1')->pluck("name","id")->all();
        $countrie = DB::table('projects')->where('status','=','1')->pluck("name","id")->all();

        return view('payments.receipt.edit',compact('user','ledger','pfms_schemes','states','bank_accounts','bud','budss','ledgerr','countries','subbu','countrie'));
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
       
    
        return redirect()->route('receipt.index')
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
        //
    }
}
