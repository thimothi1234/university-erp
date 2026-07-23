<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\project;
use App\Models\employee;
use App\Models\tempadv;
use App\Models\tady;
use App\Models\tempadvsub;
use App\Models\pi;
use App\Models\ipject;
use Illuminate\Support\Facades\Auth;
use DB;
use PDF;

class TempadvController extends Controller
{ /**
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
       $payorders=tempadv::where('submittedby','=',$id )
       ->get();
      
       

       return view('claim.tempadv.index',compact('payorders'));
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
     
       return view('claim.tempadv.create',compact('statess','states','countries','countrie'));

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
    $project = tempadv::create($request->all());
    $iid = $project->id;
    $iidd = $project->project; 
    
    $fileName = $iid.'tempadv.'.$request->file->extension();  

    $request->file->move(public_path('uploads'), $fileName);

    $data = tempadv::find($iid);
    $data->path = $fileName;
    $data->save();
          


       foreach ($request->addmore1 as $key => $value) {
           $value['rid'] = $iid;
           tempadvsub::create($value);
       }
       return redirect()->route('tempadv.index')
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

       $bud=tempadv::where('id','=',$id)->first();
       $budy=tempadvsub::where('rid','=',$id)->get();
       


       $data=compact('bud','budy');


       $pdf = PDF::loadView('claim.tempadv.show',$data);
   
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
       $statess=employee::all();
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
