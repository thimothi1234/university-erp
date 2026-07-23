<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tally;
use App\Models\ledger;
use App\Models\transactions;
use DB;



class BankbookController extends Controller
{

    function __construct()
    {
     
         $this->middleware('permission:product-delete', ['only' => ['create','store','indexpo','TDS','tsa','pmrf','exceltotally','createpo','createc','tallyc','index','gst','creategst']]);
         $this->middleware('permission:voucher-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:voucher-delete', ['only' => ['destroy']]);
         $this->middleware('permission:claim-create', ['only' => ['pos']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
public function index(Request $request)
{
    $category1 = $request->get('Payment');
   $category2 = $request->get('bank');

$allowedBanks = DB::table('bank_access')
    ->where('user_id', auth()->id())
    ->pluck('bank')
    ->toArray();

if (
    !in_array('all', $allowedBanks) &&
    !in_array($category2, $allowedBanks)
) {
    abort(403, 'You are not authorized to access this bank.');
}

    $bud = Tally::where('id', '=', $category2)->get();
    $from = $request->from;
    $to   = $request->to;

    if ($category2 == 'both') {

        if ($category1 == 'Payment') {

            $payorders = transactions::select(
                'transactions.sum as sum',
           'transactions.drtotal as gross',
                'transactions.id as id',
                'transactions.narration',
                'pfms.name as pfms',
                'transactions.transactiondate',
                'employees.name as vendor',
                'tallies.name as bank',
                'ledgers.costcentre as cc',
                'transactions.voucherno_bvrno',
                'transactions.fy',
                'transactions.entered',
                'transactions.chequeno',
                'transactions.po',
                'projects.name as costcentre',
                DB::raw("COALESCE(project_heads.head, '') as sub")
            )

        ->join('employees', 'transactions.vendor', '=', 'employees.id')
            ->join('ledgers', 'transactions.id', '=', 'ledgers.transaction_id')
            ->join('tallies', 'tallies.id', '=', 'ledgers.ledger')
            ->join('pfms', 'transactions.pfms', '=', 'pfms.id')
            ->join('projects', 'ledgers.costcentre', '=', 'projects.id')
            ->leftJoin('project_heads', 'ledgers.sub', '=', 'project_heads.id')
            ->whereIn('transactions.debit_credit', ['Payment', 'Advance', 'Advance Settlement'])
            ->where('ledgers.banks', '=', 0.5)
            ->whereIn('transactions.bank', [1127, 1130])
            ->whereBetween('transactiondate', [$from, $to])
            ->where('transactions.voucherno_bvrno', '!=', 0)
            ->orderBy('voucherno_bvrno', 'desc')
            ->get();

        } else {

            $payorders = DB::table('transactions')
                ->select(
                     'transactions.sum as sum',
           'transactions.drtotal as gross',
                    'transactions.id as id',
                    'transactions.narration',
                    'pfms.name as pfms',
                    'transactions.transactiondate',
                    'employees.name as vendor',
                    'tallies.name as bank',
                    'transactions.voucherno_bvrno',
                    'transactions.fy',
                    'transactions.entered',
                    'transactions.chequeno',
                    'transactions.po',
                    'projects.name as costcentre',
                    DB::raw("COALESCE(project_heads.head, '') as sub")
                )

                ->join('employees', 'transactions.vendor', '=', 'employees.id')
                ->join('ledgers', 'transactions.id', '=', 'ledgers.transaction_id')
                ->join('tallies', 'tallies.id', '=', 'ledgers.ledger')
                ->join('pfms', 'transactions.pfms', '=', 'pfms.id')
                ->join('projects', 'ledgers.costcentre', '=', 'projects.id')
                ->join('project_heads', 'ledgers.sub', '=', 'project_heads.id')
                ->where('transactions.debit_credit', '=', $category1)
                ->where('transactions.bank', '=', $category2)
                ->whereBetween('transactiondate', [$from, $to])
                ->where('ledgers.banks', '=', 0.5)
                ->where('transactions.voucherno_bvrno', '!=', 0)
                ->orderBy('voucherno_bvrno', 'desc')
                ->get();
        }

    } else {

        if ($category1 == 'Payment') {

            $payorders = transactions::select(
               'transactions.sum as sum',
           'transactions.drtotal as gross',
                'transactions.id as id',
                'transactions.narration',
                'pfms.name as pfms',
                'transactions.transactiondate',
                'employees.name as vendor',
                'tallies.name as bank',
                'ledgers.costcentre as cc',
                'transactions.voucherno_bvrno',
                'transactions.fy',
                'transactions.entered',
                'transactions.chequeno',
                'transactions.po',
                'projects.name as costcentre',
                DB::raw("COALESCE(project_heads.head, '') as sub")
            )
        
            ->join('employees', 'transactions.vendor', '=', 'employees.id')
            ->join('ledgers', 'transactions.id', '=', 'ledgers.transaction_id')
            ->join('tallies', 'tallies.id', '=', 'ledgers.ledger')
            ->join('pfms', 'transactions.pfms', '=', 'pfms.id')
            ->join('projects', 'ledgers.costcentre', '=', 'projects.id')
            ->leftJoin('project_heads', 'ledgers.sub', '=', 'project_heads.id')
            ->whereIn('transactions.debit_credit', ['Payment', 'Advance', 'Advance Settlement'])
            ->where('ledgers.banks', '=', 0.5)
            ->where('transactions.bank', '=', $category2)
            ->whereBetween('transactiondate', [$from, $to])
            ->where('transactions.voucherno_bvrno', '!=', 0)
            ->orderBy('voucherno_bvrno', 'desc')
            ->get();

        } else {

            $payorders = DB::table('transactions')
                ->select(
                     'transactions.sum as sum',
           'transactions.drtotal as gross',
                    'transactions.id as id',
                    'transactions.narration',
                    'pfms.name as pfms',
                    'transactions.transactiondate',
                    'employees.name as vendor',
                    'tallies.name as bank',
                    'transactions.voucherno_bvrno',
                    'transactions.fy',
                    'transactions.entered',
                    'transactions.chequeno',
                    'transactions.po',
                    'projects.name as costcentre',
                    'project_heads.head as sub'
                )
                ->join('employees', 'transactions.vendor', '=', 'employees.id')
                ->join('ledgers', 'transactions.id', '=', 'ledgers.transaction_id')
                ->join('tallies', 'tallies.id', '=', 'ledgers.ledger')
                ->join('pfms', 'transactions.pfms', '=', 'pfms.id')
                ->join('projects', 'ledgers.costcentre', '=', 'projects.id')
                ->join('project_heads', 'ledgers.sub', '=', 'project_heads.id')
                ->where('transactions.debit_credit', '=', $category1)
                ->where('transactions.bank', '=', $category2)
                ->whereBetween('transactiondate', [$from, $to])
                ->where('tallies.group', '=', '2.1')
                ->where('ledgers.banks', '=', 0.5)
                ->where('transactions.voucherno_bvrno', '!=', 0)
                ->orderBy('voucherno_bvrno', 'desc')
                ->get();
        }
    }

    return view('bankbook.index', compact('payorders', 'bud', 'from', 'to'));
}



    public function chequebookprint(Request $request)
    {
       
      
        $from = '2023-04-01' ;
        $to = '2024-03-31' ;

        // $payorders=transactions::where('debit_credit','=','$category1')
        // ->whereBetween('transactiondate', array($request->from, $request->to))
        // ->where('bank', '=', $category)
        // ->join('ledger','transactions.vendor', '=', 'employees.id')
        // ->get();

        $payorders = transactions::select(
            DB::raw("COALESCE(bulks.net, transactions.sum) as sum"),
            DB::raw("(SELECT SUM(t.sum) FROM transactions t WHERE t.chequeno = transactions.chequeno GROUP BY t.chequeno) as gross"),
        'transactions.id as id', 
        'transactions.narration',
        'transactions.transactiondate',
        'employees.name as vendor',
        'transactions.voucherno_bvrno',
        'transactions.fy',
        'transactions.chequeno'

        )
        ->leftJoin('bulks', 'transactions.id', '=','bulks.transaction_id')
        ->join('employees', (DB::raw("COALESCE(bulks.name,transactions.vendor)")), '=', 'employees.id')
        ->whereIn('transactions.debit_credit', ['Payment', 'Advance', 'Advance Settlement'])
        ->whereIn('transactions.bank', [1127]) 
        ->whereBetween('transactiondate', [$from, $to])
        ->where('transactions.voucherno_bvrno','!=',0)
        
        ->orderBy('voucherno_bvrno', 'desc')
        ->get();

    

        
        return view('bankbook.chequebookprint',compact('payorders'));

    }


    public function indexpo(Request $request)
    {
       
        $category1 = $request->get('bank');
 
        

        // $payorders=transactions::where('debit_credit','=','$category1')
        // ->whereBetween('transactiondate', array($request->from, $request->to))
        // ->where('bank', '=', $category)
        // ->join('ledger','transactions.vendor', '=', 'employees.id')
        // ->get();

        $payorders=DB::table('transactions')
        ->select((DB::raw("COALESCE(bulks.net,transactions.sum) as sum")),'transactions.id as id','transactions.status as status', 'transactions.narration','pfms.name as pfms','transactions.transactiondate','employees.name as vendor','tallies.name as bank','transactions.voucherno_bvrno','transactions.fy','transactions.chequeno','transactions.po')
        ->leftJoin('bulks','transactions.id', '=','bulks.transaction_id')
        ->join('employees', (DB::raw("COALESCE(bulks.name,transactions.vendor)")), '=', 'employees.id')
        ->join('ledgers','transactions.id', '=', 'ledgers.transaction_id')
        ->join('tallies','tallies.id', '=', 'ledgers.ledger')
        ->join('pfms','transactions.pfms', '=', 'pfms.id')
        ->whereIn('transactions.debit_credit', array('Payment', 'Advance', 'Advance Settlement'))
        ->where('transactions.po','=',$category1)
        ->groupBy('voucherno_bvrno')
        ->get();

    

        
        return view('bankbook.indexpo',compact('payorders'));

    }



    public function TDS(Request $request)
    {
       
        $category1 = $request->get('Payment');
        $category2 = $request->get('bank');
     

        $bud=Tally::where('id','=',$category2)->get();

                $from = $request->from;
                $to = $request->to;


        $payorders=transactions::select('transactions')
        ->select((DB::raw("COALESCE(bulks.tds,ledgers.amount) as taxx")),(DB::raw("COALESCE(bulks.gross,transactions.gross) as grosis")),
                    'transactions.id as id',
                    'transactions.pfms',
                    'transactions.entered',
                    'transactions.bank',
                    'namee_employee.name as ven',
                    'namee_employee.Income_Tax as venpan',   // Alias for the second join
                    'transactions.transactiondate',
                    'employees.name as vendor',
                    'employees.PFMS_code as gst',
                    'employees.Income_Tax as pan',
                    'ledgers.amount as ham',
                    'transactions.voucherno_bvrno',
                    'tallies.name as heead',
                    (DB::raw("bulks.id as bu")),(DB::raw("ledgers.id as ledi")))
        ->leftJoin('bulks','transactions.id', '=','bulks.transaction_id')
        ->leftJoin('employees as namee_employee', 'transactions.namee', '=', 'namee_employee.id')  // Second join
        ->join('employees', (DB::raw("COALESCE(bulks.name,transactions.vendor)")), '=', 'employees.id')
        ->join('ledgers','transactions.id', '=', 'ledgers.transaction_id')
        ->join('tallies','tallies.id', '=', 'ledgers.ledger')
        ->whereBetween('transactiondate', array($request->from, $request->to))
        ->whereIn('tallies.group',['3.6.4.1'])
        ->orderBy('voucherno_bvrno', 'ASC')
        ->get();
         return view('bankbook.tds',compact('payorders','bud','from','to'));
    }

    public function gst(Request $request)
    {
       
        $category1 = $request->get('Payment');
        $category2 = $request->get('bank');
     

        $bud=Tally::where('id','=',$category2)->get();

                $from = $request->from;
                $to = $request->to;


        $payorders=transactions::select('transactions')
        ->select((DB::raw("ledgers.amount as taxx")),
                    'transactions.id as id',
                    'transactions.pfms',
                     'transactions.invno',
                      'transactions.invdate',
                    'transactions.entered',
                    'transactions.bank',
                    'transactions.transactiondate',
                    'employees.name as vendor',
                    'employees.PFMS_code as gst',
                    'employees.Income_Tax as pan',
                    'ledgers.amount as ham',
                    'transactions.voucherno_bvrno',
                    'tallies.name as heead',
                    (DB::raw("(SELECT COALESCE(SUM(ledgers.amount))  FROM ledgers 
                    WHERE ledgers.transaction_id = transactions.id AND ledgers.banks = '0.5') as grosis")),
                    (DB::raw("bulks.id as bu")),(DB::raw("ledgers.id as ledi")))
        ->leftJoin('bulks','transactions.id', '=','bulks.transaction_id')
        ->join('employees', (DB::raw("COALESCE(bulks.name,transactions.vendor)")), '=', 'employees.id')
        ->join('ledgers','transactions.id', '=', 'ledgers.transaction_id')
        ->join('tallies','tallies.id', '=', 'ledgers.ledger')
        ->whereBetween('transactiondate', array($request->from, $request->to))
        ->whereIn('tallies.group',['3.6.4.2','3.6.4.3','3.6.4.4'])
        ->orderBy('voucherno_bvrno', 'ASC')
        ->get();
         return view('bankbook.gst',compact('payorders','bud','from','to'));

       
    
    return view('bankbook.gst', compact('payorders', 'bud', 'from', 'to'));

    

    }

    public function tsa(Request $request)
    {
       
        // $payorders=transactions::where('debit_credit','=','$category1')
        // ->whereBetween('transactiondate', array($request->from, $request->to))
        // ->where('bank', '=', $category)
        // ->join('ledger','transactions.vendor', '=', 'employees.id')
        // ->get();

        $bank = $request->get('bank');
        $payorders=DB::table('transactions')
        ->select((DB::raw("COALESCE(bulks.net,transactions.sum) as sum")),'transactions.id as id','pfms.name as pfms', 'transactions.narration','transactions.transactiondate','employees.name as vendor','employees.Account_Number as acno','employees.IFS_Code as ifsc','employees.Contract1 as tsacode','tallies.name as bank','ledgers.amount as ham','ledgers.ledger as ledger','transactions.voucherno_bvrno','transactions.fy','transactions.chequeno','transactions.po')
        ->leftJoin('bulks','transactions.id', '=','bulks.transaction_id')
        ->join('employees', (DB::raw("COALESCE(bulks.name,transactions.vendor)")), '=', 'employees.id')
        ->join('ledgers','transactions.id', '=', 'ledgers.transaction_id')
        ->join('tallies','tallies.id', '=', 'ledgers.ledger')
        ->join('pfms','pfms.id', '=', 'transactions.pfms')
        ->where('ledgers.ledger','=',$bank)
        ->where('transactions.status','=',4)
        ->where('transactions.id','>',42396)
        ->orderBy('voucherno_bvrno', 'ASC')
        ->get();

        
        return view('bankbook.tsa',compact('payorders'));

    }

    public function mail(Request $request)
    {
       
        $payorders=DB::table('transactions')
        ->select((DB::raw("COALESCE(bulks.net,transactions.sum) as sum")),
        'transactions.id as id',
         'transactions.narration',
        
         'transactions.transactiondate',
         'employees.name as vendor',
         'employees.Mail_ID as mail',
         'tallies.name as bank',
         'transactions.voucherno_bvrno',
         'transactions.fy',
         'transactions.chequeno',
         'transactions.po',
         'projects.name as costcentre',
         'project_heads.head as sub' 
         )
        ->leftJoin('bulks','transactions.id', '=','bulks.transaction_id')
        ->join('employees', (DB::raw("COALESCE(bulks.name,transactions.vendor)")), '=', 'employees.id')
        ->join('ledgers','transactions.id', '=', 'ledgers.transaction_id')
        ->join('tallies','tallies.id', '=', 'ledgers.ledger')
   
        ->join('projects', 'ledgers.costcentre', '=', 'projects.id')
        ->join('project_heads', 'ledgers.sub', '=', 'project_heads.id')
      
        ->where('ledgers.banks','=',0.5)
        ->where('transactions.voucherno_bvrno','!=',0)
        ->where('transactions.mail','!=',1)
        ->orderBy('voucherno_bvrno', 'desc')
        ->get();

  
        return view('bankbook.mail',compact('payorders'));

    }


    public function pmrf(Request $request)
    {
       
        // $payorders=transactions::where('debit_credit','=','$category1')
        // ->whereBetween('transactiondate', array($request->from, $request->to))
        // ->where('bank', '=', $category)
        // ->join('ledger','transactions.vendor', '=', 'employees.id')
        // ->get();
        $payorders=DB::table('transactions')
        ->select((DB::raw("COALESCE(bulks.net,transactions.sum) as sum")),'transactions.id as id', 'transactions.narration','transactions.transactiondate','employees.name as vendor','employees.Account_Number as acno','employees.IFS_Code as ifsc','employees.Contract1 as tsacode','tallies.name as bank','ledgers.amount as ham','ledgers.ledger as ledger','transactions.voucherno_bvrno','transactions.fy','transactions.chequeno','transactions.po')
        ->leftJoin('bulks','transactions.id', '=','bulks.transaction_id')
        ->join('employees', (DB::raw("COALESCE(bulks.name,transactions.vendor)")), '=', 'employees.id')
        ->join('ledgers','transactions.id', '=', 'ledgers.transaction_id')
        ->join('tallies','tallies.id', '=', 'ledgers.ledger')
        ->whereIn('ledgers.ledger', [6546])
        ->where('transactions.status','=',4)
        ->orderBy('voucherno_bvrno', 'ASC')
        ->get();

        
        return view('bankbook.pmrf',compact('payorders'));

    }





    public function exceltotally(Request $request)
    {
        $category2 = $request->get('bank');
        // $payorders=transactions::where('debit_credit','=','$category1')
        // ->whereBetween('transactiondate', array($request->from, $request->to))
        // ->where('bank', '=', $category)
        // ->join('ledger','transactions.vendor', '=', 'employees.id')
        $from = $request->from;
        $to = $request->to;
        // ->get();
        $payorders=DB::table('transactions')
        ->select('transactions.id as id', 'transactions.narration','transactions.transactiondate',
        'employees.name as vendor','employees.Account_Number as acno','employees.IFS_Code as ifsc',
        'employees.Contract1 as tsacode','tallies.name as bankd','ledgers.amount as ham','ledgers.ledger as ledger',
        'ledgers.cr_dr as cr_dr','transactions.voucherno_bvrno','transactions.fy','transactions.chequeno','transactions.sum',
        'transactions.po','transactions.debit_credit','transactions.bank')
        ->leftJoin('pfms','transactions.pfms', '=','pfms.id')
        ->join('employees', 'transactions.vendor', '=', 'employees.id')
        ->join('ledgers','transactions.id', '=', 'ledgers.transaction_id')
        ->join('tallies','tallies.id', '=', 'ledgers.ledger')
        ->whereBetween('transactiondate', array($request->from, $request->to))
        ->where('transactions.status','=','paid')
        ->where('transactions.bank','=',$category2)
        ->orderBy('voucherno_bvrno', 'ASC')
        ->get();

        
        return view('bankbook.exceltotally',compact('payorders'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bud=Tally::where('group','=',2.1)
        ->orderBy('name', 'desc')
        ->get();

        return view('bankbook.create',compact('bud'));
    }

     public function searchtsa()
    {
        $bud=Tally::where('group','=',2.1)
        ->orderBy('name', 'desc')
        ->get();

        return view('bankbook.searchtsa',compact('bud'));
    }



    public function createpo()
    {
        $bud=transactions::where('po','!=','NULL')->where('po','!=','')
        ->orderBy('po', 'ASC')
        ->get();

        return view('bankbook.createpo',compact('bud'));
    }



    public function createc()
    {
        $bud=Tally::where('group','=','3.6.4')->get();

        return view('bankbook.createc',compact('bud'));
    }

    public function creategst()
    {
        $bud=Tally::where('group','=','3.6.4')->get();

        return view('bankbook.creategst',compact('bud'));
        
    }

    public function tallyc()
    {
        $bud=Tally::where('group','=',2.1)
        ->orderBy('name', 'desc')
        ->get();

        return view('bankbook.createtally',compact('bud'));
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


//     public function showPdfFiles()
// {
//     $directory = storage_path('http://10.6.160.10/FnA_Digital_Vouchers/'); // Adjust the path as needed
//     $pdfFiles = [];

//     if (File::exists($directory)) {
//         $files = File::allFiles($directory);

//         foreach ($files as $file) {
//             if ($file->getExtension() === 'pdf') {
//                 $pdfFiles[] = $file->getFilename();
//             }
//         }
//     }

//     return view('pdffiles', compact('pdfFiles')); // Replace 'your-view' with your actual view name
// }


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
}
