<?php $render('header', ['user' => $user]) ?>

<section class="container main">

    <?php $render('sidebar') ?>

    <section class="feed mt-10">
        <div class="row">
            <div class="column pr-5">


                <?= $render('feed-editor', ['user' => $user]) ?>
                <?= $render('feed-item', ['user' => $user]) ?>

            </div>
            <div class="column side pl-5">
                <div class="box banners">
                    <div class="box-header">
                        <div class="box-header-text">Patrocinios</div>
                        <div class="box-header-buttons"></div>
                    </div>
                    <div class="box-body">
                        <a href=""><img
                                src="https://kinsta.com/pt/wp-content/uploads/sites/3/2020/03/tutoriais-de-php.png" /></a>
                        <a href=""><img src="https://belenos.me/media/2021-06-laravel.webp" /></a>
                    </div>
                </div>
            </div>
        </div>
    </section>
</section>

<?php $render('footer') ?>