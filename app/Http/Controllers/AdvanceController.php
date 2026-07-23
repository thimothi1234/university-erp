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



class AdvanceController extends Controller
{


    function __construct()
    {
        $this->middleware('permission:voucher-create', ['only' => ['index']]);
         $this->middleware('permission:voucher-create', ['only' => ['create','store']]);
         $this->middleware('permission:voucher-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:voucher-delete', ['only' => ['destroy']]);
         $this->middleware('permission:voucher-create', ['only' => ['settle','creatte','index1']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
  public function index()
{
    $id = Auth::user()->id;

    // Step 1: Get all payorders at once
    $payorders = transactions::where('debit_credit', 'Advance')
        ->where('vendor', '!=', 518)
        // ->where('entered', $id)
        ->get();

    // Step 2: Extract all payorder IDs
    $payorderIds = $payorders->pluck('id')->toArray();

    // Step 3: Get all gross transactions in one query
    $grossMap = transactions::whereIn('project', $payorderIds)
        ->get()
        ->keyBy('project'); // project refers to the payorder ID

    // Step 4: Pass both payorders and grossMap to the view
    return view('payments.advance.index', compact('payorders', 'grossMap'));
}


    public function index1()
    {   
        $id = Auth::user()->id;
        $payorders=transactions::where('debit_credit','=','Advance')
        ->where('vendor','!=',518 )
        ->where('entered','=',$id )
        ->get();
      
    $payorderIds = $payorders->pluck('id')->toArray();

    // Step 3: Get all gross transactions in one query
    $grossMap = transactions::whereIn('project', $payorderIds)
        ->get()
        ->keyBy('project'); // project refers to the payorder ID


        return view('payments.advance.index1',compact('payorders', 'grossMap'));
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
        $bud=Tally::where('status','=',1)->get();
        $buad=Tally::all();
        $budss=Tally::where('group','=','2.1')->get();
        $buud=project::where('status','=','1')->get();
        $countries = DB::table('projects')->where('status','=','1')->pluck("name","id")->all();
        $countrie = DB::table('projects')->where('status','=','1')->pluck("name","id")->all();

        return view('payments.advance.create',compact('pfms_schemes','states','bank_accounts','bud','budss','buud','countries','countrie','buad'));
    
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

        

        return redirect()->away('selfadvances')
                        ->with('success','advance Entry successfully.');

        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $entries=transactions::find($id);
        $ledger=ledger::where('transaction_id','=',$id)
    
        ->where('amount','!=',0)
        ->orderBy('banks', 'ASC')
        ->get();

        $ledgerr=ledger::where('transaction_id','=',$id)
        ->orderBy('banks', 'ASC')
        ->first();
        $ledge=ledger::where('transaction_id','=',$id)
        ->where('cr_dr','=','Cr')
    
        ->orderBy('id', 'ASC')
        ->get();


        $ledge = DB::table('ledgers')
        ->select('ledgers.amount')
        ->join('tallies', 'tallies.id', '=', 'ledgers.ledger')
        ->where('ledgers.banks','=',1)
        ->where('ledgers.transaction_id','=',$id)
        


        ->get();


        $ar=approval::where('transaction_id','=',$id)
        ->where('user_id','=',28)
        ->first();
        $bulk=bulk::where('transaction_id','=',$id)
        ->get();

        
        $data=compact('entries','ledger','ar','ledge','ledgerr','bulk');


        $pdf = PDF::loadView('payments.voucher.print',$data);
    
        return $pdf->stream('Voucher.pdf');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        
        $pfms_schemes=pfms::orderBy('id', 'DESC')
        ->get();
        $states=project::where('status','=','1')->get();
        $bank_accounts=DB::table('employees')->where('status','=','1')
        ->groupBy('Account_Number')->get();
        $bud=Tally::where('status','=',1)->get();
        $budss=Tally::where('group','=','2.1')->get();
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

        return view('payments.advance.edit',compact('user','ledger','pfms_schemes','states','bank_accounts','bud','budss','ledgerr','countries','countrie'));
    }


    public function settle($id)
    {

       
        $pfms_schemes=pfms::orderBy('id', 'DESC')
        ->get();
        $states=project::all();
        $bank_accounts=DB::table('employees')->where('status','=','1')
        ->groupBy('Account_Number')->get();
        $bud=Tally::where('status','=',1)->get();
        $budss=Tally::where('group','=','2.1')->get();
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

        return view('payments.advance.settle',compact('user','ledger','pfms_schemes','states','bank_accounts','bud','budss','ledgerr','countries','countrie','id'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function creatte(Request $request)
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

        return redirect()->away('selfadvances')
                        ->with('success','advance settle Entry successfully.');
    
    }




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
    
        return redirect()->away('selfadvances')
                        ->with('success','advance updated successfully');





    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        transactions::find($id)->delete();
        ledger::where('transaction_id', '=', $id)->delete();
        return redirect()->route('advance.index')
                        ->with('success','advance Deleted successfully');
    }


   
}
