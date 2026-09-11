<?php

namespace App\Models;

use CodeIgniter\Model;

class CandidateProfileModel extends Model
{
    protected $table = 'candidate_profiles';
    protected $primaryKey = 'id';
    protected $returnType = 'array';
    protected $allowedFields = ['candidate_id', 'full_name', 'profile', 'cv_path', 'created_at', 'updated_at'];
    protected $useTimestamps = true;
}