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
            <h3 class="mt-3">Создание нового фильма</h3>
            <hr>
        </div>
        <div class="container d-flex justify-content-center">


            <form action="/admin/movies/create" method="post" enctype="multipart/form-data" class="d-flex flex-column justify-content-center w-50 gap-2 mt-5 mb-5">
                <div class="row g-2">
                    <div class="col-md">
                        <div class="form-floating">
                            <input type="text" name="name" class="form-control <?= $session->has('name') ? 'is-invalid' : '' ?>" id="name" placeholder="Драйв">
                            <label for="name">Название</label>
                            <?php if ($session->has('name')) { ?>
                                <div class="invalid-feedback"><?= $session->getFlash('name')[0] ?></div>
                            <?php } ?>
                        </div>
                        <div class="form-floating mt-2">
                            <textarea name="description" class="form-control <?= $session->has('description') ? 'is-invalid' : '' ?>" placeholder="Описание" id="floatingTextarea2" style="height: 100px"></textarea>
                            <label for="floatingTextarea2">Описание</label>
                            <?php if ($session->has('description')) { ?>
                                <div class="invalid-feedback"><?= $session->getFlash('description')[0] ?></div>
                            <?php } ?>
                        </div>
                        <div class="mt-2">
                            <label for="preview" class="form-label">Превью</label>
                            <input type="file" name="preview" class="form-control <?= $session->has('preview') ? 'is-invalid' : '' ?>" id="preview">
                            <?php if ($session->has('preview')) { ?>
                                <div class="invalid-feedback"><?= $session->getFlash('preview')[0] ?></div>
                            <?php } ?>
                        </div>
                        <div class="mt-2">
                            <label for="category" class="form-label">Жанр</label>
                            <select name="category_id" id="category" class="form-select">
                                <?php foreach ($categories as $category) { ?>
                                    <option value="<?= $category->id() ?>"><?= $category->name() ?></option>
                                <?php } ?>
                            </select>
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