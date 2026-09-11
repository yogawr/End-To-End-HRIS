<?php

namespace App\Controllers;

use App\Models\CandidateModel;
use CodeIgniter\HTTP\ResponseInterface;

class AuthController extends BaseController
{
    public function csrfToken(): ResponseInterface
    {
        return $this->response->setHeader('Cache-Control', 'no-store, no-cache, must-revalidate')->setJSON(['token' => csrf_hash()]);
    }

    public function register(): ResponseInterface
    {
        $data = $this->request->getJSON(true) ?? [];
        $rules = [
            'name' => 'required|string|min_length[2]|max_length[150]',
            'email' => 'required|valid_email|max_length[190]',
            'password' => 'required|min_length[8]|max_length[72]',
            'password_confirmation' => 'required|matches[password]',
        ];

        if (! $this->validateData($data, $rules)) {
            return $this->errorResponse($this->validator->getErrors(), 422);
        }

        $model = new CandidateModel();
        if ($model->where('email', strtolower(trim($data['email'])))->first()) {
            return $this->errorResponse(['email' => 'Email tersebut sudah terdaftar.'], 409);
        }

        $candidateId = $model->insert([
            'name' => trim($data['name']),
            'email' => strtolower(trim($data['email'])),
            'password' => $data['password'],
            'role' => 'candidate',
        ], true);

        if (! $candidateId) {
            return $this->errorResponse(['message' => 'Akun tidak dapat dibuat.'], 500);
        }

        $this->startSession((int) $candidateId);
        return $this->response->setStatusCode(201)->setJSON(['redirect' => 'career/portal']);
    }

    public function login(): ResponseInterface
    {
        $data = $this->request->getJSON(true) ?? [];
        if (! $this->validateData($data, ['email' => 'required|valid_email', 'password' => 'required'])) {
            return $this->errorResponse($this->validator->getErrors(), 422);
        }

        $candidate = (new CandidateModel())->where('email', strtolower(trim($data['email'])))->first();
        if (! $candidate || ! password_verify($data['password'], $candidate['password_hash'])) {
            return $this->errorResponse(['message' => 'Email atau kata sandi tidak valid.'], 401);
        }

        $this->startSession((int) $candidate['id']);
        return $this->response->setJSON(['redirect' => 'career/portal']);
    }

    public function logout(): ResponseInterface
    {
        $this->session->remove(['candidate_id', 'candidate_email']);
        $this->session->regenerate(true);
        return $this->response->setJSON(['redirect' => 'career']);
    }

    private function startSession(int $candidateId): void
    {
        $this->session->regenerate(true);
        $candidate = (new CandidateModel())->find($candidateId);
        if (! $candidate) {
            $this->session->remove(['candidate_id', 'candidate_email']);
            return;
        }
        $this->session->set([
            'candidate_id' => $candidateId,
            'candidate_email' => $candidate['email'],
        ]);
    }

    private function errorResponse(array|string $errors, int $status): ResponseInterface
    {
        return $this->response->setStatusCode($status)->setJSON([
            'message' => is_string($errors) ? $errors : (reset($errors) ?: 'Permintaan tidak valid.'),
            'errors' => is_array($errors) ? $errors : [],
        ]);
    }
}