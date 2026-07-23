<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\employee;
use App\Models\reimb;
use App\Models\tady;
use App\Models\reimbsub;
use App\Models\pi;
use App\Models\ipject;
use Illuminate\Support\Facades\Auth;
use DB;
use PDF;


class ReimbController extends Controller
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
        $payorders=reimb::where('submittedby','=',$id )
        ->get();
       
        

        return view('claim.reimb.index',compact('payorders'));
    }



    
   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
     
        $statess=employee::where('status','=','1')->groupBy('Account_Number')->get();
        $countries = DB::table('projects')->pluck("name","id")->all();
        $countrie = DB::table('projects')->pluck("name","id")->all();
      
        return view('claim.reimb.create',compact('statess','countries','countrie'));

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
        $project = reimb::create($request->all());
        $iid = $project->id;
        $iidd = $project->project;   
        
        $fileName = $iid.'reimb.'.$request->file->extension();  

        $request->file->move(public_path('uploads'), $fileName);
    
        $data = reimb::find($iid);
        $data->path = $fileName;
        $data->save();


        foreach ($request->addmore1 as $key => $value) {
            $value['rimbid'] = $iid;
            reimbsub::create($value);

        }


        

        

        return redirect()->route('reimb.index')
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

        $bud=reimb::where('id','=',$id)->first();
        $budy=reimbsub::where('rimbid','=',$id)->get();
        


        $data=compact('bud','budy');


        $pdf = PDF::loadView('claim.reimb.show',$data);
    
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
