<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\transactions;
use App\Models\bank;
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




class ContraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
  

        $id = Auth::user()->id;
        $payorders=transactions::where('debit_credit','=','Contra')
        ->where('entered','=',$id )
        ->get();

        return view('payments.contra.index',compact('payorders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $payorders=bank::all();
        $pfms_schemes=pfms::all();
        $states=project::where('status','=','1')->get();
        $bank_accounts=employee::all();
        $bud=Tally::where('group','=','18')->get();
        $budss=Tally::where('group','=','18')->get();
        $buud=costcentre::all();
        $countries = DB::table('projects')->where('status','=','1')->pluck("name","id")->all();

        return view('payments.contra.create',compact('payorders','pfms_schemes','states','bank_accounts','bud','budss','buud','countries'));
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
            'narration' => 'required|min:100',
            
        ]);

        

        $price = DB::table('transactions')
        ->where('debit_credit','=','contra')
        ->where('fy','=','21-22')
                ->max('voucherno_bvrno');




        $project = transactions::create($request->all());
        $iid = $project->id;


        transactions::where('id', $iid)
        ->update([
            'voucherno_bvrno' => $price+1
         ]);
       
         foreach ($request->addmoreee as $key => $value) {
            $value['transaction_id'] = $iid;
            ledger::create($value);

        }


        foreach ($request->addmore as $key => $value) {
            $value['transaction_id'] = $iid;
            ledger::create($value);

        }

        return redirect()->route('contra.index')
                        ->with('success','Contra Entry successfully.');
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
        $payorders=bank::all();
        $pfms_schemes=pfms::all();
        $states=project::where('status','=','1')->get();
        $bank_accounts=employee::all();
        $bud=Tally::all();
        $budss=Tally::where('group','=','18')->get();
        $buud=costcentre::all();
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

        return view('payments.contra.edit',compact('user','ledger','payorders','pfms_schemes','states','bank_accounts','bud','budss','buud','ledgerr','countries','subbu'));
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
       
    
        return redirect()->route('contra.index')
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
