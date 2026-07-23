<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\transactions;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $ind = Auth::user()->id;

        $P1=transactions::where('status','=','1')->where('entered','=',$ind )->count();
        $P2=transactions::where('status','=','2')->where('entered','=',$ind )->count();
        $P3=transactions::where('status','=','3')->where('entered','=',$ind )->count();
        $P4=transactions::where('status','=','4')->where('entered','=',$ind )->count();
        $P5=transactions::where('status','=','paid')->where('entered','=',$ind )->count();

         $A3=transactions::where('debit_credit','=','Advance')->where('entered','=',$ind )->count();

         $AP3=transactions::where('debit_credit','=','Advance')->where('entered','=',$ind )->get(['id']);
        $A2=transactions::where('debit_credit', 'Advance Settlement')
    ->where('entered', $ind)
    ->whereIn('project', $AP3)
    ->count();
  
       
   // Check permission for P6
    if (auth()->user()->canany(['voucher-list','voucher-create','voucher-edit','voucher-delete'])) {
        $P6 = transactions::where('entered',$ind)->count();
    } else {
        $P6 = null;   // Hide if no permission
    }
        
        return view('home',compact('P1','P2','P3','P4','P5','P6','A3','A2'));
    }
}
