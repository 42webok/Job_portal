<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobApplication extends Model
{
    use HasFactory;

    protected $table = 'job_application';
    protected $fillable = [
        'job_id',
        'applicant_id',
        'job_owner_id',
        'applied_at'
    ];
}
