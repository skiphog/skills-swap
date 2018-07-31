<?php
/**
 * @var \Wardex\View\View $this
 */
?>
<?php $this->extend('layouts/app'); ?>

<?php $this->start('title'); ?>skills-swap<?php $this->stop(); ?>
<?php $this->start('description'); ?>skills-swap<?php $this->stop(); ?>

<?php $this->start('content'); ?>

    <div class="uk-offcanvas-content ss-height-100">
        <div class="uk-section-primary ss-height-100 ss-theme-book">
            <div uk-sticky class="uk-navbar-container tm-navbar-container uk-navbar-transparent">
                <div class="uk-container uk-container-expand">
                    <nav class="uk-navbar">
                        <div class="uk-navbar-left">
                            <a href="/" class="uk-navbar-item uk-logo router-link-exact-active uk-active">
                                <img src="/img/logo.png" width="49" height="50" alt="Лого">
                            </a>
                        </div>
                        <div class="uk-navbar-right">
                            <ul class="uk-navbar-nav uk-visible@m">
                                <?php if (auth()->isGuest()) : ?>
                                    <li><a class="ss-auth" data-index="0">Войти</a></li>
                                    <li><a class="ss-auth" data-index="1">Создать профиль</a></li>
                                <?php endif; ?>
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

            <div class="ss-banner">
                <img class="ss-tm-baner" src="/img/swap.png" width="749" height="125" alt="Логотип">
                <div class="uk-container uk-text-center">
                    <div class="ss-button-book-group">
                        <a class="ss-auth uk-button ss-button-book uk-visible@s" data-index="0">Начать</a>
                        <a class="ss-auth uk-button ss-button-book uk-hidden@s" data-index="0">Начать</a>
                    </div>
                </div>
            </div>

        </div>

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

<?php if (auth()->isGuest()) : ?>
    <div id="auth" uk-modal>
        <div class="uk-modal-dialog">
            <button class="uk-modal-close-default" type="button" uk-close></button>
            <div class="uk-modal-body">
                <ul id="auth-switch" uk-tab class="uk-tab uk-child-width-expand">
                    <li class="uk-active"><a href="#">Войти</a></li>
                    <li><a href="#">Создать профиль</a></li>
                </ul>

                <ul class="uk-switcher uk-margin">
                    <li class="uk-active">
                        <form action="/registration">
                            <div class="uk-margin">
                                <div class="uk-inline">
                                    <span class="uk-form-icon" uk-icon="icon: mail"></span>
                                    <input class="uk-input uk-form-width-large" type="email" name="email" placeholder="" required>
                                </div>
                            </div>

                            <div class="uk-margin">
                                <div class="uk-inline">
                                    <span class="uk-form-icon" uk-icon="icon: unlock"></span>
                                    <input class="uk-input uk-form-width-large" type="text" name="password" placeholder="" required>
                                </div>
                            </div>

                            <div class="uk-margin">
                                <label><input class="uk-checkbox" type="checkbox" name="remember" checked> Запомнить меня</label>
                            </div>

                            <div class="uk-margin">
                                <button type="button" class="uk-button uk-button-primary">Войти</button>
                            </div>
                            <hr class="uk-divider-icon">
                            <div class="uk-text-center">
                                <a class="uk-text-muted uk-text-bold" href="#">Забыли пароль?</a>
                            </div>
                        </form>
                    </li>
                    <li>
                        Здесь блок с регистрацией
                    </li>
                </ul>
            </div>
        </div>
    </div>
<?php endif; ?>
<?php $this->stop(); ?>

<?php $this->start('script'); ?>
    <script>
      $('.ss-auth').on('click', function (e) {
        e.preventDefault();
        UIkit.switcher('#auth-switch').show(+$(this).data('index'));
        UIkit.modal('#auth').show();
      });
    </script>
<?php $this->stop(); ?>