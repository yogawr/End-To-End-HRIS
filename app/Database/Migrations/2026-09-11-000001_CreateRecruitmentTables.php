<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateRecruitmentTables extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'name' => ['type' => 'VARCHAR', 'constraint' => 150],
            'email' => ['type' => 'VARCHAR', 'constraint' => 190],
            'password_hash' => ['type' => 'VARCHAR', 'constraint' => 255],
            'role' => ['type' => 'VARCHAR', 'constraint' => 30, 'default' => 'candidate'],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('email');
        $this->forge->createTable('candidates');

        $this->forge->addField([
            'id' => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'title' => ['type' => 'VARCHAR', 'constraint' => 150],
            'department' => ['type' => 'VARCHAR', 'constraint' => 100],
            'location' => ['type' => 'VARCHAR', 'constraint' => 150],
            'description' => ['type' => 'TEXT'],
            'employment_type' => ['type' => 'VARCHAR', 'constraint' => 30, 'default' => 'full_time'],
            'status' => ['type' => 'VARCHAR', 'constraint' => 20, 'default' => 'published'],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('recruitment_jobs');

        $this->forge->addField([
            'id' => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'candidate_id' => ['type' => 'INT', 'unsigned' => true],
            'full_name' => ['type' => 'VARCHAR', 'constraint' => 150, 'null' => true],
            'profile' => ['type' => 'LONGTEXT', 'null' => true],
            'cv_path' => ['type' => 'VARCHAR', 'constraint' => 255, 'null' => true],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey('candidate_id');
        $this->forge->createTable('candidate_profiles');

        $this->forge->addField([
            'id' => ['type' => 'INT', 'unsigned' => true, 'auto_increment' => true],
            'candidate_id' => ['type' => 'INT', 'unsigned' => true],
            'job_id' => ['type' => 'INT', 'unsigned' => true],
            'cv_path' => ['type' => 'VARCHAR', 'constraint' => 255],
            'status' => ['type' => 'VARCHAR', 'constraint' => 40, 'default' => 'Menunggu seleksi'],
            'created_at' => ['type' => 'DATETIME', 'null' => true],
            'updated_at' => ['type' => 'DATETIME', 'null' => true],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addUniqueKey(['candidate_id', 'job_id']);
        $this->forge->createTable('job_applications');

        $this->db->table('recruitment_jobs')->insertBatch([
            ['title' => 'Area Sales Supervisor', 'department' => 'sales', 'location' => 'Madiun', 'description' => 'Bertanggung jawab atas pencapaian target penjualan area, supervisi tim lapangan, dan penetrasi pasar regional.', 'employment_type' => 'full_time', 'status' => 'published'],
            ['title' => 'Warehouse Supervisor', 'department' => 'logistik', 'location' => 'Sidoarjo', 'description' => 'Mengelola inventaris, kontrol stok opname, penerapan budaya 5R gudang, serta ketaatan standar K3.', 'employment_type' => 'full_time', 'status' => 'published'],
            ['title' => 'HRGA Officer', 'department' => 'human', 'location' => 'Semarang', 'description' => 'Menangani rekrutmen end-to-end, pengelolaan fasilitas kantor, serta hubungan industrial karyawan.', 'employment_type' => 'full_time', 'status' => 'published'],
        ]);
    }

    public function down()
    {
        $this->forge->dropTable('job_applications', true);
        $this->forge->dropTable('candidate_profiles', true);
        $this->forge->dropTable('recruitment_jobs', true);
        $this->forge->dropTable('candidates', true);
    }
}