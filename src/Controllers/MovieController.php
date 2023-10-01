<?php

namespace App\Controllers;

use App\Kernel\Controller\Controller;
use App\Services\CategoryService;
use App\Services\MovieService;

class MovieController extends Controller
{
    private MovieService $service;

    private function service(): MovieService
    {
        if (empty($this->service)) {
            $this->service = new MovieService($this->db());
        }

        return $this->service;
    }

    public function create(): void
    {
        $categoryService = new CategoryService($this->db());
        $this->view('admin/movies/create', [
            'categories' => $categoryService->all(),
        ]);
    }

    public function store(): void
    {
        $validation = $this->request()->validate([
            'name' => ['required', 'max:255'],
            'description' => ['max:1000'],
            'preview' => ['required'],
            'category_id' => ['required'],
        ]);

        if (! $validation) {
            foreach ($this->request()->errors() as $key => $errors) {
                $this->session()->set($key, $errors);
            }
            $this->redirect('/admin/movies/create');
        }

        $this->service()->store(
            $this->request()->input('category_id'),
            $this->request()->input('name'),
            $this->request()->file('preview'),
            $this->request()->input('description'),
        );

        $this->redirect('/admin');
    }

    public function destroy(): void
    {
        $this->service()->destroy($this->request()->input('id'));

        $this->redirect('/admin');
    }

    public function edit(): void
    {
        $categoryService = new CategoryService($this->db());

        $this->view('admin/movies/edit', [
            'movie' => $this->service()->find($this->request()->input('id')),
            'categories' => $categoryService->all(),
        ]);
    }

    public function update(): void
    {
        $validation = $this->request()->validate([
            'name' => ['required', 'max:255'],
            'description' => ['max:1000'],
            'category_id' => ['required'],
        ]);

        if (! $validation) {
            foreach ($this->request()->errors() as $key => $errors) {
                $this->session()->set($key, $errors);
            }
            $this->redirect("/admin/movies/edit?id={$this->request()->input('id')}");
        }

        $this->service()->update(
            $this->request()->input('category_id'),
            $this->request()->input('name'),
            $this->request()->file('preview'),
            $this->request()->input('description'),
            $this->request()->input('id')
        );

        $this->redirect('/admin');
    }

    public function show(): void
    {
        $movie = $this->service()->find($this->request()->input('id'));
        $this->view('movie', [
            'movie' => $movie,
        ], $movie->name());
    }

    public function review(): void
    {
        $validation = $this->request()->validate([
            'user_id' => ['required'],
            'movie_id' => ['required'],
            'rating' => ['required'],
            'review' => ['required', 'max:1000'],
        ]);

        if (! $validation) {
            foreach ($this->request()->errors() as $key => $errors) {
                $this->session()->set($key, $errors);
            }
            $this->redirect("/movies?id={$this->request()->input('movie_id')}");
        }

        $this->service()->reviewStore($this->request()->validated());

        $this->redirect("/movies?id={$this->request()->input('movie_id')}");
    }
}
