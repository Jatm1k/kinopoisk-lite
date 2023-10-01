<?php
/**
 * @var \App\Kernel\View\View $view
 * @var \App\Kernel\Storage\StorageInterface $storage
 * @var \App\Kernel\Auth\AuthInterface $auth
 * @var \App\Kernel\Session\SessionInterface $session
 * @var \App\Models\Movie $movie
 */
?>
<?php $view->component('start'); ?>

<main>
    <div class="container">
        <div class="one-movie">
            <div class="card mb-3 mt-3 one-movie__item">
                <div class="row g-3">
                    <div class="col-md-4">
                        <img  src="<?= $storage->url($movie->preview()) ?>" class="img-fluid rounded one-movie__image" alt="...">
                        <?php if ($auth->check()) { ?>
                        <form action="/movies/review" method="post" class="m-3 w-100">
                            <input type="hidden" name="movie_id" value="<?= $movie->id() ?>">
                            <input type="hidden" name="user_id" value="<?= $auth->user()->id() ?>">
                            <select name="rating" class="form-select <?= $session->has('rating') ? 'is-invalid' : '' ?>" aria-label="Default select example">
                                <option selected>Оценка</option>
                                <option value="1">1</option>
                                <option value="2">2</option>
                                <option value="3">3</option>
                                <option value="4">4</option>
                                <option value="5">5</option>
                                <option value="6">6</option>
                                <option value="7">7</option>
                                <option value="8">8</option>
                                <option value="9">9</option>
                                <option value="10">10</option>
                            </select>
                            <?php if ($session->has('rating')) { ?>
                                <div class="invalid-feedback"><?= $session->getFlash('rating')[0] ?></div>
                            <?php } ?>
                            <div class="form-floating mt-2">
                                <textarea name="review" class="form-control <?= $session->has('review') ? 'is-invalid' : '' ?>" placeholder="Укажи свое мнение о фильме" id="floatingTextarea2" style="height: 100px"></textarea>
                                <label for="floatingTextarea2">Комментарий</label>
                                <?php if ($session->has('review')) { ?>
                                    <div class="invalid-feedback"><?= $session->getFlash('review')[0] ?></div>
                                <?php } ?>
                            </div>
                            <button class="btn btn-primary mt-2">Оставить отзыв</button>
                        </form>
                        <?php } else { ?>
                            <div class="alert alert-dark mx-2"><a href="/login">Войдите</a> или <a href="/register">зарегистрируетесь</a>, чтобы оставить отзыв</div>
                        <?php } ?>
                    </div>
                    <div class="col-md-8">
                        <div class="card-body">
                            <h1 class="card-title"><?= $movie->name() ?></h1>
                            <p class="card-text">Оценка <span class="badge bg-warning warn__badge"><?= $movie->rating() ?></span></p>
                            <p class="card-text"><?= $movie->description() ?></p>
                            <p class="card-text"><small class="text-body-secondary">Добавлен <?= $movie->createdAt() ?></small></p>
                            <h4>Отзывы</h4>
                            <div class="one-movie__reviews">
                                <?php if ($movie->reviews()) {
                                    foreach ($movie->reviews() as $review) {
                                        $view->component('review', ['review' => $review]);
                                    }
                                } else {
                                    echo 'Нет отзывов';
                                } ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php $view->component('end'); ?>