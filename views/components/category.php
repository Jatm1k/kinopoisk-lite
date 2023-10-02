<?php
/**
 * @var \App\Kernel\View\View $view
 * @var \App\Kernel\Storage\StorageInterface $storage
 * @var \App\Models\Category $category
 */
?>
<a href="#" class="card text-decoration-none movies__item">
    <img src="<?= $storage->url($category->preview()) ?>" height="200px" class="card-img-top" alt="...">
    <div class="card-body">
        <h5 class="card-title"><?= $category->name() ?></h5>
        <p class="card-text">Фильмов <span class="badge bg-info warn__badge">10</span></p>
    </div>
</a>

