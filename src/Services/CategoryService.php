<?php

namespace App\Services;

use App\Kernel\Database\DatabaseInterface;
use App\Kernel\Upload\UploadedFileInterface;
use App\Models\Category;

class CategoryService
{
    public function __construct(
        private DatabaseInterface $db,
    ) {
    }

    /**
     * @return array<Category>|null
     */
    public function all(): ?array
    {
        $categories = $this->db->get('categories');

        if ($categories) {
            return array_map(function ($category) {
                return new Category(
                    $category['id'],
                    $category['name'],
                    $category['preview'],
                    $category['created_at'],
                    $category['updated_at'],
                );
            }, $categories);
        }

        return null;
    }

    public function find(int $id): ?Category
    {
        $category = $this->db->first('categories', ['id' => $id]);

        if (! $category) {
            return null;
        }

        return new Category(
            $category['id'],
            $category['name'],
            $category['preview'],
            $category['created_at'],
            $category['updated_at'],
        );
    }

    public function store(string $name, UploadedFileInterface $file): void
    {
        $preview = $file->move('categories');
        $this->db->insert('categories', [
            'name' => $name,
            'preview' => $preview,
        ]);
    }

    public function update(string $name, ?UploadedFileInterface $file, int $id): void
    {
        $data = [
            'name' => $name,
        ];

        if (! $file->hasErrors()) {
            $data['preview'] = $file->move('categories');
        }
        $this->db->update('categories', $data, ['id' => $id]);
    }

    public function destroy(int $id): void
    {
        $this->db->delete('categories', [
            'id' => $id,
        ]);
    }
}
