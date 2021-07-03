<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;
    protected $table = 'payments';
    public $timestamps = false;

    protected $fillable = ['party_name', 'user_id', 'address', 'city', 'state', 'gst_number', 'transaction_number','comment'];

}
