<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tally;
use DB;

class ledger extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $bud=DB::table('ledgers')
        ->select('tallygroups.groupname', DB::raw('SUM(ledgers.amount) AS amount'))     
        ->join('tallies','tallies.id', '=', 'ledgers.ledger')
        ->join('tallygroups','tallygroups.id', '=', 'tallies.group')
        ->groupBy('tallygroups.groupname')
        ->get();

        return view('reports.ledger.index',compact('bud'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $bud=Tally::all();

        return view('reports.ledger.create',compact('bud'));
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
