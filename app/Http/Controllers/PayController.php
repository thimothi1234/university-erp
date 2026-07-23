<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\transactions;
use App\Models\Tally;
use App\Models\ta;
use App\Models\cea;
use Illuminate\Support\Facades\Auth;
use DataTables;
use DB;
use Session;
use PDF;


class PayController extends Controller
{

    function __construct()
    {
         $this->middleware('permission:voucher-list|voucher-create|voucher-edit|voucher-delete', ['only' => ['index','show']]);
         $this->middleware('permission:voucher-create', ['only' => ['create','editPost1','editPost2','editPost9','selectcheque']]);
         $this->middleware('permission:voucher-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:voucher-delete', ['only' => ['destroy']]);
         $this->middleware('permission:claim-create', ['only' => ['pos']]);
         $this->middleware('permission:voucher-delete', ['only' => ['bulkindex']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index(Request $request)
    // {
        


    //     $post=transactions::where('chequeno','=','0')
    //     ->where('debit_credit','=','Payment')
    //     ->where('debit_credit','=','Payment')
    //     ->get();
    //     return view('pay.cheque..index',compact('post'));


        
    // }
    public function index(Request $request)
    {   

        $bank = $request->get('bank');
        $type = $request->get('type');
        session(['bankk' => $bank]);

        if ($type == 'SBI') {
            $id1 = Auth::user()->id;
            $post = DB::table('transactions')
            ->select('transactions.id','transactions.chequeno','transactions.transactiondate','transactions.sum')
            ->join('ledgers', 'transactions.id', '=', 'ledgers.transaction_id')
            ->join('employees', 'transactions.vendor', '=', 'employees.id')
            ->join('tallies', 'ledgers.ledger', '=', 'tallies.id')
            ->where('ledgers.banks', '=', 1)
            ->where('ledgers.ledger', '=', $bank)
            ->where('transactions.chequeno', '=', 0)
            ->where('transactions.status', '=', 4)
            ->where('employees.Bank_Name', '=', 'SBI')
            ->get();
            

            return view('pay.cheque.index',compact('post'));
    
        } else {
            $id1 = Auth::user()->id;
                $post = DB::table('transactions')
                ->select('transactions.id','transactions.chequeno','transactions.transactiondate','transactions.sum')
                ->join('ledgers', 'transactions.id', '=', 'ledgers.transaction_id')
                ->join('employees', 'transactions.vendor', '=', 'employees.id')
                ->join('tallies', 'ledgers.ledger', '=', 'tallies.id')
                ->where('ledgers.ledger', '=', $bank)
                ->where('ledgers.banks', '=', 1)
                ->where('transactions.chequeno', '=', 0)
                ->where('transactions.status', '=', 4)
               
               
                ->get();
                return view('pay.cheque.index',compact('post'));
        }

    }


    public function bulkindex()
    {   

        $id1 = Auth::user()->id;
if ($id1 == 466 ) {
    
            $post = DB::table('transactions')
            ->select('transactions.id','transactions.chequeno','transactions.transactiondate','transactions.sum')
            ->where('transactions.voucherno_bvrno', '=', 0)
            ->where('transactions.status', '=', 4)
            ->orderBy('id', 'DESC')
            ->get();
            

            return view('pay.cheque.bulkpay',compact('post'));
        }
        else {

            abort(403);
        }
      

    }


    public function bulkpay(Request $request)
    {
        
        

        $cheque = $request->chequeno;
        $date = $request->transactiondate;
        

        // Get selected IDs
        $ids = $request->input('ckeck_user');


        if (is_null($ids)) {
           
            return redirect()->route('bulk.indexx')->with('error', 'No vouchers selected for payment.');
        }
        else{

       
        

        $users2 = transactions::whereIn('id', $ids)
        ->get();

        $date2 = $request->transactiondate;
       
        $year = date('y', strtotime($date2));
        $month = date('m', strtotime($date2));
         $financial_year_to = ($month > 3) ? $year +1 : $year;
        $financial_year_from = $financial_year_to - 1;
        
        
        $fy= $financial_year_from .'-'.$financial_year_to; 

        if ($users2->count() > 0) {
            foreach($users2 as $key => $value){
                if (!empty($value->id)) {
                    $details = [
                        'id' => $value->id,
                        'bank' => $value->bank,
                      
                    ];


            $voucherno = transactions::where('fy', $fy)
            ->where('bank', $value->bank)
            ->max('voucherno_bvrno');

            $post = transactions::find ($value->id);
            $post->chequeno = $cheque;
            $post->transactiondate = $date;
            $post->voucherno_bvrno = $voucherno+1;
            $post->fy = $fy;
            $post->status = 'paid';
            $post->save();
                }
            }   
        }
        

        return redirect()->route('bulk.indexx')
                        ->with('success','Payment details updated.');
                    }
    }
    
        


        // $payorders=transactions::where('debit_credit','=','Payment')
        // ->whereBetween('transactiondate', array($request->from, $request->to))
        // ->where('project', '=', $category)
        // ->get();
        // $payordeer=transactions::where('debit_credit','=','Receipt')
        // ->whereBetween('transactiondate', array($request->from, $request->to))
        // ->where('project', '=', $category)
        // ->get();

        // $project=project::where('id','=',$category)->get();
        // return view('reports.index',compact('payorders','payordeer','project'));
    


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $bank = Tally::where('group','=','2.1')
        ->get();
        return view('pay.cheque.create', compact('bank'));
    }
    

    public function editPost9(request $request){

        $id = $request->id;
        // $max=DB::table('transactions')
        // ->max('transactions.voucherno_bvrno')
        // ->join('ledgers','transactions.id', '=', 'ledgers.transaction_id')
        // ->where('ledgers.ledger','=',$bank)
        // ->get();
        $date2 = date("y-m-d"); 
       
        $year = date('y', strtotime($date2));
        $month = date('m', strtotime($date2));
         $financial_year_to = ($month > 3) ? $year +1 : $year;
        $financial_year_from = $financial_year_to - 1;
        
        
        $fy= $financial_year_from .'-'.$financial_year_to; 


        $maximum = Session::get('bankk');
            $maxi = transactions::join('ledgers', 'transactions.id',"=", 'ledgers.transaction_id')
            ->select(DB::raw('max(transactions.voucherno_bvrno) as max'))
            ->where('ledgers.ledger', '=', $maximum)
            ->where('ledgers.banks', '=', 1)
            ->where('transactions.fy', '=', $fy)
            ->first();
        
  
        $post = transactions::find ($request->id);
        $post->chequeno = $request->title;
        $post->transactiondate = $request->body;
        $post->voucherno_bvrno = $maxi->max+1;
        $post->fy = $fy;
        $post->status = 'paid';
        $post->save();
        return response()->json($post);
      }

      public function editPost1(request $request){

        $id = $request->id;
        


        $post = ta::find ($request->id);
        $post->status = $request->title;
        $post->name = $request->body;
  
        $post->save();
        return response()->json($post);
      }

      public function editPost2(request $request){

        $id = $request->id;
        


        $post = cea::find ($request->id);
        $post->status = $request->title;
        $post->name = $request->body;
  
        $post->save();
        return response()->json($post);
      }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {       
        
     
        if(Request::ajax()){
            $chequeno       = Input::get( 'chequeno' );
            $id  = Input::get( 'id' );
           
            $customer->chequeno = $chequeno;
            $customer->id = $id;

            $customer->save();
            $response = array(
                'status' => 'success',
                'msg' => 'Cheque Issued',
            );
            return Response::json($response); 
        }
        else {
            echo 'no';
            exit;
        }

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
        ->orderBy('banks', 'ASC')
        ->get();

    
        
        $data=compact('entries','ledger');


        $pdf = PDF::loadView('pay.cheque.show',$data);
    
        return $pdf->stream('cheque.pdf');

        
    }


    public function view(Request $request)
    {


        $cheque = $request->get('cheque');
        $ledger=transactions::where('chequeno','=',$cheque)
        ->first();


        $post = DB::table('transactions')
                ->select ((DB::raw("COALESCE(bulks.net,transactions.sum) as sum")),'employees.Account_Number','employees.IFS_Code','employees.name as ven','tallies.name as tally')
                ->leftJoin('bulks','transactions.id', '=','bulks.transaction_id')
                ->join('employees', (DB::raw("COALESCE(bulks.name,transactions.vendor)")), '=', 'employees.id')
                ->join('ledgers', 'transactions.id', '=', 'ledgers.transaction_id')
                ->join('tallies', 'ledgers.ledger', '=', 'tallies.id')
                ->where('ledgers.banks', '=', 1)
                ->where('transactions.chequeno', '=', $cheque)
                ->get();
                
                $tallu = DB::table('transactions')
                ->select('tallies.name as tally','tallies.Bank_Name')
                ->join('ledgers', 'transactions.id', '=', 'ledgers.transaction_id')
                ->join('employees', 'transactions.vendor', '=', 'employees.id')
                ->join('tallies', 'ledgers.ledger', '=', 'tallies.id')
                ->where('ledgers.banks', '=', 1)
                ->where('transactions.chequeno', '=', $cheque)
                ->first();

    
        
        // $data=compact('ledger','post','tallu');


        // $pdf = PDF::loadView('pay.cheque.show',$data);
    
        // return $pdf->stream('cheque.pdf');
        return view('pay.cheque.show', compact('ledger','post','tallu'));

        
    }




    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
    {
        

        $inputs = transactions::where('chequeno','!=','0')
        ->get();

        
        return view('pay.cheque.createc',compact('inputs'));
    }
    public function selectcheque(Request $request)
    {
        

        $inputs = transactions::where('chequeno','!=','0')
        ->groupBy('chequeno')
        ->get();

        
        return view('pay.cheque.createc',compact('inputs'));
    }
  
    

      
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
       





        
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
