<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\medical;
use App\Models\employee;
use App\Models\medicalsub;
use Illuminate\Support\Facades\Auth;
use DB;
use PDF;

class MedicalController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */


    function __construct()
    {
         $this->middleware('permission:claim-list|claim-create|claim-edit|claim-delete', ['only' => ['index','show']]);
         $this->middleware('permission:claim-create', ['only' => ['create','store']]);
         $this->middleware('permission:claim-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:claim-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        $id = Auth::user()->id;
        $payorders=medical::where('submittedby','=',$id )
        ->get();
       
        

        return view('claim.medical.index',compact('payorders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        $statess=employee::where('status','=','1')->groupBy('Account_Number')->get();
        
        return view('claim.medical.create',compact('statess'));
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
            'file' => 'required|mimes:pdf|max:2048'
            ]);
        $project = medical::create($request->all());
        $iid = $project->id;
        $iidd = $project->project;   
        
        $fileName = $iid.'medical.'.$request->file->extension();  

        $request->file->move(public_path('uploads'), $fileName);
    
        $data = medical::find($iid);
        $data->path = $fileName;
        $data->save();


        foreach ($request->addmore1 as $key => $value) {
            $value['pid'] = $iid;
            medicalsub::create($value);

        }


        

        

        return redirect()->route('medical.index')
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
        $bud=medical::where('id','=',$id)->first();
        $budy=medicalsub::where('pid','=',$id)->get();
        


        $data=compact('bud','budy');


        $pdf = PDF::loadView('claim.medical.show',$data);
    
        return $pdf->stream('Timothy.pdf');
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
