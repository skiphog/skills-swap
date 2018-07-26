<?php
/**
 * @var \Wardex\View\View $this
 */
?>
<?php $this->extend('layouts/app'); ?>

<?php $this->start('content'); ?>
<div class="uk-offcanvas-content">
    <div class="uk-section-primary ss-section-first">
        <div class="uk-navbar-container tm-navbar-container uk-navbar-transparent">
            <div class="uk-container uk-container-expand">
                <nav class="uk-navbar">
                    <div class="uk-navbar-left">
                        <a href="/" class="uk-navbar-item uk-logo router-link-exact-active uk-active">
                            <img src="/img/logo.png" width="49" height="50" alt="Лого">
                        </a>
                    </div>
                    <div class="uk-navbar-right">
                        <ul class="uk-navbar-nav uk-visible@m">
                            <li><a href="#">Войти</a></li>
                        </ul>
                        <a uk-navbar-toggle-icon uk-toggle href="#offcanvas"
                                class="uk-navbar-toggle uk-hidden@m uk-navbar-toggle-icon uk-icon">
                            <svg width="20" height="20" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                <rect y="9" width="20" height="2"></rect>
                                <rect y="3" width="20" height="2"></rect>
                                <rect y="15" width="20" height="2"></rect>
                            </svg>
                        </a>
                    </div>
                </nav>
            </div>
        </div>

        <!--<div class="uk-sticky-placeholder" style="height: 80px; margin: 0px;"></div>-->

        <div class="uk-section uk-section-small uk-flex uk-flex-middle uk-text-center">
            <div class="uk-width-1-1">
                <div class="uk-container">
                    <p>
                        <img src="/img/baner.png" width="741" height="121" alt="Логотип">
                    </p>
                    <p class="uk-margin-large uk-text-lead">
                        A mother fucker skills swap profession<br class="uk-visible@s">
                        for fucking some fucking people.
                    </p>

                    <div class="uk-flex-inline uk-flex-center uk-margin-large-bottom">
                        <a href="#" class="uk-button uk-button-primary ss-button-primary uk-button-large tm-button-large uk-visible@s">Get Started</a>
                        <a href="#" class="uk-button uk-button-primary ss-button-primary uk-hidden@s">Get Started</a>
                    </div>
                </div>
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

    <div class="uk-section uk-section-secondary uk-light ss-section-footer">
        <div class="uk-container">

            <h3>Footer</h3>

            <div class="uk-grid-match uk-child-width-1-3@m" uk-grid>
                <div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.</p>
                </div>
                <div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.</p>
                </div>
                <div>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor.</p>
                </div>
            </div>

        </div>
    </div>

    </div>
</div>
<?php $this->stop(); ?>
