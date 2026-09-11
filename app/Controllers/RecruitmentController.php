<?php

namespace App\Controllers;

use App\Models\ApplicationModel;
use App\Models\CandidateProfileModel;
use App\Models\JobModel;
use CodeIgniter\HTTP\ResponseInterface;

class RecruitmentController extends BaseController
{
    public function jobs(): ResponseInterface
    {
        $jobs = (new JobModel())->where('status', 'published')->orderBy('created_at', 'DESC')->findAll();
        return $this->response->setJSON($jobs);
    }

    public function portal()
    {
        if (! $this->candidateId()) {
            return redirect()->to('/career');
        }

        return view('page kandidat/index', [
            'candidateApiUrls' => [
                'csrf' => site_url('career/csrf-token'),
                'profile' => site_url('api/candidate/profile'),
                'applications' => site_url('api/candidate/applications'),
                'jobs' => site_url('api/recruitment/jobs'),
                'logout' => site_url('career/logout'),
                'home' => site_url('career'),
            ],
        ]);
    }

    public function profile(): ResponseInterface
    {
        $candidateId = $this->candidateId();
        if (! $candidateId) return $this->unauthorized();

        $candidate = db_connect()->table('candidates')->select('id, name, email')->where('id', $candidateId)->get()->getRowArray();
        if (! $candidate) return $this->unauthorized();
        $profile = (new CandidateProfileModel())->where('candidate_id', $candidateId)->first();
        return $this->response->setJSON([
            'id' => $candidate['id'],
            'full_name' => $profile['full_name'] ?? $candidate['name'],
            'email' => $candidate['email'],
            'profile' => $profile['profile'] ?? '{}',
            'cv_path' => $profile['cv_path'] ?? null,
        ]);
    }

    public function saveProfile(): ResponseInterface
    {
        $candidateId = $this->candidateId();
        if (! $candidateId) return $this->unauthorized();

        $data = $this->request->getJSON(true);
        if (! is_array($data)) {
            $data = [
                'full_name' => $this->request->getPost('full_name'),
                'profile' => json_decode((string) $this->request->getPost('profile'), true) ?: [],
            ];
        }
        if (empty(trim($data['full_name'] ?? ''))) {
            return $this->response->setStatusCode(422)->setJSON(['message' => 'Nama lengkap wajib diisi.']);
        }

        try {
            $model = new CandidateProfileModel();
            $existing = $model->where('candidate_id', $candidateId)->first();
        } catch (\Throwable $error) {
            log_message('error', 'Candidate profile lookup failed for candidate {candidate}: {error}', ['candidate' => $candidateId, 'error' => $error->getMessage()]);
            return $this->response->setStatusCode(500)->setJSON(['message' => 'Tabel candidate_profiles tidak dapat diakses.', 'detail' => $error->getMessage()]);
        }
        $profile = ['candidate_id' => $candidateId, 'full_name' => trim($data['full_name']), 'profile' => json_encode($data['profile'] ?? [], JSON_UNESCAPED_UNICODE)];
        $cv = $this->request->getFile('cv');
        if ($cv && $cv->getError() !== UPLOAD_ERR_NO_FILE && ! $cv->isValid()) {
            return $this->response->setStatusCode(422)->setJSON(['message' => 'CV gagal diunggah. Silakan pilih file PDF/DOCX maksimal 5 MB.']);
        }
        if ($cv && $cv->isValid()) {
            if (! in_array($cv->getMimeType(), ['application/pdf', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'], true) || $cv->getSizeByUnit('mb') > 5) {
                return $this->response->setStatusCode(422)->setJSON(['message' => 'CV wajib berformat PDF/DOCX dan maksimal 5 MB.']);
            }
            $directory = WRITEPATH . 'uploads/candidates';
            if (! is_dir($directory)) mkdir($directory, 0750, true);
            $storedName = $cv->getRandomName();
            $cv->move($directory, $storedName);
            $profile['cv_path'] = 'candidates/' . $storedName;
        }
        try {
            $profile['updated_at'] = date('Y-m-d H:i:s');
            if ($existing) {
                $saved = db_connect()->table('candidate_profiles')->where('id', $existing['id'])->update($profile);
            } else {
                $profile['created_at'] = $profile['updated_at'];
                $saved = db_connect()->table('candidate_profiles')->insert($profile);
            }
            if ($saved === false) {
                throw new \RuntimeException((string) db_connect()->error()['message']);
            }
        } catch (\Throwable $error) {
            if (isset($storedName)) @unlink($directory . DIRECTORY_SEPARATOR . $storedName);
            log_message('error', 'Candidate profile save failed for candidate {candidate}: {error}', ['candidate' => $candidateId, 'error' => $error->getMessage()]);
            return $this->response->setStatusCode(500)->setJSON(['message' => 'Database profile belum sesuai.', 'detail' => $error->getMessage()]);
        }
        $candidateUpdate = db_connect()->table('candidates')->where('id', $candidateId)->update(['name' => trim($data['full_name'])]);
        if ($candidateUpdate === false) {
            log_message('error', 'Candidate name update failed for candidate {candidate}: {error}', ['candidate' => $candidateId, 'error' => db_connect()->error()['message']]);
        }

        return $this->response->setJSON(['message' => 'Profil berhasil disimpan.']);
    }

    public function applications(): ResponseInterface
    {
        $candidateId = $this->candidateId();
        if (! $candidateId) return $this->unauthorized();

        $rows = db_connect()->table('job_applications applications')
            ->select('applications.id, jobs.title, jobs.location, applications.status, applications.created_at')
            ->join('recruitment_jobs jobs', 'jobs.id = applications.job_id')
            ->where('applications.candidate_id', $candidateId)
            ->orderBy('applications.created_at', 'DESC')->get()->getResultArray();
        return $this->response->setJSON($rows);
    }

    public function apply(): ResponseInterface
    {
        $candidateId = $this->candidateId();
        if (! $candidateId) return $this->unauthorized();

        $jobId = (int) $this->request->getPost('job_id');
        $job = (new JobModel())->where(['id' => $jobId, 'status' => 'published'])->first();
        $cv = $this->request->getFile('cv');
        $profile = (new CandidateProfileModel())->where('candidate_id', $candidateId)->first();
        $profileValues = json_decode($profile['profile'] ?? '{}', true) ?: [];
        $profileValues['full_name'] = $profileValues['full_name'] ?? ($profile['full_name'] ?? '');
        $requiredProfile = ['full_name', 'nik', 'birth_place', 'birth_date', 'gender', 'phone', 'height', 'weight', 'blood_type', 'marital_status', 'mother_name', 'father_name', 'family_address'];
        $missingProfile = array_values(array_filter($requiredProfile, static fn (string $field): bool => empty(trim((string) ($profileValues[$field] ?? '')))));
        if ($missingProfile) {
            return $this->response->setStatusCode(422)->setJSON(['message' => 'Lengkapi data kandidat sebelum melamar.', 'missing' => $missingProfile]);
        }
        $storedCvPath = $profile['cv_path'] ?? null;
        if ($cv && $cv->getError() !== UPLOAD_ERR_NO_FILE && ! $cv->isValid()) {
            return $this->response->setStatusCode(422)->setJSON(['message' => 'CV gagal diunggah. Silakan pilih file PDF/DOCX maksimal 5 MB.']);
        }
        if (! $job || (($cv === null || ! $cv->isValid()) && ! $storedCvPath)) return $this->response->setStatusCode(422)->setJSON(['message' => 'Lowongan atau CV tidak valid.']);
        if ($cv && $cv->isValid() && (! in_array($cv->getMimeType(), ['application/pdf', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'], true) || $cv->getSizeByUnit('mb') > 5)) {
            return $this->response->setStatusCode(422)->setJSON(['message' => 'CV wajib berformat PDF/DOCX dan maksimal 5 MB.']);
        }
        if ((new ApplicationModel())->where(['candidate_id' => $candidateId, 'job_id' => $jobId])->first()) {
            return $this->response->setStatusCode(409)->setJSON(['message' => 'Anda sudah melamar posisi ini.']);
        }

        $directory = WRITEPATH . 'uploads/candidates';
        if (! is_dir($directory)) mkdir($directory, 0750, true);
        $storedName = null;
        if ($cv && $cv->isValid()) {
            $storedName = $cv->getRandomName();
            $cv->move($directory, $storedName);
        }
        $cvPath = $storedName ? 'candidates/' . $storedName : $storedCvPath;
        $applicationModel = new ApplicationModel();
        try {
            $applicationModel->insert(['candidate_id' => $candidateId, 'job_id' => $jobId, 'cv_path' => $cvPath]);
        } catch (\Throwable $error) {
            if ($storedName) @unlink($directory . DIRECTORY_SEPARATOR . $storedName);
            if (str_contains(strtolower($error->getMessage()), 'duplicate')) {
                return $this->response->setStatusCode(409)->setJSON(['message' => 'Anda sudah melamar posisi ini.']);
            }
            return $this->response->setStatusCode(500)->setJSON(['message' => 'Lamaran tidak dapat disimpan.']);
        }

        return $this->response->setStatusCode(201)->setJSON(['message' => 'Lamaran berhasil dikirim.']);
    }

    private function candidateId(): ?int
    {
        $id = $this->session->get('candidate_id');
        return $id ? (int) $id : null;
    }

    private function unauthorized(): ResponseInterface
    {
        return $this->response->setStatusCode(401)->setJSON(['message' => 'Silakan masuk terlebih dahulu.']);
    }
}