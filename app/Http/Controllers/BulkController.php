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
use App\Models\cea;
use DB;
use Illuminate\Support\Facades\Auth;

class BulkController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

     function __construct()
     {
          $this->middleware('permission:voucher-list|voucher-create|voucher-edit|voucher-delete', ['only' => ['index','show']]);
          $this->middleware('permission:voucher-create', ['only' => ['create','store']]);
          $this->middleware('permission:voucher-edit', ['only' => ['edit','update']]);
          $this->middleware('permission:voucher-delete', ['only' => ['destroy']]);
        
     }



    public function index()
    {
        $id = Auth::user()->id;
        $payorders=transactions::where('debit_credit','=','Payment')
        ->where('entered','=',$id )
        ->where('vendor','=',518 )
        ->get();

        return view('payments.bulk.index',compact('payorders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create1()
    {
        
        $pfms_schemes=pfms::orderBy('id', 'DESC')
        ->get();
        $states=project::where('status','=','1')->get();
        $bank_accounts=DB::table('employees')->where('status','=','1')
        ->groupBy('Account_Number')->get();
        $bank_vends=DB::table('employees')->where('status','=','1')
        ->groupBy('Account_Number')->get();
        $bank_accountss=DB::table('employees')->where('status','=','1')
        ->groupBy('Account_Number')->get();
        $bank_vend=DB::table('employees')->where('status','=','1')
        ->groupBy('Account_Number')->get();
        $bud=Tally::all();
        $budss=Tally::where('group','=','2.1')->get();
        

        $countries = DB::table('projects')->where('status','=','1')->pluck("name","id")->all();

        

        return view('payments.bulk.create',compact('pfms_schemes','states','bank_accounts','bud','budss','bank_accountss','countries','bank_vend','bank_vends'));
    }

    public function inward(Request $request)
    {

        $iid = $request->input('iid');
        $coun = count($iid);
     
        $pfms_schemes=pfms::orderBy('id', 'DESC')
        ->get();
        $name_states=project::where('status','=','1')->get();
        $bank_accounts=DB::table('employees')->where('status','=','1')
        ->groupBy('Account_Number')->get();
        $bank_accountss=DB::table('employees')->where('status','=','1')
        ->groupBy('Account_Number')->get();
        $bud=Tally::all();
        $budss=Tally::where('group','=','2.1')->get();
        $inward=cea::all();
        $countries = DB::table('projects')->where('status','=','1')->pluck("name","id")->all();
        $countrie = DB::table('projects')->where('status','=','1')->pluck("name","id")->all();

        

        return view('payments.bulk.createinward',compact('inward','pfms_schemes','name_states','bank_accounts','bud','budss','bank_accountss','coun','countries','countrie','iid'));
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

        

        foreach ($request->addmore1 as $key => $value) {
            $value['transaction_id'] = $iid;
            bulk::create($value);

        }

        $gross=ledger::where('cr_dr','=','Dr')->where('transaction_id','=',$iid)->sum('amount');
        $row = transactions::where("id",$iid )->update(["drtotal" => $gross]);
// if($request->input('jil') == 01)
// {

//         $idsss = $request->inwardids[0];
  
//     DB::table('transactions')->where('id', $idsss)
//     ->update(['inwardsno' => $idsss ]);   

//     }

// }
        

        return redirect()->route('bulk.index')
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

         $conni = DB::table('transactions')->where('id','=',$id)->pluck("status")->first();
        $ind = Auth::user()->id;
      
    if ($ind == 46 || in_array($conni, [1, 2, 3])) {
        
        $pfms_schemes=pfms::orderBy('id', 'DESC')
        ->get();
        $states=project::where('status','=','1')->get();
        $bank_accounts=DB::table('employees')->where('status','=','1')
        ->groupBy('Account_Number')->get();
        $bank_accountss=DB::table('employees')->where('status','=','1')
        ->groupBy('Account_Number')->get();
        $bud=Tally::where('status',1)->where('group', 'not like', '%3.6.4%')->get();
        $budss=Tally::where('group','=','2.1')->get();
    
        $user = transactions::find($id);
      
        
        $ledger = ledger::where('transaction_id','=',$id)
        ->where('banks','!=',1)
        ->get();

        $bulk = bulk::where('transaction_id','=',$id)
        ->get();


        $ledgerr = ledger::where('transaction_id','=',$id)
        ->where('banks','=',1)
        ->first();

        $sub = DB::table('ledgers')->where('id', $id)->pluck('costcentre');
        //$subbu=project_head::where('project_id','=',$sub)->get();

        $countries = DB::table('projects')->where('status','=','1')->pluck("name","id")->all();
        $countrie = DB::table('projects')->where('status','=','1')->pluck("name","id")->all();

        return view('payments.bulk.edit',compact('user','ledger','pfms_schemes','states','bank_accounts','bank_accountss','bud','budss','sub','ledgerr','bulk','countries','countrie'));
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
        if($request->addmoreo === NULL){
    }
    else{

        $request->validate([
            'addmoreo.*.ledger' => 'required',
            'addmoreo.*.costcentre' => 'required',
            'addmoreo.*.cr_dr' => 'required',
            'addmoreo.*.amount' => 'required'
        ]);

        foreach ($request->addmoreo as $key => $value) {
            $value['transaction_id'] = $id;
            ledger::create($value);

        }
    }

        $scoresst = $request->input('addmore11');  //here scores is the input array param 

        foreach($scoresst as $row){
            $score11 = bulk::find($row['id']); 
            $score11->name = $row['name']; 
            $score11->gross = $row['gross']; 
    
            $score11->tds = $row['tds']; 
            $score11->ptax = $row['ptax']; 
            $score11->net = $row['net']; 
            $score11->save(); 
        }

        if($request->addmore1 === NULL){
        }
        else{
            
    
            foreach ($request->addmore1 as $key => $value) {
                $value['transaction_id'] = $id;
                bulk::create($value);
    
            }
    }    

    $gross=ledger::where('cr_dr','=','Dr')->where('transaction_id','=',$id)->sum('amount');
        $row = transactions::where("id",$id )->update(["drtotal" => $gross]);
    


        return redirect()->route('bulk.index')
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


     public function create()
    {
   
        $pfms_schemes=pfms::orderBy('id', 'DESC')
        ->get();
        $name_states=project::where('status','=','1')->get();
        $bank_accounts=DB::table('employees')->where('status','=','1')
        ->groupBy('Account_Number')->get();
        $bank_vends=DB::table('employees')->where('status','=','1')
        ->groupBy('Account_Number')->get();
        $bank_accountss=DB::table('employees')->where('status','=','1')
        ->groupBy('Account_Number')->get();
        $bank_vend=DB::table('employees')->where('status','=','1')
        ->groupBy('Account_Number')->get();
        $bud=Tally::where('status',1)->where('group', 'not like', '%3.6.4%')->get();
        $budss=Tally::where('group','=','2.1')->get();
        $buas=Tally::where('group','=','3.6.4.1')->get();
       

        $countries = DB::table('projects')->where('status','=','1')->pluck("name","id")->all();
        $countrie = DB::table('projects')->where('status','=','1')->pluck("name","id")->all();

        

        return view('payments.bulk.create',compact('pfms_schemes','name_states','bank_accounts','bud','budss','bank_accountss','countries','countrie','buas','bank_vend','bank_vends'));
    
    }

   
    public function selectAjax(Request $request) { 
        
        if($request->ajax()){ $states = DB::table('project_heads')->where('project_id',$request->id_country)->pluck("head","id")->all(); 
        $data = view('ajax-select',compact('states'))->render(); 
        return response()->json(['options'=>$data]); } } 

        public function findCityWithStateID($id)
        {
            $city = project_head::where('project_id',$id)->get();
            return response()->json($city);
        }


    //     public function fetchOptions(Request $request)
    // {
    //     $query = $request->input('query');

    //     // Perform a query to fetch options based on the user's input
    //     $options = Tally::where('name', 'like', '%' . $query . '%')->get(); // Example query, replace it with your actual query
        
    //     // Return options as JSON response
    //     return response()->json($options);
    // }

        
    
    }


    

