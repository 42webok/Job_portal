<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobTypeModel extends Model
{
    use HasFactory;
    protected $table = "job_type";
    protected $primaryKey = "id";
    protected $fillable = [
        'name',
        'status',
        'created_at',
        'updated_at',
    ];

    public function job_details(){
        return $this->hasMany(JobModel::class);
    }
}
