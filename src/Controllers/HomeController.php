<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;
use App\Services\MovieService;

class HomeController extends Controller
{
    private MovieService $movieService;

    private function movieService(): MovieService
    {
        if (empty($this->service)) {
            $this->movieService = new MovieService($this->db());
        }

        return $this->movieService;
    }

    public function index(): void
    {
        $this->view('home', ['movies' => $this->movieService()->new()], 'Главная');
    }
}
