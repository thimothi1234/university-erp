<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\travel;
use App\Models\travelsub;
use App\Models\project;
use App\Models\employee;
use Illuminate\Support\Facades\Auth;
use DB;
use PDF;

class TravelController extends Controller
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
       $payorders=travel::where('submittedby','=',$id )
       ->get();
      
       

       return view('claim.travel.index',compact('payorders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $states=project::all();
      
        $countries = DB::table('projects')->pluck("name","id")->all();
        $countrie = DB::table('projects')->pluck("name","id")->all();
    
       $statess=employee::all();
     
       return view('claim.travel.create',compact('statess','states','countries','countrie'));
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
        $project = travel::create($request->all());
        $iid = $project->id;
        $iidd = $project->project;   
        
        $fileName = $iid.'travel.'.$request->file->extension();  

        $request->file->move(public_path('uploads'), $fileName);
    
        $data = travel::find($iid);
        $data->path = $fileName;
        $data->save();


        foreach ($request->addmore1 as $key => $value) {
            $value['rimbid'] = $iid;
            travelsub::create($value);

        }


        

        

        return redirect()->route('travel.index')
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
        $bud=travel::where('id','=',$id)->first();
       $budy=travelsub::where('rimbid','=',$id)->get();
       


       $data=compact('bud','budy');


       $pdf = PDF::loadView('claim.travel.show',$data);
   
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
