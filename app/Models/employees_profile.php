<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class employees_profile extends Model
{
    use HasFactory;
    protected $fillable = [
    'Under',
    'Name',
    'Display_Name_in_Reports',
    'EID',
    'DOJ',
    'Designationn',
    'Function',
    'Gender_',
    'Date_of_Birth_',
    'PAN',
    'Bank_Name_',
    'Branch_',
    'Account_Number',
    'IFS_Code_',
    'Contact_Number_',
    'E_Mail_ID',
    'hra',
    'npa',
    'status',
    'taxregime',
    'PRAN',
    'Level',
    'entered',
    'roles',
    'Address',
    'Contract1'
];

}
