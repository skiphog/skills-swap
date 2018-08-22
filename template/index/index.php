<?php
/**
 * @var \System\View $this
 */
?>
<?php $this->extend('layouts/app'); ?>

<?php $this->start('title'); ?>skills-swap<?php $this->stop(); ?>
<?php $this->start('description'); ?>skills-swap<?php $this->stop(); ?>

<?php $this->start('content'); ?>


    <div class="ss-theme-book"></div>

    <div class="uk-section uk-section-primary uk-section-small uk-flex uk-flex-middle uk-text-center ss-section-first">

        <div class="uk-container">
            <p>
                <img src="/img/swap.png" width="741" height="121" alt="Логотип">
            </p>
            <p class="uk-margin-large uk-text-lead">
                A mother fucker skills swap profession<br class="uk-visible@s">
                for fucking some fucking people.
            </p>

            <div class="uk-flex-inline uk-flex-center uk-margin-large-bottom">
                <a class="ss-auth uk-button uk-button-primary ss-button-primary uk-button-large tm-button-large uk-visible@s" data-index="0">Get Started</a>
                <a class="ss-auth uk-button uk-button-primary ss-button-primary uk-hidden@s" data-index="0">Get Started</a>
            </div>
        </div>

    </div>

    <div class="uk-section uk-section-primary uk-text-center ss-section-second">
        <div class="uk-container">

            <h1>Наши фишки</h1>
            <p class="uk-margin-medium uk-text-lead">Много фишек! Просто поверьте нам!</p>

            <div class="uk-grid-match uk-child-width-1-4@m" uk-grid>
                <div>
                    <img class="ss-preview-icon" src="/img/icon_less.svg" width="200" height="140" alt="1 icon">
                    <h2 class="uk-margin-remove">Фишка 1</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.</p>
                </div>
                <div>
                    <img class="ss-preview-icon" src="/img/icon_components.svg" width="200" height="140" alt="2 icon">
                    <h2 class="uk-margin-remove">Фишка 2</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.</p>
                </div>
                <div>
                    <img class="ss-preview-icon" src="/img/icon_themes.svg" width="200" height="140" alt="3 icon">
                    <h2 class="uk-margin-remove">Фишка 3</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.</p>
                </div>
                <div>
                    <img class="ss-preview-icon" src="/img/icon_responsive.svg" width="200" height="140" alt="4 icon">
                    <h2 class="uk-margin-remove">Фишка 4</h2>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.</p>
                </div>
            </div>

        </div>
    </div>

    <div class="uk-section uk-section-default uk-text-center">
        <div class="uk-container">

            <h3>Тут еще ахуенный блок</h3>

            <div class="uk-grid-match uk-child-width-1-3@m" uk-grid>
                <div>
                    <div class="uk-card uk-card-default uk-card-hover uk-card-body">
                        <div class="uk-card-badge uk-label">Badge</div>
                        <h3 class="uk-card-title">Default</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                    </div>
                </div>
                <div>
                    <div class="uk-card uk-card-default uk-card-hover uk-card-body">
                        <div class="uk-card-badge uk-label">Badge</div>
                        <h3 class="uk-card-title">Default</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                    </div>
                </div>
                <div>
                    <div class="uk-card uk-card-default uk-card-hover uk-card-body">
                        <div class="uk-card-badge uk-label">Badge</div>
                        <h3 class="uk-card-title">Default</h3>
                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                    </div>
                </div>
            </div>

        </div>
    </div>

<?php $this->stop(); ?>

<?php $this->start('script'); ?>
<?php if (null !== $flash = old('flash')) : ?>
    <script>
      UIkit.notification({
        message: '<?php echo e($flash); ?>',
        status: 'danger',
        pos: 'top-center',
        timeout: 5000
      });
    </script>
<?php endif; ?>
<?php $this->stop(); ?>