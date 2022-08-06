<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Queue extends Model
{
    use HasFactory;

    protected $table = 'queues';

    protected $fillable = ['user_id', 'queue_number', 'queue_status', 'created_at', 'updated_at'];
}
