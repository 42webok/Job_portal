<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SavedJobs extends Model
{
    use HasFactory;
    protected $table = 'saved_job';
    protected $fillable = [
        'id',
        'job_id',
        'user_id',
    ];

      public function jobs(){
        return $this->belongsTo(JobModel::class , 'job_id','id');
    }
}
