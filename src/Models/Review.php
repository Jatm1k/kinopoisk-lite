<?php

namespace App\Models;

use App\Kernel\Auth\User;

class Review
{
    public function __construct(
        private int $id,
        private User $user,
        private int $movie_id,
        private int $rating,
        private string $review,
        private string $createdAt,
        private string $updatedAt,
    ) {
    }

    public function id(): int
    {
        return $this->id;
    }

    public function user(): User
    {
        return $this->user;
    }

    public function movieId(): int
    {
        return $this->movie_id;
    }

    public function rating(): int
    {
        return $this->rating;
    }

    public function review(): string
    {
        return $this->review;
    }

    public function createdAt(): string
    {
        return $this->createdAt;
    }

    public function updatedAt(): string
    {
        return $this->updatedAt;
    }
}
