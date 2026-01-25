<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JobModel extends Model
{
    use HasFactory;
    protected $primaryKey = "id";
    protected $table = "job_details";
    protected $fillable = [
        'title',
        'category_id',
        'description',
        'job_type_id',
        'vacancy',
        'benefits',
        'responsibility',
        'qualifications',
        'keywords',
        'experience',
        'location',
        'salary',
        'company_name',
        'company_website',
        'company_location',
        'created_at',
        'updated_at',
        'status',
    ];

    public function jobType(){
        return $this->belongsTo(JobTypeModel::class, 'job_type_id', 'id');
    }

    public function category(){
        return $this->belongsTo(CategoriesModel::class, 'category_id', 'id');
    }

    public function applications()
    {
        return $this->hasMany(JobApplication::class, 'job_id');
    }

}
