<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documents extends Model
{
    use HasFactory;
    protected $table = 'documents';
    protected $fillable = ['income_tax_returns_id',
    'document_name',
     'document_path',
    'created_by'
];
}
