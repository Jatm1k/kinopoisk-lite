<?php
/**
 * @var \App\Kernel\View\View $view
 * @var \App\Kernel\Session\Session $session
 * @var \App\Kernel\Auth\AuthInterface $auth
 */
?>
<?php $view->component('start'); ?>

    <main class="form-signin w-100 m-auto">
        <form action="/login" method="post">
            <div class="d-flex" style="align-items: center; justify-content: space-between">
                <h2>Вход</h2>
                <a href="/" class="d-flex align-items-center mb-5 mb-lg-0 text-white text-decoration-none">
                    <h5 class="m-0">Кинопоиск <span class="badge bg-warning warn__badge">Lite</span></h5>
                </a>
            </div>

            <div class="form-floating mt-3">
                <input type="email" name="email" class="form-control <?= $session->has('email') ? 'is-invalid' : '' ?>" id="floatingInput" placeholder="name@areaweb.su"> <label for="floatingInput">E-mail</label>
            </div>
            <div class="form-floating">
                <input type="password" name="password" class="form-control <?= $session->has('email') ? 'is-invalid' : '' ?>" id="floatingPassword" placeholder="Пароль"> <label for="floatingPassword">Пароль</label>
                <?php if ($session->has('email')) { ?>
                    <div class="invalid-feedback"><?= $session->getFlash('email') ?></div>
                <?php } ?>
            </div>
            <button class="btn btn-primary w-100 py-2" type="submit">Войти</button>
        </form>
    </main>

<?php $view->component('end'); ?>