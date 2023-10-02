<?php
/**
 * @var \App\Kernel\View\View $view
 * @var \App\Kernel\Session\Session $session
 * @var \App\Kernel\Auth\AuthInterface $auth
 * @var array<\App\Models\Category> $categories
 */
?>
<?php $view->component('start'); ?>

    <main>

        <div class="container">
            <h3 class="mt-3">Жанры</h3>
            <hr>
            <div class="movies">
                <?php if ($categories) {
                    foreach ($categories as $category) {
                        $view->component('category', ['category' => $category]);
                    }
                } ?>
            </div>
        </div>
    </main>

<?php $view->component('end'); ?>