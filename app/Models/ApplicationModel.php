<?php

namespace App\Models;

use CodeIgniter\Model;

class ApplicationModel extends Model
{
    protected $table = 'job_applications';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = ['candidate_id', 'job_id', 'cv_path', 'status', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
}