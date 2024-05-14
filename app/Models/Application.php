<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Application extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'disease_id',
        'application_no',
        'patient_nic',
        'patient_name',
        'patient_address1',
        'patient_address2',
        'patient_phone',
        'patient_remarks'
    ];

    protected static function boot(){

        parent::boot();

        static::creating(function ($model){

            $model->application_no = static::generateApplicationNo();
        });
    }

    protected static function generateApplicationNo(){
        $lastRecord = static::orderBy('id','desc')->first();
        $nextId = $lastRecord ? $lastRecord->application_no + 1 : 100001;
         return $nextId;

    }

    public function updateDeleteStatus($appId)
    {
        return $this->where('id', $appId)
            ->update(['delete_status' => 1]);
    }

    public function rollbackDeleteStatus($appId)
    {
        return $this->where('id', $appId)
            ->update(['delete_status' => 0]);
    }

    public function applicationInactive($appId)
    {
        return $this->where('id', $appId)
            ->update(['delete_status' => 2]);
    }

    


}
