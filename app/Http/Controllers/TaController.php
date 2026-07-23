<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\project;
use App\Models\ta;
use App\Models\tady;
use App\Models\employee;
use App\Models\pi;
use App\Models\ipject;
use App\Models\transactions;
use Illuminate\Support\Facades\Auth;
use DB;
use PDF;


class TaController extends Controller
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
        $id = Auth::user()->name;

        $payorders=transactions::where('debit_credit','=','Advance')
        ->where('vendor','=',$id )
 
        ->get();
       
        

        return view('claim.index',compact('payorders'));
    }

    public function pendingta()
    {


        $id = Auth::user()->name;

        $payorders=transactions::where('debit_credit','=','Advance')
        ->where('vendor','=',$id )
 
        ->get();



   
       
        

        return view('advances.ta',compact('payorders'));
    }

    public function tasettle($id)
    {
      
       
        $bud=ta::where('id','=',$id)->first();
        $budy=tady::where('taid','=',$id)->get();
        $states=project::all();
        $statess=employee::where('status','=','1')->groupBy('Account_Number')->get();
        $countries = DB::table('projects')->pluck("name","id")->all();
        $countrie = DB::table('projects')->pluck("name","id")->all();
    

        return view('advances.tasettle',compact('statess','states','countries','countrie','bud','budy'));
    }



    
   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $states=project::all();
        $statess=employee::where('status','=','1')->groupBy('Account_Number')->get();
        $countries = DB::table('projects')->pluck("name","id")->all();
        $countrie = DB::table('projects')->pluck("name","id")->all();
        return view('claim.create',compact('statess','states','countries','countrie'));

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
        $project = ta::create($request->all());
        $iid = $project->id;
        $iidd = $project->project;       

        $fileName = $iid.'taadv.'.$request->file->extension();  

    $request->file->move(public_path('uploads'), $fileName);

    $data = ta::find($iid);
    $data->path = $fileName;
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
        
        $bud=ta::where('id','=',$id)->first();
        $budy=tady::where('taid','=',$id)->get();

        $data=compact('bud','budy');


        $pdf = PDF::loadView('claim.show',$data);
    
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
        $bud=ta::where('id','=',$id)->first();
        $budy=tady::where('taid','=',$id)->get();
        $states=project::all();
        $statess=employee::where('status','=','1')->groupBy('Account_Number')->get();
        $countries = DB::table('projects')->pluck("name","id")->all();
        $countrie = DB::table('projects')->pluck("name","id")->all();
        return view('claim.edit',compact('statess','states','countries','countrie','bud','budy'));
        
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
       
    
        $user = ta::find($id);
        $user->update($input);

        $scores = $request->input('addmore1');  //here scores is the input array param 

        foreach($scores as $row){
            $score = tady::find($row['id']); 
            $score->type = $row['type']; 
            $score->onward = $row['onward']; 
            $score->return = $row['return']; 
           
            $score->save(); 
        }

        if($request->addmore11 === NULL){
       
        }
        else{
    
            $request->validate([
                'addmore11.*.type' => 'required'
               
            ]);
    
            foreach ($request->addmore11 as $key => $value) {
                $value['taid'] = $id;
                tady::create($value);
    
            }
        }


        return redirect()->route('claim.index')
                        ->with('success','Edited successfully.');
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
