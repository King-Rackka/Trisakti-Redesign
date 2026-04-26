<?php

namespace App\Controllers;

use App\Models\AdminModel;

class Auth extends BaseController
{
    public function login()
    {
        if (session()->get('isLoggedIn')) {
            return redirect()->to('/admin/dashboard');
        }
        return view('admin/login', ['title' => 'Login Admin']);
    }

    public function loginProcess()
    {
        $username = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $adminModel = new AdminModel();
        $admin = $adminModel->where('email', $username)->first();

        if ($admin && password_verify($password, $admin['password'])) {
            session()->set([
                'isLoggedIn' => true,
                'adminId'    => $admin['id'],
                'email'   => $admin['email'],
            ]);
            return redirect()->to('/admin/dashboard');
        }

        return redirect()->back()->with('error', 'Email atau password salah.')->withInput();
    }

    public function logout()
    {
        session()->destroy();
        return redirect()->to('/')->with('success', 'Berhasil logout.');
    }
}