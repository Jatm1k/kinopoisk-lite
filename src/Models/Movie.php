<?php

namespace App\Models;

class Movie
{
    public function __construct(
        private int $id,
        private int $category_id,
        private string $name,
        private string $description,
        private string $preview,
        private string $createdAt,
        private string $updatedAt,
        private ?array $reviews = [],
    ) {
    }

    public function categoryId(): int
    {
        return $this->category_id;
    }

    public function description(): string
    {
        return $this->description;
    }

    public function preview(): string
    {
        return $this->preview;
    }

    public function id(): int
    {
        return $this->id;
    }

    public function name(): string
    {
        return $this->name;
    }

    public function createdAt(): string
    {
        return $this->createdAt;
    }

    public function updatedAt(): string
    {
        return $this->updatedAt;
    }

    /**
     * @return ?array<Review>
     */
    public function reviews(): ?array
    {
        return $this->reviews ?? null;
    }

    public function rating(): float
    {
        return $this->reviews() ? round(array_sum(array_map(fn ($review) => $review->rating(), $this->reviews())) / count($this->reviews()), 1) : 0;
    }
}
