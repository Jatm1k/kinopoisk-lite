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
            <h3 class="mt-3">Регистрация</h3>
            <hr>
        </div>
        <div class="container d-flex justify-content-center">


            <form action="/register" method="post" class="d-flex flex-column justify-content-center w-50 gap-2 mt-5 mb-5">
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating">
                            <input type="text" name="name" class="form-control <?= $session->has('name') ? 'is-invalid' : '' ?>" id="name" placeholder="Иван Иванов">
                            <label for="name">Имя</label>
                            <?php if ($session->has('name')) { ?>
                                <div class="invalid-feedback"><?= $session->getFlash('name')[0] ?></div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating">
                            <input type="email" name="email" class="form-control <?= $session->has('email') ? 'is-invalid' : '' ?>" id="email" placeholder="name@areaweb.su">
                            <label for="email">E-mail</label>
                            <?php if ($session->has('email')) { ?>
                                <div class="invalid-feedback"><?= $session->getFlash('email')[0] ?></div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating">
                            <input type="password" name="password" class="form-control <?= $session->has('password') ? 'is-invalid' : '' ?>" id="password" placeholder="*********">
                            <label for="password">Пароль</label>
                            <?php if ($session->has('password')) { ?>
                                <div class="invalid-feedback"><?= $session->getFlash('password')[0] ?></div>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="col-md">
                        <div class="form-floating">
                            <input type="password" name="password_confirmation" class="form-control <?= $session->has('password_confirmation') ? 'is-invalid' : '' ?>" id="password_confirmation" placeholder="*********">
                            <label for="password_confirmation">Подтверждение</label>
                            <?php if ($session->has('password_confirmation')) { ?>
                                <div class="invalid-feedback"><?= $session->getFlash('password_confirmation')[0] ?></div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
                <div class="row g-2">
                    <button class="btn btn-primary">Создать аккаунт</button>
                </div>
            </form>
        </div>
    </main>

<?php $view->component('end'); ?>