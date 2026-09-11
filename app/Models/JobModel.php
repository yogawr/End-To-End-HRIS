<?php

namespace App\Models;

use CodeIgniter\Model;

class JobModel extends Model
{
    protected $table = 'recruitment_jobs';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = ['title', 'department', 'location', 'description', 'employment_type', 'status', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
}