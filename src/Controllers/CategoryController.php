<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;
use App\Services\CategoryService;

class CategoryController extends Controller
{
    private CategoryService $service;

    public function index(): void
    {
        $this->view('categories');
    }

    private function service(): CategoryService
    {
        if (empty($this->service)) {
            $this->service = new CategoryService($this->db());
        }

        return $this->service;
    }

    public function create(): void
    {
        $this->view('admin/categories/create');
    }

    public function store(): void
    {
        $validation = $this->request()->validate([
            'name' => ['required', 'max:255'],
        ]);

        if (! $validation) {
            foreach ($this->request()->errors() as $key => $errors) {
                $this->session()->set($key, $errors);
            }
            $this->redirect('/admin/categories/create');
        }

        $this->service()->store($this->request()->input('name'));

        $this->redirect('/admin');
    }

    public function destroy(): void
    {
        $this->service()->destroy($this->request()->input('id'));

        $this->redirect('/admin');
    }

    public function edit(): void
    {
        $this->view('admin/categories/edit', [
            'category' => $this->service()->find($this->request()->input('id')),
        ]);
    }

    public function update(): void
    {
        $validation = $this->request()->validate([
            'name' => ['required', 'max:255'],
        ]);

        if (! $validation) {
            foreach ($this->request()->errors() as $key => $errors) {
                $this->session()->set($key, $errors);
            }
            $this->redirect("/admin/categories/edit?id={$this->request()->input('id')}");
        }

        $this->service()->update($this->request()->input('name'), $this->request()->input('id'));

        $this->redirect('/admin');
    }
}
