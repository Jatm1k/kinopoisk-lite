<?php
/**
 * @var \App\Kernel\View\View $view
 * @var \App\Kernel\Storage\StorageInterface $storage
 * @var \App\Models\Movie $movie
 */
?>
<a href="/movies?id=<?= $movie->id() ?>" class="card text-decoration-none movies__item">
    <img src="<?= $storage->url($movie->preview()) ?>" height="200px" class="card-img-top" alt="...">
    <div class="card-body">
        <h5 class="card-title"><?= $movie->name() ?></h5>
        <p class="card-text">Оценка <span class="badge bg-warning warn__badge"><?= $movie->rating() ?></span></p>
        <p class="card-text"><?= $movie->description() ?></p>
    </div>
</a>

