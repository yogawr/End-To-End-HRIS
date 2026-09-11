<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class AddRecruitmentIntegrity extends Migration
{
    public function up()
    {
        // Stop rather than silently deleting production data if old orphan rows exist.
        $orphanProfiles = $this->db->query('SELECT COUNT(*) AS total FROM candidate_profiles profiles LEFT JOIN candidates candidates ON candidates.id = profiles.candidate_id WHERE candidates.id IS NULL')->getRow()->total;
        $orphanApplications = $this->db->query('SELECT COUNT(*) AS total FROM job_applications applications LEFT JOIN candidates candidates ON candidates.id = applications.candidate_id LEFT JOIN recruitment_jobs jobs ON jobs.id = applications.job_id WHERE candidates.id IS NULL OR jobs.id IS NULL')->getRow()->total;
        if ((int) $orphanProfiles > 0 || (int) $orphanApplications > 0) {
            throw new \RuntimeException('Recruitment migration dihentikan: hapus atau perbaiki data orphan pada candidate_profiles/job_applications terlebih dahulu.');
        }

        if (! $this->hasConstraint('candidate_profiles', 'candidate_profiles_candidate_fk')) {
            $this->forge->addForeignKey('candidate_id', 'candidates', 'id', 'CASCADE', 'CASCADE', 'candidate_profiles_candidate_fk');
            $this->forge->processIndexes('candidate_profiles');
        }

        if (! $this->hasConstraint('job_applications', 'job_applications_candidate_fk')) {
            $this->forge->addForeignKey('candidate_id', 'candidates', 'id', 'CASCADE', 'CASCADE', 'job_applications_candidate_fk');
            $this->forge->processIndexes('job_applications');
        }

        if (! $this->hasConstraint('job_applications', 'job_applications_job_fk')) {
            $this->forge->addForeignKey('job_id', 'recruitment_jobs', 'id', 'CASCADE', 'CASCADE', 'job_applications_job_fk');
            $this->forge->processIndexes('job_applications');
        }
    }

    public function down()
    {
        $this->dropForeignKeyIfExists('candidate_profiles', 'candidate_profiles_candidate_fk');
        $this->dropForeignKeyIfExists('job_applications', 'job_applications_candidate_fk');
        $this->dropForeignKeyIfExists('job_applications', 'job_applications_job_fk');
    }

    private function hasConstraint(string $table, string $constraint): bool
    {
        $row = $this->db->query('SELECT CONSTRAINT_NAME FROM information_schema.TABLE_CONSTRAINTS WHERE CONSTRAINT_SCHEMA = DATABASE() AND TABLE_NAME = ? AND CONSTRAINT_NAME = ?', [$table, $constraint])->getRowArray();
        return $row !== null;
    }

    private function dropForeignKeyIfExists(string $table, string $constraint): void
    {
        if ($this->hasConstraint($table, $constraint)) {
            $this->forge->dropForeignKey($table, $constraint);
        }
    }
}
