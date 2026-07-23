<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\transactions;
use App\Models\project;
use App\Models\ledger;
use App\Models\Tally;
use App\Models\project_head;
use DB;
use Illuminate\Support\Facades\Auth;


class ReportsController extends Controller
{


    function __construct()
    {
        $this->middleware('permission:product-delete', ['only' => ['index','budgetper','budget','fetchOutput','budgetin','trans','trans1','create']]);
         $this->middleware('permission:voucher-list|voucher-create|voucher-edit|voucher-delete', ['only' => ['index','show']]);
         $this->middleware('permission:voucher-create', ['only' => ['create','store']]);
         $this->middleware('permission:voucher-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:voucher-delete', ['only' => ['destroy']]);
         $this->middleware('permission:voucher-create', ['only' => ['settle','creatte']]);
         $this->middleware('permission:voucher-create', ['only' => ['budget']]);
         $this->middleware('permission:claim-create', ['only' => ['payslip','form16']]);
        
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   

        $category = $request->get('project');
   


        $payorders=DB::table('transactions')
        ->select('transactions.id as id', 'transactions.narration','transactions.transactiondate','ledgers.amount as sum','employees.name as vendor','tallies.name as bank','transactions.voucherno_bvrno')
        ->join('employees','transactions.vendor', '=', 'employees.id')
        ->join('ledgers','transactions.id', '=', 'ledgers.transaction_id')
        ->join('tallies','tallies.id', '=', 'ledgers.ledger')
        ->where('transactions.debit_credit','!=','Receipt')
        ->where('ledgers.cr_dr', '=', 'Dr')
        ->where('ledgers.costcentre', '=', $category)
        ->whereBetween('transactiondate', array($request->from, $request->to))
        ->where('transactions.status','=','paid')
        ->orderBy('voucherno_bvrno')
        ->get();


        $payordeer=DB::table('transactions')
        ->select('transactions.id as id', 'transactions.narration','transactions.transactiondate','ledgers.amount as sum','employees.name as vendor','tallies.name as bank','transactions.voucherno_bvrno')
        ->join('employees','transactions.vendor', '=', 'employees.id')
        ->join('ledgers','transactions.id', '=', 'ledgers.transaction_id')
        ->join('tallies','tallies.id', '=', 'ledgers.ledger')
        ->where('transactions.debit_credit','=','Receipt')
        ->where('ledgers.costcentre', '=', $category)
        ->whereBetween('transactiondate', array($request->from, $request->to))
        ->orderBy('voucherno_bvrno')
        ->get();

        $project=project::where('id','=',$category)->get();
        return view('reports.index',compact('payorders','payordeer','project'));
    }


    public function ledgerper()
    {   

    $bud=Tally::where('group','=',2.1)
        ->orderBy('name', 'desc')
        ->get();
        return view('reports.ledgerwise.budgetper',compact('bud'));
        
    }


    public function ledger(Request $request)
    {   


     
        $from = $request->from;
        $to = $request->to;
        $bank = $request->get('bank');

         $query = Ledger::select(
            'tallies.name as costcentre',
             'tallies.id as costcentreid',
            'ledgers.ledger as id',
            DB::raw('SUM(CASE WHEN ledgers.cr_dr = "Dr" THEN ledgers.amount ELSE 0 END) as dr_total'),
            DB::raw('SUM(CASE WHEN ledgers.cr_dr = "Cr" THEN ledgers.amount ELSE 0 END) as cr_total')
        )
        ->join('transactions', 'transactions.id', '=', 'ledgers.transaction_id')
        ->join('tallies', 'tallies.id', '=', 'ledgers.ledger')
        ->whereBetween('transactiondate', [$request->from, $request->to]) ;
      if ($bank !== 'all') {
        $query->where('transactions.bank', $bank);
    }

    $payorders = $query
        ->groupBy('ledgers.ledger')
        ->get();


        
    
        return view('reports.ledgerwise.budget',compact('payorders','from','to','bank'));
    }  


    public function ledgetrans($id,$from, $to,$bank)
    {   
     

    // $bank = $request->get('bank');
$payord = ledger::join('transactions', 'transactions.id', '=', 'ledgers.transaction_id')
        ->where('transactions.voucherno_bvrno','!=',0)
        ->where('ledgers.ledger','=',$id)
        ->pluck('transactions.id');

        $query = ledger::select(
          'transactions.sum as sum',
        'transactions.id as id',
         'transactions.narration',
         'pfms.name as pfms',
         'transactions.transactiondate',
         'employees.name as vendor',
         'tallies.name as bank',
         'transactions.voucherno_bvrno',
         'transactions.fy',
         'transactions.chequeno',
         'transactions.po',
         'projects.name as costcentre',
         DB::raw("COALESCE(project_heads.head, '') as sub"),DB::raw("SUM(CASE WHEN ledgers.sub = $id AND ledgers.cr_dr = 'Dr' THEN ledgers.amount ELSE 0 END) as ledger_total")
         ,DB::raw("SUM(CASE WHEN ledgers.sub = $id AND ledgers.cr_dr = 'Cr' THEN ledgers.amount ELSE 0 END) as ledger_tot")

        )
        ->join('transactions', 'transactions.id', '=', 'ledgers.transaction_id')
        ->join('employees', 'transactions.vendor', '=', 'employees.id')
        ->join('tallies','tallies.id', '=', 'ledgers.ledger')
        ->join('pfms','transactions.pfms', '=', 'pfms.id')
        ->join('projects', 'ledgers.costcentre', '=', 'projects.id')
        ->join('project_heads', 'ledgers.sub', '=', 'project_heads.id')
        ->whereBetween('transactiondate', array($from, $to))

        ->whereIn('transactions.id',$payord);

             if ($bank !== 'all') {
        $query->where('transactions.bank', $bank);
    }

    $payorders = $query
        ->groupBy('transactions.id')
        ->get();

$tally=Tally::where('id','=',$id)->first();

 
        return view('reports.ledgerwise.trans',compact('payorders','id','tally','from','to'));
    }  

//budget report

      public function budgetper()
    {   

    $bud=Tally::where('group','=',2.1)
        ->orderBy('name', 'desc')
        ->get();
        return view('reports.budgetwise.budgetper',compact('bud'));
        
    }


    public function budget1(Request $request)
    {   


     
        $from = $request->from;
        $to = $request->to;
        $bank = $request->get('bank');

         $query = Ledger::select(
            'projects.name as costcentre',
             'projects.id as costcentreid',
            'ledgers.costcentre as id',
            DB::raw('SUM(CASE WHEN ledgers.cr_dr = "Dr" THEN ledgers.amount ELSE 0 END) as dr_total'),
            DB::raw('SUM(CASE WHEN ledgers.cr_dr = "Cr" THEN ledgers.amount ELSE 0 END) as cr_total')
        )
        ->join('transactions', 'transactions.id', '=', 'ledgers.transaction_id')
        ->join('projects', 'projects.id', '=', 'ledgers.costcentre')
        ->whereBetween('transactiondate', [$request->from, $request->to]) ;
      if ($bank !== 'all') {
        $query->where('transactions.bank', $bank);
    }

    $payorders = $query
        ->groupBy('ledgers.costcentre')
        ->get();


        
    
        return view('reports.budgetwise.budget',compact('payorders','from','to','bank'));
    }  


    public function budget2($id,$from, $to,$bank)
    {   


     
        

         $query = Ledger::select(
            'project_heads.head as costcentre',
             'project_heads.id as costcentreid',
            'ledgers.costcentre as sid',
           
            DB::raw('SUM(CASE WHEN ledgers.cr_dr = "Dr" THEN ledgers.amount ELSE 0 END) as dr_total'),
            DB::raw('SUM(CASE WHEN ledgers.cr_dr = "Cr" THEN ledgers.amount ELSE 0 END) as cr_total')
        )
        ->join('transactions', 'transactions.id', '=', 'ledgers.transaction_id')
        ->join('project_heads', 'project_heads.id', '=', 'ledgers.sub')
        ->whereBetween('transactiondate', array($from, $to));
      if ($bank !== 'all') {
        $query->where('transactions.bank', $bank);
    }

    $payorders = $query
       
        ->where('ledgers.costcentre', $id)
         ->groupBy('ledgers.sub')
        ->get();

        $project=project::where('id','=',$id)->first();
        return view('reports.budgetwise.budget2',compact('payorders','from','to','bank','project'));
    }  


    public function budgettrans($id,$sid,$from, $to,$bank)
    {   
     

    // $bank = $request->get('bank');
$payord = ledger::join('transactions', 'transactions.id', '=', 'ledgers.transaction_id')
        ->where('transactions.voucherno_bvrno','!=',0)
        ->where('ledgers.costcentre','=',$sid)
        ->where('ledgers.sub','=',$id)
        ->pluck('transactions.id');

        $query = ledger::select(
          'transactions.sum as sum',
        'transactions.id as id',
         'transactions.narration',
         'pfms.name as pfms',
         'transactions.transactiondate',
         'employees.name as vendor',
         'tallies.name as bank',
         'transactions.voucherno_bvrno',
         'transactions.fy',
         'transactions.chequeno',
         'transactions.po',
         'projects.name as costcentre',
         DB::raw("COALESCE(project_heads.head, '') as sub"),DB::raw("SUM(CASE WHEN ledgers.sub = $id AND ledgers.cr_dr = 'Dr' THEN ledgers.amount ELSE 0 END) as ledger_total")
         ,DB::raw("SUM(CASE WHEN ledgers.sub = $id AND ledgers.cr_dr = 'Cr' THEN ledgers.amount ELSE 0 END) as ledger_tot")


        )
        ->join('transactions', 'transactions.id', '=', 'ledgers.transaction_id')
        ->join('employees', 'transactions.vendor', '=', 'employees.id')
        ->join('tallies','tallies.id', '=', 'ledgers.ledger')
        ->join('pfms','transactions.pfms', '=', 'pfms.id')
        ->join('projects', 'ledgers.costcentre', '=', 'projects.id')
        ->join('project_heads', 'ledgers.sub', '=', 'project_heads.id')
        ->whereBetween('transactiondate', array($from, $to))

        ->whereIn('transactions.id',$payord);

             if ($bank !== 'all') {
        $query->where('transactions.bank', $bank);
    }

    $payorders = $query
        ->groupBy('transactions.id')
        ->get();
$project=project::where('id','=',$sid)->first();
$sub=project_head::where('id','=',$id)->first();

 
        return view('reports.budgetwise.trans',compact('payorders','id','project','sub','from','to'));
    }  



    public function budget(Request $request)
    {   


        
        $category = $request->get('bank');
        $from = $request->from;
        $to = $request->to;


      

        $payorders = Ledger::select(
            'projects.name as costcentre','projects.status as status','projects.sanctioned as sanctioned',
            'ledgers.costcentre as id',
            DB::raw('SUM(CASE WHEN ledgers.cr_dr = "Dr" THEN ledgers.amount ELSE 0 END) as dr_total'),
            DB::raw('SUM(CASE WHEN ledgers.cr_dr = "Cr" THEN ledgers.amount ELSE 0 END) as cr_total')
        )
        ->join('transactions', 'transactions.id', '=', 'ledgers.transaction_id')
        ->join('projects', 'projects.id', '=', 'ledgers.costcentre')
        ->whereBetween('transactiondate', [$request->from, $request->to])
        ->where('transactions.bank',$category)
        ->groupBy('ledgers.costcentre')
        ->get();
    


 
        return view('reports.budget',compact('payorders','from','to'));
    }   
    public function fetchOutput(Request $request)
    {
        $value = $request->input('value');
        
        // Fetch data based on the selected value. For example, you can fetch from a database.
        // Here we just return a simple message.
        $output = 1;

        return response()->json($output);
    }



    
    public function budgetin(Request $request, $id, $from, $to )
    {   
   
 $category = $request->get('bank');
        $payorders = ledger::select('project_heads.head as costcentre','ledgers.sub as id','ledgers.costcentre as cos',
        DB::raw('SUM(CASE WHEN ledgers.cr_dr = "Dr" THEN ledgers.amount ELSE 0 END) as dr_total'),
        DB::raw('SUM(CASE WHEN ledgers.cr_dr = "Cr" THEN ledgers.amount ELSE 0 END) as cr_total')
        )
     
        ->join('transactions', 'transactions.id', '=', 'ledgers.transaction_id')
        ->join('project_heads', 'project_heads.id', '=', 'ledgers.sub')
        ->whereBetween('transactiondate', [$from, $to])
        ->where('ledgers.costcentre','=',$id)
        ->where('transactions.bank', $category)
        ->groupBy('ledgers.sub')
        ->get();

        $project=project::where('id','=',$id)->first();

 
        return view('reports.budgetin',compact('payorders','project','from','to'));
    }  
    public function trans($id,$from, $to)
    {   
     

        $payorders = ledger::select((DB::raw("COALESCE(bulks.net,transactions.sum) as sum")),
        'transactions.id as id',
         'transactions.narration',
         'pfms.name as pfms',
         'transactions.transactiondate',
         'employees.name as vendor',
         'tallies.name as bank',
         'transactions.voucherno_bvrno',
         'transactions.fy',
         'transactions.chequeno',
         'transactions.po',
         'projects.name as costcentre',
         DB::raw("COALESCE(project_heads.head, '') as sub")
        )
        ->join('transactions', 'transactions.id', '=', 'ledgers.transaction_id')
        ->leftJoin('bulks','transactions.id', '=','bulks.transaction_id')
        ->join('employees', (DB::raw("COALESCE(bulks.name,transactions.vendor)")), '=', 'employees.id')
        ->join('tallies','tallies.id', '=', 'ledgers.ledger')
        ->join('pfms','transactions.pfms', '=', 'pfms.id')
        ->join('projects', 'ledgers.costcentre', '=', 'projects.id')
        ->join('project_heads', 'ledgers.sub', '=', 'project_heads.id')
        ->whereBetween('transactiondate', array($from, $to))
        ->where('transactions.voucherno_bvrno','!=',0)
        ->where('ledgers.sub','=',$id)
        ->orderBy('voucherno_bvrno', 'desc')
        ->get();
 
        return view('reports.trans',compact('payorders'));
    }  


    


    public function trans1($id,$from, $to)
    {   
     

$payord = ledger::select('transactions.id as ff')
     
        ->join('transactions', 'transactions.id', '=', 'ledgers.transaction_id')
        ->leftjoin('project_heads', 'project_heads.id', '=', 'ledgers.sub')
        ->where('transactions.voucherno_bvrno','!=',0)
        ->where('ledgers.costcentre','=',$id)
        ->where('ledgers.sub','=',0)
        ->get();

        // foreach ($payord as $post) {
        //     $payo = $payord->costcentre ;
        // }


        $arr = [];
foreach($payord as $row)
{
    $arr[] = (array) $row->ff;
}

        $payorders = ledger::select((DB::raw("COALESCE(bulks.net,transactions.sum) as sum")),
        'transactions.id as id',
         'transactions.narration',
         'pfms.name as pfms',
         'transactions.transactiondate',
         'employees.name as vendor',
         'tallies.name as bank',
         'transactions.voucherno_bvrno',
         'transactions.fy',
         'transactions.chequeno',
         'transactions.po',
         'projects.name as costcentre',
         DB::raw("COALESCE(project_heads.head, '') as sub")
        )
        ->join('transactions', 'transactions.id', '=', 'ledgers.transaction_id')
        ->leftJoin('bulks','transactions.id', '=','bulks.transaction_id')
        ->join('employees', (DB::raw("COALESCE(bulks.name,transactions.vendor)")), '=', 'employees.id')
        ->join('tallies','tallies.id', '=', 'ledgers.ledger')
        ->join('pfms','transactions.pfms', '=', 'pfms.id')
        ->join('projects', 'ledgers.costcentre', '=', 'projects.id')
        ->join('project_heads', 'ledgers.sub', '=', 'project_heads.id')
        ->whereBetween('transactiondate', array($from, $to))

        ->whereIn('transactions.id',$arr)
        ->groupBy('transactions.id')
        ->get();
 
        return view('reports.trans',compact('payorders'));
    }  




    public function indexlink(Request $request)
    {   
        return view('payments.voucher.indexlink');
        
    }


    public function form16(Request $request)
    {   

        $id = Auth::user()->id;
        $payorders=DB::table('form16')->where('trackid','=',$id )
        ->get();
        return view('form16.index',compact('payorders'));
    }

    public function payslip(Request $request)
    {   

        $id = Auth::user()->eid;
 $payorders = DB::table('pay_sheets')
    ->where('eid', $id)
    ->orderByRaw("STR_TO_DATE(TRIM(month), '%M %Y') DESC")
    ->get();


        
        return view('form16.indexi',compact('payorders','id'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bud = DB::table('projects')->pluck("name","id")->all();

        return view('reports.create',compact('bud'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $ledger=ledger::where('transaction_id','=',$id)->get();
        return view('payments.voucher.print',compact('entries','ledger'));
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

    public function nested()
    {
        $employees = project::with('head')->get();

        return view('payments.voucher.nested',compact('employees'));
    }
}
