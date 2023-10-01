<?php

namespace App\Services;

use App\Kernel\Auth\User;
use App\Kernel\Database\DatabaseInterface;
use App\Kernel\Upload\UploadedFileInterface;
use App\Models\Movie;
use App\Models\Review;

class MovieService
{
    public function __construct(
        private DatabaseInterface $db,
    ) {
    }

    /**
     * @return array<Movie>|null
     */
    public function all(): ?array
    {
        $movies = $this->db->get('movies');

        if ($movies) {
            return array_map(function ($movie) {
                return new Movie(
                    $movie['id'],
                    $movie['category_id'],
                    $movie['name'],
                    $movie['description'],
                    $movie['preview'],
                    $movie['created_at'],
                    $movie['updated_at'],
                );
            }, $movies);
        }

        return null;
    }

    /**
     * @return array<Movie>|null
     */
    public function new(): ?array
    {
        $movies = $this->db->get('movies', [], ['id' => 'DESC'], 5);
        if ($movies) {
            return array_map(function ($movie) {
                return new Movie(
                    $movie['id'],
                    $movie['category_id'],
                    $movie['name'],
                    $movie['description'],
                    $movie['preview'],
                    $movie['created_at'],
                    $movie['updated_at'],
                    $this->reviews($movie['id']),
                );
            }, $movies);
        }

        return null;
    }

    public function find(int $id): ?Movie
    {
        $movie = $this->db->first('movies', ['id' => $id]);

        if (! $movie) {
            return null;
        }

        return new Movie(
            $movie['id'],
            $movie['category_id'],
            $movie['name'],
            $movie['description'],
            $movie['preview'],
            $movie['created_at'],
            $movie['updated_at'],
            $this->reviews($movie['id']),
        );
    }

    public function store(int $category, string $name, UploadedFileInterface $file, string $description): void
    {
        $preview = $file->move('movies');
        $this->db->insert('movies', [
            'category_id' => $category,
            'name' => $name,
            'description' => $description,
            'preview' => $preview,
        ]);
    }

    public function reviewStore(array $data): void
    {
        $this->db->insert('reviews', [
            'user_id' => $data['user_id'],
            'movie_id' => $data['movie_id'],
            'rating' => $data['rating'],
            'review' => $data['review'],
        ]);
    }

    /**
     * @return ?array<Review>
     */
    private function reviews(int $movieId): ?array
    {
        $reviews = $this->db->get('reviews', ['movie_id' => $movieId]);

        return $reviews ? array_map(function ($review) {
            $user = $this->db->first('users', ['id' => $review['user_id']]);
            $user = new User(...$user);

            return new Review(
                $review['id'],
                $user,
                $review['movie_id'],
                $review['rating'],
                $review['review'],
                $review['created_at'],
                $review['updated_at'],
            );
        }, $reviews) : null;
    }

    public function update(int $category, string $name, ?UploadedFileInterface $file, string $description, int $id): void
    {
        $data = [
            'category_id' => $category,
            'name' => $name,
            'description' => $description,
        ];

        if (! $file->hasErrors()) {
            $data['preview'] = $file->move('movies');
        }

        $this->db->update('movies', $data, ['id' => $id]);
    }

    public function destroy(int $id): void
    {
        $this->db->delete('movies', [
            'id' => $id,
        ]);
    }
}
