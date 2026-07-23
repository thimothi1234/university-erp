<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\project;
use App\Models\mobile;
use App\Models\tady;
use App\Models\employee;
use App\Models\pi;
use App\Models\ipject;
use Illuminate\Support\Facades\Auth;
use DB;
use PDF;


class MobileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    function __construct()
    {
         $this->middleware('permission:claim-list|claim-create|claim-edit|claim-delete', ['only' => ['index','show']]);
         $this->middleware('permission:claim-create', ['only' => ['create','store']]);
         $this->middleware('permission:claim-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:voucher-create', ['only' => ['inwardmobile','updateStatus']]);
    }
    public function index()
    {
        $id = Auth::user()->id;
        $payorders=mobile::where('submittedby','=',$id )
        ->orderBy('id', 'desc')
        ->get();
       
        

        return view('claim.mobile.index2',compact('payorders'));
    }

    public function inwardmobile()
    {

        $payorders=mobile::get();
       
        return view('claim.mobile.index',compact('payorders'));
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
        return view('claim.mobile.create',compact('statess','states','countries','countrie'));

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
        'file' => 'required|mimes:pdf|max:1048'
    ]);

    // Save parent data into mobiles table
    $mobile = mobile::create([
        'submittedby' => $request->submittedby,
        'name'        => $request->name,
        'designation' => $request->designation,
        'eid'         => $request->eid,
        'department'  => $request->department,
        'from'    => $request->from,
        'remarks'     => $request->remarks,
        'status'      => $request->status,
    ]);

    // Handle file upload
    if ($request->hasFile('file')) {
        $fileName = $mobile->id . 'mobile.' . $request->file->extension();
        $request->file->move(public_path('uploads'), $fileName);

        $mobile->path = $fileName;
        $mobile->save();
    }

    // Save child rows into mobilesubs table
    if ($request->has('items')) {
        foreach ($request->items as $item) {
            DB::table('mobilesubs')->insert([
                'mainid' => $mobile->id, // foreign key reference
                'type'      => $item['type'],
                'number'    => $item['number'],
                'from_date' => $item['from_date'],
                'to_date'   => $item['to_date'],
                'amount'    => $item['amount'],
                'created_at'=> now(),
                    'updated_at'=> now(),
            ]);
        }
    }

    return redirect()->route('mobile.index')
        ->with('success', 'Submitted successfully.');
}


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
public function show($id) 
{
    $authId = Auth::user()->id;

    // Fetch the claim
    $bud = mobile::where('id', $id)->first();

    if (!$bud) {
        abort(404, 'Claim not found.');
    }

    // Permission check
    if (!in_array($authId, [47, 46]) && $bud->submittedby != $authId) {
        abort(403, 'You are not allowed to view this claim.');
    }

    $budy = tady::where('taid', $id)->get();
    $name = $bud->eid;

    $subs = DB::table('mobilesubs')
        ->where('mainid', $id)
        ->get();

    $total = $subs->sum('amount');

    $data = compact('bud', 'budy', 'subs', 'total');

    $pdf = PDF::loadView('claim.mobile.show', $data);

    return $pdf->stream($name . '_Telephone Reimbursement.pdf');
}


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {   
        $bud=mobile::where('id','=',$id)->first();
        $budy=tady::where('taid','=',$id)->get();
        $states=project::all();
        $statess=employee::where('status','=','1')->groupBy('Account_Number')->get();
        $countries = DB::table('projects')->pluck("name","id")->all();
        $countrie = DB::table('projects')->pluck("name","id")->all();
        return view('claim.mobile.edit',compact('statess','states','countries','countrie','bud','budy'));
        
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
       
    
        $user = mobile::find($id);
        $user->update($input);

      


        return redirect()->route('mobile.index')
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

    public function updateStatus(Request $request)
{
    $ids = explode(',', $request->selected_ids);
    $status = $request->status_id;

    DB::table('mobiles')
        ->whereIn('id', $ids)
        ->update(['status' => $status]);

    return redirect()->back()->with('success', 'Selected claims updated successfully!');
}


}
