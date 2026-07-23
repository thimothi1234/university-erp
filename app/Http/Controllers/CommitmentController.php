<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\transactions;
use App\Models\bank;
use App\Models\pfms;
use App\Models\project;
use App\Models\vendor;
use App\Models\Tally;
use App\Models\costcentre;
use App\Models\ledger;
use App\Models\approval;
use DB;
use PDF;



class CommitmentController extends Controller
{

    function __construct()
    {
         $this->middleware('permission:voucher-list|voucher-create|voucher-edit|voucher-delete', ['only' => ['index','show']]);
         $this->middleware('permission:voucher-create', ['only' => ['create','store']]);
         $this->middleware('permission:voucher-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:voucher-delete', ['only' => ['destroy']]);
         $this->middleware('permission:claim-create', ['only' => ['show1']]);
         $this->middleware('permission:claim-create', ['only' => ['show2']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response 
     */
    public function index()
    {

        $payorders = transactions::select(     
            'transactions.sum',
            'transactions.sub',
            'transactions.created_at',
            'transactions.id as id', 
            'transactions.drtotal',
            'transactions.narration',
            'projects.name as costcentre',
        DB::raw("COALESCE(project_heads.head, '') as subs")
        )
        ->join('ledgers', 'transactions.id', '=', 'ledgers.transaction_id')
        ->join('projects', 'ledgers.costcentre', '=', 'projects.id')
        ->leftjoin('project_heads', 'ledgers.sub', '=', 'project_heads.id' )
        ->where('debit_credit','=','commitment')
        ->orderBy('voucherno_bvrno', 'desc')
        ->get();


      

        return view('payments.commitment.index',compact('payorders'));
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
        $bank_accounts=DB::table('employees')
        ->groupBy('Account_Number')->get();
        $bud=Tally::all();
        $buad=Tally::all();
        $budss=Tally::where('group','=','2.1')->get();
        $buud=project::where('status','=','1')->get();
        $countries = DB::table('projects')->where('status','=','1')->pluck("name","id")->all();
        $countrie = DB::table('projects')->where('status','=','1')->pluck("name","id")->all();
        $commit =  transactions::max('sub');
        return view('payments.commitment.create',compact('pfms_schemes','states','bank_accounts','bud','budss','buud','countries','countrie','buad','commit'));
    
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

        return view('payments.commitment.settle',compact('user','ledger','pfms_schemes','states','bank_accounts','bud','budss','ledgerr','countries','countrie','id'));
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
        $gross=ledger::where('cr_dr','=','Dr')->where('transaction_id','=',$iid)->sum('amount');
        $row = transactions::where("id",$iid )->update(["drtotal" => $gross]);

        return redirect()->route('commitment.index')
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
        ->orderBy('banks', 'ASC')
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
        ->where('ledgers.transaction_id','=',$id)
        ->get();


        $ar=approval::where('transaction_id','=',$id)
        ->where('user_id','=',570)
        ->first();

        $dr=approval::where('transaction_id','=',$id)
        ->where('user_id','=',572)
        ->first();
    

        
        $data=compact('entries','ledger','ar','dr','ledge','ledgerr','leg','rai');


        $pdf = PDF::loadView('payments.commitment.print',$data);
    
        return $pdf->stream($id.''.'-Voucher.pdf');
    }

    // public function show1($id)
    // {


       
    //     $ledge = DB::table('pay_sheet1')
    //     ->where('pay_sheet1.id','=',$id)
    //     ->join('employees_profile','employees_profile.EID', '=', 'pay_sheet1.Employee_Id')
    //     ->first();

    //     $eid = $ledge->Employee_Id;
    //     $month =  $ledge->month;
    //     if (auth()->user()->id === $ledge->trackid) {
    //         $data = compact('ledge');
    
    //         $pdf = PDF::loadView('payments.commitment.printpa', $data);
    
    //         return $pdf->stream($eid.'-'.$month . '-Payslip.pdf');
    //     } else {
    //         // User is not authorized to view this record
    //         return abort(403); // You can customize this response as needed
    //     }
    // }


    public function show1($id)
    {


       
        $Dr = DB::table('pay_sheets')
                ->where('pay_sheets.pay_id', '=', $id)
                ->where('pay_sheet_details.type', '=', 'Dr')
                ->select(
                
                    'payhead.PayHead as payhead',
                    'pay_sheet_details.amount'
                )
                ->join('pay_sheet_details', 'pay_sheet_details.pay_sheet_id', '=', 'pay_sheets.pay_id')
                ->join('payhead', 'payhead.id', '=', 'pay_sheet_details.head_name') // Ensure pay_sheet_details.head_name and payhead.id are of the same type
                ->get();

                $Drsum = DB::table('pay_sheets')
                ->select(DB::raw('SUM(pay_sheet_details.amount) as eartot'))
                ->where('pay_sheets.pay_id', '=', $id)
                ->where('pay_sheet_details.type', '=', 'Dr')
                ->join('pay_sheet_details', 'pay_sheet_details.pay_sheet_id', '=', 'pay_sheets.pay_id')
                ->join('payhead', 'payhead.id', '=', 'pay_sheet_details.head_name') // Ensure pay_sheet_details.head_name and payhead.id are of the same type
                ->first();


            $Cr = DB::table('pay_sheets')
                ->where('pay_sheets.pay_id', '=', $id)
                ->where('pay_sheet_details.type', '=', 'Cr')
                ->select(
                
                    'payhead.PayHead as payhead',
                    'pay_sheet_details.amount'
                )
                ->join('pay_sheet_details', 'pay_sheet_details.pay_sheet_id', '=', 'pay_sheets.pay_id')
                ->join('payhead', 'payhead.id', '=', 'pay_sheet_details.head_name') // Ensure pay_sheet_details.head_name and payhead.id are of the same type
                ->get();


                $Crsum = DB::table('pay_sheets')
                ->select(DB::raw('SUM(pay_sheet_details.amount) as dedtot'))
                ->where('pay_sheets.pay_id', '=', $id)
                ->where('pay_sheet_details.type', '=', 'Cr')
                ->join('pay_sheet_details', 'pay_sheet_details.pay_sheet_id', '=', 'pay_sheets.pay_id')
                ->join('payhead', 'payhead.id', '=', 'pay_sheet_details.head_name') // Ensure pay_sheet_details.head_name and payhead.id are of the same type
                ->first();


              $details = DB::table('pay_sheets')
                ->where('pay_sheets.pay_id', '=', $id)
                ->select(
                    'pay_sheets.eid',
                
                    'pay_sheets.month',
                    'pay_sheets.name',
                    'employees_profile.PRAN',
                    'pay_sheets.designation',
                    'employees_profile.Function as department',
                    'employees_profile.Account_Number',
                    'employees_profile.DOJ',
                    'employees_profile.PAN',

                )
                ->join('employees_profile', 'employees_profile.EID', '=', 'pay_sheets.eid')
                ->first();

        $eid = $ledge->Employee_Id;
        $month =  $ledge->month;
        if (auth()->user()->id === $ledge->trackid) {
            $data = compact('Dr','Cr','details','Drsum','Crsum');
    
            $pdf = PDF::loadView('payments.commitment.printpan', $data);
    
            return $pdf->stream($eid.'-'.$month . '-Payslip.pdf');
        } else {
            // User is not authorized to view this record
            return abort(403); // You can customize this response as needed
        }
    }

       public function show2($id)
{
    $loggedInEid = auth()->user()->eid ?? null; // Get EID of logged-in user

    $paySheet = DB::table('pay_sheets')
        ->where('pay_id', $id)
        ->select('eid')
        ->first();

    if (!$paySheet || $paySheet->eid != $loggedInEid) {
        abort(403, 'Unauthorized access to payslip');
    }

    $Dr = DB::table('pay_sheets')
        ->where('pay_sheets.pay_id', '=', $id)
        ->where('pay_sheet_details.type', '=', 'Dr')
        ->select('payhead.PayHead as payhead', DB::raw('SUM(pay_sheet_details.amount) as amount'))
        ->join('pay_sheet_details', 'pay_sheet_details.pay_sheet_id', '=', 'pay_sheets.pay_id')
        ->join('payhead', 'payhead.id', '=', 'pay_sheet_details.head_name')
        ->orderBy('pay_sheet_details.amount', 'DESC')
        ->groupBy('payhead.PayHead')
        ->get();

    $Drsum = DB::table('pay_sheets')
        ->select(DB::raw('SUM(pay_sheet_details.amount) as eartot'))
        ->where('pay_sheets.pay_id', '=', $id)
        ->where('pay_sheet_details.type', '=', 'Dr')
        ->join('pay_sheet_details', 'pay_sheet_details.pay_sheet_id', '=', 'pay_sheets.pay_id')
        ->join('payhead', 'payhead.id', '=', 'pay_sheet_details.head_name')
        ->first();

    $Cr = DB::table('pay_sheets')
        ->where('pay_sheets.pay_id', '=', $id)
        ->where('pay_sheet_details.type', '=', 'Cr')
        ->select('payhead.PayHead as payhead', DB::raw('SUM(pay_sheet_details.amount) as amount'))
        ->join('pay_sheet_details', 'pay_sheet_details.pay_sheet_id', '=', 'pay_sheets.pay_id')
        ->join('payhead', 'payhead.id', '=', 'pay_sheet_details.head_name')
        ->orderBy('pay_sheet_details.amount', 'DESC')
        ->groupBy('payhead.PayHead')
        ->get();

    $Crsum = DB::table('pay_sheets')
        ->select(DB::raw('SUM(pay_sheet_details.amount) as dedtot'))
        ->where('pay_sheets.pay_id', '=', $id)
        ->where('pay_sheet_details.type', '=', 'Cr')
        ->join('pay_sheet_details', 'pay_sheet_details.pay_sheet_id', '=', 'pay_sheets.pay_id')
        ->join('payhead', 'payhead.id', '=', 'pay_sheet_details.head_name')
        ->first();

    $details = DB::table('pay_sheets')
        ->where('pay_sheets.pay_id', '=', $id)
        ->select(
            'pay_sheets.eid',
            'pay_sheets.fy',
            'pay_sheets.month',
            'pay_sheets.name',
            'employees_profile.PRAN',
            'pay_sheets.designation',
            'employees_profile.Function as department',
            'employees_profile.Account_Number',
            'employees_profile.DOJ',
            'employees_profile.PAN'
        )
        ->join('employees_profile', 'employees_profile.EID', '=', 'pay_sheets.eid')
        ->first();

    $data = compact('Dr', 'Cr', 'details', 'Drsum', 'Crsum');
    $pdf = PDF::loadView('payments.commitment.printpan', $data);

    return $pdf->stream($id . '-Payslip.pdf');
}

 


       
        public function generate()
        {
          // Fetch all employees (or filter by department, batch, etc.)
          $employees = DB::table('vpids')
                
                ->select(
                  'vpids.name as name',
                  'vpids.id as id',
                    'vpids.type as type',
                    'vpids.eid'
                   

                    )->where('vpids.id', '>', 1188)
                ->get();
            $pdf = Pdf::loadView('payments.commitment.id', compact('employees'), [], [
                'format' => 'A3', // Set A4 paper size
                'orientation' => 'P' // 'P' for Portrait, 'L' for Landscape
            ]);
    
            return $pdf->stream('idcards.pdf');
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
   
      
        
        $ledger = ledger::where('transaction_id','=',$id)
        ->where('banks','!=',1)
        ->get();


   
        $sub = DB::table('ledgers')->where('id', $id)->pluck('costcentre');
        // $subbu=project_head::where('project_id','=',$sub)->get();


        $user = transactions::find($id);
        $ledgerr = ledger::where('transaction_id','=',$id)
        ->first();
          $countries = DB::table('projects')->where('status','=','1')->pluck("name","id")->all();
        $countrie = DB::table('projects')->where('status','=','1')->pluck("name","id")->all();
        return view('payments.commitment.edit',compact('user','ledger','pfms_schemes','states','bank_accounts','bud','budss','ledgerr','countries','countrie'));

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
       
    
        return redirect()->route('commitment.index')
                        ->with('success','Commitment updated successfully');





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
        return redirect()->route('commitment.index')
                        ->with('success','commitment settle Entry successfully.');
    
    }
}
