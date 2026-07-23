<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class employee extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','Category','Display_Name','Under','Employee','Designation','Function','Location','Gender','Date_of_Birth','Blood','Father',
        'Spouse','Bank_Name','Branch','Account_Number','IFS_Code','Contact_Number','Mail_ID','Address','Passport1','Country','Passport','Visa1'
        ,'Visa','Work','Contract1','Contract','Income_Tax','Aadhaar','Universal_Account','PF1','EPS','PF','ESI1','ESI','PR','gst','entered','updated','fy'

    ];
}
