<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\payorder;


class PayorderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
         $this->middleware('permission:payorder-list|payorder-create|payorder-edit|payorder-delete', ['only' => ['index','show']]);
         $this->middleware('permission:payorder-create', ['only' => ['create','store']]);
         $this->middleware('permission:payorder-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:payorder-delete', ['only' => ['destroy']]);
    }
    public function index()
    {
        
        return view('payorders.index');
    
           
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        
        return view('payorders.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
        return view('payorders.index');    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        return view('payorders.show');    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        
        return view('payorders.edit');    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        return view('payorders.index');    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        
        return view('payorders.index');    }
}
