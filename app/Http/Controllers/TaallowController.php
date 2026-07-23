<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\project;
use App\Models\ta;
use App\Models\tady;
use App\Models\employee;
use App\Models\pi;
use App\Models\ipject;
use Illuminate\Support\Facades\Auth;
use DB;


class TaallowController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::user()->id;
        $payorders=ta::where('submittedby','=',$id )
        ->get();
       
        

        return view('claim.taallowance.index',compact('payorders'));
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
        $project = ta::create($request->all());
        $iid = $project->id;
        $iidd = $project->project;       


        foreach ($request->addmore1 as $key => $value) {
            $value['taid'] = $iid;
            tady::create($value);

        }


        foreach ($request->addmore as $key => $value) {
            $value['tid'] = $iid;
            ipject::create($value);

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

        $bud=ta::where('id','=',$id)->get();
        $budy=tady::where('taid','=',$id)->get();
        return view('claim.show',compact('bud','budy'));
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
