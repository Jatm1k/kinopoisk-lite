<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;

class LoginController extends Controller
{
    public function index(): void
    {
        $this->view('login');
    }

    public function login(): void
    {
        if (! $this->auth()->attempt($this->request()->input('email'), $this->request()->input('password'))) {
            $this->session()->set('email', 'Неверный логин или пароль');
            $this->redirect('/login');
        }

        $this->redirect('/');
    }

    public function logout(): void
    {
        $this->auth()->logout();
        $this->redirect('/');
    }
}
