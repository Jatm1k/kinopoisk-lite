<?php
/**
 * @var \App\Kernel\View\View $view
 * @var \App\Kernel\Session\Session $session
 * @var \App\Kernel\Auth\AuthInterface $auth
 * @var array<\App\Models\Movie> $movies
 */
?>
<?php $view->component('start'); ?>

<main>

    <div class="container">
        <h3 class="mt-3">Новинки</h3>
        <hr>
        <div class="movies">
            <?php foreach ($movies as $movie) {
                $view->component('movie', ['movie' => $movie]);
            } ?>
        </div>
    </div>
</main>

<?php $view->component('end'); ?>