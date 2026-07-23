<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\vendor;
use App\Models\employee;
use DataTables;
use Illuminate\Validation\Rule;


class VendorController extends Controller
{

    function __construct()
    {
         $this->middleware('permission:voucher-list|voucher-create|voucher-edit|voucher-delete', ['only' => ['index','show']]);
         $this->middleware('permission:voucher-create', ['only' => ['create','store']]);
         $this->middleware('permission:voucher-edit', ['only' => ['edit','update']]);

    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        // $payorders=employee::all();

       
        $payorders=employee::groupBy('Account_Number')->where('status','=',1)->orderBy('id', 'desc')->get();
       

        return view('add.vendor.index',compact('payorders'));




        // return view('employees.index',compact('payorders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('add.vendor.create');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

     
        $validatedData = $request->validate([
            'Account_Number' => [
                'required',
                Rule::unique('employees')->where(function ($query) {
                    return $query->where('status', 1);
                }),
                'max:255'
            ],
            'name' => [
                'required',
                Rule::unique('employees')->where(function ($query) {
                    return $query->where('status', 1);
                }),
                'max:255'
            ],
        ]);
        

        employee::create($request->all());
        return redirect()->route('beneficiary.index')
                        ->with('success','Vendor created successfully.');
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
        $bud=employee::where('id','=',$id)->first();
      
        return view('add.vendor.edit',compact('bud'));
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
       
    
        $user = employee::find($id);
        $user->update($input);

        return redirect()->route('beneficiary.index')
                        ->with('success','Vendor updated successfully');

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
