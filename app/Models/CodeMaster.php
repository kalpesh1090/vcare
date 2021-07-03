<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CodeMaster extends Model
{
    use HasFactory;
    protected $table = 'code_masters';

    protected $fillable=['code_name','start_date','end_date'];

}
