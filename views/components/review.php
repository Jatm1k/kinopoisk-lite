<?php
/**
 * @var \App\Kernel\View\View $view
 * @var \App\Kernel\Storage\StorageInterface $storage
 * @var \App\Models\Review $review
 */
?>
<div class="card">
    <div class="card-header">
        Пользователь: <?= "{$review->user()->name()}({$review->user()->email()})" ?>
    </div>
    <div class="card-body">
        <blockquote class="blockquote mb-0">
            <p><?= $review->review() ?></p>
            <footer class="blockquote-footer">Оценка <span class="badge bg-warning warn__badge"><?= $review->rating() ?></span></footer>
        </blockquote>
    </div>
</div>

