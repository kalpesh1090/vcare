<?php

namespace App\Models;

//use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Member extends Model
{
    use HasFactory;
    //use HasFactory;
    protected $table = 'members';
    protected $fillable = ['created_user_id',
    'itr_financial_year',
    'first_name',
    'last_name',
    'pan_number',
    'pan_file',
    'father_name',
    'sex',
    'block_no',
    'name_of_Premises',
    'street',
    'locality',
    'city',
    'pin',
    'state',
    'country',
    'mobile',
    'status',
    'resident_status',
    'resident_status_details',
    'aadhaar_number',
    'email_address',
    'income_from_salary',
    'income_from_house',
    'share_transactions',
    'income_from_consultancy',
    'director_in_company',
    'current_status',
    'relationship',
    'relationship_other',    
];




}
