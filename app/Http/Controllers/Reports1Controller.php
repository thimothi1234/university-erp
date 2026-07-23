<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\transactions;
use App\Models\project;
use Illuminate\Support\Facades\DB;


class Reports1Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $category = $request->get('project');

        $payorders=transactions::where('debit_credit','=','Payment')
        ->whereBetween('transactiondate', array($request->from, $request->to))
        ->where('project', '=', $category)
        ->get();
        $payordeer=transactions::where('debit_credit','=','Receipt')
        ->whereBetween('transactiondate', array($request->from, $request->to))
        ->where('project', '=', $category)
        ->get();

        $project=project::where('id','=',$category)->get();
        return view('reports.index',compact('payorders','payordeer','project'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        $userId = Auth::user()->name;
     $bud =DB::table('projects')
->select('projects.name','projects.id')
->join('pis','projects.id','=','pis.PROJECT')
->where(['pis.name' => $userId])
->get();



        return view('reports.create',compact('bud'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
