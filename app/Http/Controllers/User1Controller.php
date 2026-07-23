<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Mail\TestUserMail;
use Mail;

class User1Controller extends Controller
{
    /**
     * Write Your Code..
     *
     * @return string
    */
    public function index()
    {
        $users = User::select('*')
                        ->orderBy('id','ASC')
                        ->paginate(10);

        return view('users', compact('users'));
    }    

    /**
     * Write Your Code..
     *
     * @return string
    */
    public function sendMail(Request $request)
    {
        $users = User::whereIn('id',$request->ids)->get();
        
        if ($users->count() > 0) {
            foreach($users as $key => $value){
                if (!empty($value->email)) {
                    $details = [
                      'subject' => 'Test From Nicesnippets.com',
                    ];

                    Mail::to($value->email)->send(new TestUserMail($details));
                }
            }
        }

        return response()->json(['done']);
    }
}
