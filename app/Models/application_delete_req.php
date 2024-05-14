<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class application_delete_req extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'application_id',
        'user_message',
        'delete_req_status'
    ];

    public function rollbackStatus($drId)
    {
        return $this->where('id', $drId)
            ->update(['delete_req_status' => 0]);
    }
}
