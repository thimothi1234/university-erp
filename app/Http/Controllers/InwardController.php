<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\project;
use App\Models\ta;
use App\Models\tady;
use App\Models\employee;
use App\Models\pi;
use App\Models\cea;
use App\Models\transactions;
use App\Models\bank;
use App\Models\pfms;
use App\Models\Tally;
use App\Models\costcentre;
use App\Models\ledger;
use App\Models\approval;
use App\Models\userrole;
use Illuminate\Support\Facades\Auth;
use DB;


class InwardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        

        $post=ta::where('status','=','inward' )
        ->get();


        
      
        return view('claim.inward',compact('post'));



        
    }

    public function ceaindex()
    {
        

        $post=cea::where('status','=','inward' )
        ->get();
        

        $users=DB::table('users')
        ->select('employees.name as name', 'users.id as id')
        ->join('userroles','users.id', '=', 'userroles.userid')
        ->join('employees','users.name', '=', 'employees.id')
        ->where('userroles.roleid','=',16)
        ->get();
        return view('claim.ceainward',compact('post','users'));

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
        $states=project::all();
        $bank_accounts=employee::all();
        $bud=Tally::all();
        $budss=Tally::where('group','=','6')->get();
        $buud=costcentre::all();

        return view('payments.voucher.create',compact('payorders','pfms_schemes','states','bank_accounts','bud','budss','buud'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $project = ta::create($request->all());
        $iid = $project->id;
        $iidd = $project->project;

        $ledger=pi::where('role','=','PI')
        ->where('PROJECT','=',$iidd )
        ->first()->name;


        $data = ta::find($iid);
    $data->status = $ledger;
    $data->save();

       


        foreach ($request->addmore1 as $key => $value) {
            $value['taid'] = $iid;
            tady::create($value);

        }

        

        return redirect()->route('claim.index')
                        ->with('success','Submitted successfully.');
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
        $states=project::all();
        $bank_accounts=employee::all();
        $bud=Tally::all();
        $budss=Tally::where('group','=','6')->get();
        $buud=costcentre::all();
        $ta=ta::where('id','=',$id)->get();

        return view('claim.voucher.create',compact('payorders','pfms_schemes','states','bank_accounts','bud','budss','buud','ta'));
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
   
}
