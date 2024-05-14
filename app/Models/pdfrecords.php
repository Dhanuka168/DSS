<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class pdfrecords extends Model
{
    use HasFactory;

    protected $fillable = [
        'application_id',
        'user_id',
        'pdf_path',
        'pdf_path2',
        'pdf_path3'
    ];
}
