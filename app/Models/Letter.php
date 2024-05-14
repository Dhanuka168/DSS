<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Letter extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'disease_id',
        'app_no',
        'patient_nic',
        'patient_name',
        'applicant_nic',
        'applicant_nic',
        'phone',
        'city'
    ];


    protected static function boot(){

        parent::boot();

        static::creating(function ($model){

            $model->app_no = static::generateApplicationNo();
        });
    }

    protected static function generateApplicationNo(){
        $lastRecord = static::orderBy('id','desc')->first();
        $nextId = $lastRecord ? $lastRecord->app_no + 1 : 600001;
         return $nextId;

    }

}
