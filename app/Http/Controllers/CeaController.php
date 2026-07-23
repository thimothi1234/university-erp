<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\cea;
use App\Models\transactions;
use App\Models\ceasub;
use App\Models\employee;
use App\Models\medicalsub;
use Illuminate\Support\Facades\Auth;
use DB;
use PDF;


class CeaController extends Controller
{

    function __construct()
    {
         $this->middleware('permission:claim-list|claim-create|claim-edit|claim-delete', ['only' => ['index','show']]);
         $this->middleware('permission:claim-create', ['only' => ['create','store']]);
         $this->middleware('permission:claim-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:claim-delete', ['only' => ['destroy']]);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::user()->id;
        $payorders=cea::where('submittedby','=',$id )
        ->get();
        

        
        

        return view('claim.cea.index',compact('payorders'));
    }

    public function index1()
    {
        
        $payorders=DB::table('ceasubs')->select('ceas.id as id','ceas.created_at as created_at','ceas.path as path','ceas.cea as cea', 'ceas.hostel as hostel', 'ceas.name as name', 'ceas.designation as designation', 'ceas.eid as eid', 'ceas.doj as doj',
         'ceas.ifhostelyesamount as ifhostelyesamount',  'ceasubs.name as cname','ceasubs.ayfrom as ayfrom','ceasubs.dob as dob',
         'ceasubs.ayto as ayto','ceasubs.class as class','ceasubs.school as school','ceasubs.board as board','ceasubs.ayfrom as ayfrom','ceasubs.ayto as ayto')
        ->join('ceas','ceasubs.rid', '=', 'ceas.id')-> get();
        

        
        

        return view('claim.cea.index1',compact('payorders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $statess=employee::where('status','=','1')->groupBy('Account_Number')->get();
        
        return view('claim.CEA.create',compact('statess'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:pdf|max:1048'
            ]);
        $project = cea::create($request->all());
        $iid = $project->id;
        $iidd = $project->project;       

        $fileName = $iid.'cea.'.$request->file->extension();  

    $request->file->move(public_path('uploads'), $fileName);

    $data = cea::find($iid);
    $data->path = $fileName;
    $data->save();


        foreach ($request->addmore1 as $key => $value) {
            $value['rid'] = $iid;
            ceasub::create($value);

        }


        

        

        return redirect()->route('cea.index')
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
        $bud=cea::where('id','=',$id)->first();
        $budy=ceasub::where('rid','=',$id)->get();

        $data=compact('bud','budy');


        $pdf = PDF::loadView('claim.cea.show',$data);
    
        return $pdf->stream('CEA.pdf');
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
