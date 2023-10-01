<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;
use App\Services\CategoryService;
use App\Services\MovieService;

class AdminController extends Controller
{
    private CategoryService $categoryService;

    private MovieService $movieService;

    private function categoryService(): CategoryService
    {
        if (empty($this->service)) {
            $this->categoryService = new CategoryService($this->db());
        }

        return $this->categoryService;
    }

    private function movieService(): MovieService
    {
        if (empty($this->service)) {
            $this->movieService = new MovieService($this->db());
        }

        return $this->movieService;
    }

    public function index(): void
    {
        $this->view('admin/index', [
            'categories' => $this->categoryService()->all(),
            'movies' => $this->movieService()->all(),
        ]);
    }
}
