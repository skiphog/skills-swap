<!doctype html>
<html lang="ru">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="description" content="<?php echo $this->renderBlock('description'); ?>">
    <link rel="stylesheet" href="/css/app.css">
    <title><?php echo $this->renderBlock('title'); ?></title>
</head>
<body>
<div class="uk-offcanvas-content">
    <div class="uk-section-primary ss-section-second">
        <div uk-sticky class="uk-navbar-container uk-navbar-transparent">
            <div class="uk-container uk-container-expand">
                <nav class="uk-navbar" uk-navbar="align: right;delay-hide:200;offset:-15">
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
                            <?php else : ?>
                                <li>
                                    <a href="#">
                                        <img class="uk-border-circle" src="/img/avatar.jpg" width="40" height="40" alt="avatar">
                                        <span class="uk-text-middle ss-profile-name"><?php echo e(auth()->first_name); ?></span>
                                    </a>
                                    <div class="uk-navbar-dropdown ss-drop-profile">
                                        <ul class="uk-nav uk-navbar-dropdown-nav">
                                            <li><a href="#"><span uk-icon="cog"></span> <span class="uk-text-middle ss-profile-name">Профиль</span></a></li>
                                            <li><a href="#"><span uk-icon="home"></span><span class="uk-text-middle ss-profile-name">Mother</span></a></li>
                                            <li><a href="#"><span uk-icon="user"></span><span class="uk-text-middle ss-profile-name">Fucker</span></a></li>
                                            <li><a href="#"><span uk-icon="heart"></span><span class="uk-text-middle ss-profile-name">Ass</span></a></li>
                                            <li><a href="<?php echo url('/auth/logout'); ?>" onclick="return confirm('Вы уверены, что хотите выйти?')">Выход</a></li>
                                        </ul>
                                    </div>
                                </li>
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
    </div>
    <?php echo $this->renderBlock('content'); ?>
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
    <?php require dirname(__DIR__) . '/auth/modal.php' ?>
<?php endif; ?>

<script src="/js/app.js"></script>
<?php echo $this->renderBlock('script'); ?>
<?php if(auth()->isGuest()) : ?>
    <script src="/js/modal.js"></script>
<?php endif; ?>
</body>
</html>