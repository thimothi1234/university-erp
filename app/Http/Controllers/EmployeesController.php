<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\employee;
use App\Models\employees_profile;
use App\Models\user;
use App\Models\userrole;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Str;
use DB;
use Hash;
use App\Imports\AddIncomeImport;
use Maatwebsite\Excel\Facades\Excel;


class EmployeesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $payorders=employee::all();

        return view('employees.index',compact('payorders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
          $roles = Role::all();

        return view('payroll.employee.create',compact('roles'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    
public function store(Request $request)
{
    // Step 1: Validate duplicates before transaction
    $existingUser = User::where('email', $request->Mail_ID)->first();
    $existingAccount = DB::table('employees')->where('status', 1)->where('Account_Number', $request->Account_Number)->first();

    if ($existingUser) {
        return back()->with('error', 'The email address is already in use.');
    }

    if ($existingAccount) {
        return back()->with('error', 'The account number is already in use.');
    }

    // Step 2: Begin transaction
    DB::beginTransaction();

    try {
        // Insert into employees
        $beneficiaryId = DB::table('employees')->insertGetId([
            'Under' => $request->Under,
            'name' => $request->name,
            'Account_Number' => $request->Account_Number,
            'IFS_Code' => $request->IFS_Code,
            'Branch' => $request->Branch,
            'Bank_Name' => $request->Bank_Name,
            'gst' => $request->gst,
            'Income_Tax' => $request->Income_Tax,
            'Mail_ID' => $request->Mail_ID,
            'Contact_Number' => $request->Contact_Number,
            'Address' => $request->Address,
            'Contract1' => $request->Contract1,
            'entered' => $request->entered
        ]);


        // Insert into employees_profile
        DB::table('employees_profile')->insert([
            'Under' => $request->Under,
            'Name' => $request->name,
            'Display_Name_in_Reports' => $request->name,
            'EID' => $request->eid,
            'DOJ' => $request->DOJ,
            'Designationn' => $request->Designationn,
            'Function' => $request->Function,
            'Gender_' => $request->Gender_,
            'Date_of_Birth_' => $request->Date_of_Birth_,
            'PAN' => $request->Income_Tax,
            'Bank_Name_' => $request->Bank_Name,
            'Branch_' => $request->Branch,
            'Account_Number' => $request->Account_Number,
            'IFS_Code_' => $request->IFS_Code,
            'Contact_Number_' => $request->Contact_Number,
            'E_Mail_ID' => $request->Mail_ID,
            'hra' => $request->hra,
            'npa' => $request->npa,
            'fy' => $request->fy,
            'status' => $request->status,
            'taxregime' => $request->taxregime,
            'PRAN' => $request->PRAN,
            'Level' => $request->Level,
        ]);

        // Insert into basic
        DB::table('basic')->insert([
            'Employee_Name' => $request->name,
            'EID' => $request->eid,
            'fy' => '25-26',
            '1' => $request->a,
            '2' => $request->b,
            '3' => $request->c,
            '4' => $request->d,
            '5' => $request->e,
            '6' => $request->f,
            '7' => $request->g,
            '8' => $request->h,
            '9' => $request->i,
            '10' => $request->j,
            '11' => $request->k,
            '12' => $request->l,
        ]);

        // Create user
        $iidm = $beneficiaryId;
        $randomPassword = Str::random(10);
        $user = User::create([
            'name' => $iidm,
            'email' => $request->Mail_ID,
            'eid' => $request->eid,
            'password' => Hash::make($randomPassword),
        ]);

        $iid = $user->id;

        // Insert into form16
        DB::table('form16')->insert([
            'sid' => $request->eid,
            'parta' => $request->Income_Tax,
            'partb' => $request->Income_Tax,
            'trackid' => $iid,
        ]);

        // Insert role mapping
        userrole::insert([
            'roleid' => $request->roles,
            'userid' => $iid
        ]);

        // Assign Laravel role
        $user->assignRole($request->input('roles'));

        DB::commit(); // ✅ All good
        return redirect('fetchdata?id=' . $request->eid)->with('success', 'Beneficiary and User created successfully.');


    } catch (\Exception $e) {
        DB::rollBack(); // ❌ Error occurred
        return back()->with('error', 'Failed to create beneficiary. Error: ' . $e->getMessage());
    }
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

     public function showImportForm()
    {
        return view('payroll.import');
    }

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        Excel::import(new AddIncomeImport, $request->file('file'));

        return back()->with('success', 'Excel file imported successfully.');
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
