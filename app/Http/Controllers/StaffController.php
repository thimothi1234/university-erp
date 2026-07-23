<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\staff;


class StaffController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    function __construct()
    {
         $this->middleware('permission:staff-list|staff-create|staff-edit|staff-delete', ['only' => ['index','show']]);
         $this->middleware('permission:staff-create', ['only' => ['create','store']]);
         $this->middleware('permission:staff-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:staff-delete', ['only' => ['destroy']]);
    }


    public function index()
    {
        $payorders=staff::all();
        return view('staff.index',compact('payorders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('staff.create');
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
            'name' => 'required',
            'eid' => 'required',
            'designation' => 'required',
            'category' => 'required',
            'dob' => 'required',
            'pan' => 'required',
            'department' => 'required',
            'email' => 'required',
            'mobile' => 'required',
        ]);
    
        staff::create($request->all());
    
        return redirect()->route('staff.index')
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
    public function destroy($id)
    {
        //
    }
}
