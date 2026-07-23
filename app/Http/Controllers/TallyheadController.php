<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tally;
use App\Models\tallygroup;
use App\Exports\StudentExport;
use Maatwebsite\Excel\Facades\Excel;
use DB;



class TallyheadController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
         $this->middleware('permission:Tally-list|Tally-create|Tally-edit|Tally-delete', ['only' => ['index','show']]);
         $this->middleware('permission:Tally-create', ['only' => ['create','store']]);
         $this->middleware('permission:Tally-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:Tally-delete', ['only' => ['destroy']]);
    }


    public function index()
    {
        $payorders=Tally::orderBy('id', 'desc')->paginate(500);;

        return view('add.tallyhead.index',compact('payorders'));
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
  public function create()
{
   $payorders = DB::table('tallygroups')
        ->select('id as groupidcode', 'groupname')
        ->orderByDesc('idd') 
        ->get();
    return view('add.tallyhead.create', compact('payorders'));
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
    'name' => 'required|unique:tallies,name',
    'group' => 'required',
    'balance' => 'required',
]);

    
        Tally::create($request->all());
    
        return redirect()->route('Tally.index')
                        ->with('success','Product created successfully.');
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
    public function destroy(Tally $payorder)
    {
        $payorder->delete();
    
        return redirect()->route('Tally.index')
                        ->with('success','Tally Head deleted successfully');
    }

    public function get_student_data()
    {
        return Excel::download(new StudentExport, 'students.xlsx');
    }
}
