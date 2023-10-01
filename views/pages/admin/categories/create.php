<?php
/**
 * @var \App\Kernel\View\View $view
 * @var \App\Kernel\Session\Session $session
 * @var \App\Kernel\Auth\AuthInterface $auth
 */
?>
<?php $view->component('start'); ?>

    <main>
        <div class="container">
            <h3 class="mt-3">Создание нового жанра</h3>
            <hr>
        </div>
        <div class="container d-flex justify-content-center">


            <form action="/admin/categories/create" method="post" class="d-flex flex-column justify-content-center w-50 gap-2 mt-5 mb-5">
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating">
                            <input type="text" name="name" class="form-control <?= $session->has('name') ? 'is-invalid' : '' ?>" id="name" placeholder="Иван Иванов">
                            <label for="name">Название</label>
                            <?php if ($session->has('name')) { ?>
                                <div class="invalid-feedback"><?= $session->getFlash('name')[0] ?></div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="row g-2">
                    <button class="btn btn-primary">Создать</button>
                </div>
            </form>
        </div>
    </main>

<?php $view->component('end'); ?>