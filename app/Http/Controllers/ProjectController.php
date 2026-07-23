<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\staff;
use App\Models\project;
use App\Models\project_head;
use App\Models\pi;
use App\Models\Tally;
use App\Models\employee;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
         $this->middleware('permission:project-list|project-create|project-edit|project-delete', ['only' => ['index','show']]);
         $this->middleware('permission:project-create', ['only' => ['create','store']]);
         $this->middleware('permission:project-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:project-delete', ['only' => ['destroy']]);
    }

    public function index()
    {
        $payorders=project::where('status', 1)->get();
        return view('projects.index',compact('payorders'));
    }

    public function index1()
    {
        $payorders=project::where('status', 1)->get();
        return view('projects.createsubhead',compact('payorders'));
    }

    public function index2(Request $request)
{
    $budget = $request->get('budget');
    $payorders = project::find($budget);

    if ($payorders) {
        $sub = project_head::where('project_id', $budget)
        ->orderBy('id', 'desc')
        ->get();
        return view('projects.createsubhead1', compact('payorders', 'sub'));
    }

    // Handle case where $payorders is null (budget not found)
    return redirect()->back()->with('error', 'Budget not found.');
}

public function storesub(Request $request)
{
    // Validate input data
    $request->validate([
        'head' => 'required|string',
        'amount' => 'required|numeric',
        'project_id' => 'required|exists:projects,id',
    ]);

    $subhead = project_head::create($request->all());
    $iid = $subhead->project_id;

    $payorders = project::find($iid);
    $sub = project_head::where('project_id', $iid)
    ->orderBy('id', 'desc')
    ->get();

    return redirect()->route('budget.createsub1', compact('payorders', 'sub'))
        ->with('success', 'Submitted successfully');
}


    
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $payorders=employee::where('Under','=','Faculty')->get();
        $payorders2=Tally::all();
        return view('projects.create',compact('payorders','payorders2'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        // request()->validate([
        //     'name' => 'required',
        //     'Projectcode' => 'required',
        //     'funding_agency' => 'required',
        //     'whether' => 'required',
        //     'start_date' => 'required',
        //     'agreement' => 'required',
        //     'Sanctionno' => 'required',
            
        //     'sanctioned' => 'required',
        //     'type' => 'required',
        //     'date' => 'required',
        //     'duration' => 'required',
        //     'end_date' => 'required',
        //     'status' => 'required',
        //     'pfms' => 'required',
        //     'remarks' => 'required',
        // ]);
    
        $project = project::create($request->all());
        $iid = $project->id;
      
        
       

    

        foreach ($request->addmore as $key => $value) {
            $value['PROJECT'] = $iid;
            pi::create($value);

        }


        if($request->addmore1 === NULL){
        }
        else{
            foreach ($request->addmore1 as $key => $value) {
                $value['project_id'] = $iid;
                project_head::create($value);
    
            } 
        }

    

        

        return redirect()->route('projects.index')
        ->with('success','Project created successfully');

        
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
