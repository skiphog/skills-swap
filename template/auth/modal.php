<div id="auth" class="auth" uk-modal>
    <div class="uk-modal-dialog">
        <button class="uk-modal-close-default" type="button" uk-close></button>
        <div class="uk-modal-body">
            <ul id="auth-switch" uk-tab class="uk-tab uk-child-width-expand">
                <li class="uk-active"><a href="#">Войти</a></li>
                <li>
                    <a href="#"><span class="uk-visible@s">Создать профиль</span><span class="uk-hidden@s">Регистрация</span></a>
                </li>
            </ul>

            <ul class="uk-switcher uk-margin">
                <li class="uk-active">
                    <form class="auth-form" action="<?php echo url('/auth/login'); ?>" method="post" data-callback="authLogin">
                        <div class="uk-margin">
                            <div class="uk-inline uk-width-1-1">
                                <span class="uk-form-icon" uk-icon="icon: mail"></span>
                                <input class="uk-input" type="email" name="email" placeholder="Электронная почта" required>
                            </div>
                            <div class="ss-form-error"></div>
                        </div>

                        <div class="uk-margin">
                            <div class="uk-inline uk-width-1-1">
                                <span class="uk-form-icon" uk-icon="icon: unlock"></span>
                                <input class="uk-input" type="password" name="password" placeholder="Пароль" required>
                            </div>
                            <div class="ss-form-error"></div>
                        </div>

                        <div class="uk-margin">
                            <label class="ss-hovered">
                                <input class="uk-checkbox" type="checkbox" name="remember" checked>
                                Запомнить меня
                            </label>
                            <div class="ss-form-error"></div>
                        </div>

                        <div class="uk-margin">
                            <button type="submit" class="uk-button uk-button-primary">Войти</button>
                            <div uk-spinner class="uk-hidden"></div>
                        </div>
                        <hr class="uk-divider-icon">
                        <div class="uk-text-center">
                            <a class="uk-text-muted uk-text-bold" href="<?php echo url('/auth/repass'); ?>">Забыли пароль?</a>
                        </div>
                    </form>
                </li>
                <li>
                    <form class="auth-form" action="<?php echo url('/auth/registration'); ?>" method="post" data-callback="authRegistration">
                        <div class="uk-margin">
                            <label class="uk-form-label ss-model-label" for="first_name">Имя</label>
                            <div class="uk-inline uk-width-1-1">
                                <span class="uk-form-icon" uk-icon="icon: user"></span>
                                <input id="first_name" class="uk-input" type="text" name="first_name">
                            </div>
                            <div class="ss-form-error"></div>
                        </div>

                        <div class="uk-margin">
                            <label class="uk-form-label ss-model-label" for="email">Электронная почта</label>
                            <div class="uk-inline uk-width-1-1">
                                <span class="uk-form-icon" uk-icon="icon: mail"></span>
                                <input id="email" class="uk-input" type="email" name="email" required>
                            </div>
                            <div class="ss-form-error"></div>
                        </div>

                        <div class="uk-margin">
                            <label class="ss-hovered">
                                <input class="uk-checkbox" type="checkbox" name="confirm" checked required>
                                Я согласен на <a>обработку моих персональных данных</a>
                            </label>
                            <div class="ss-form-error"></div>
                        </div>

                        <div class="uk-margin">
                            <button type="submit" class="uk-button uk-button-primary">Зарегистрироваться</button>
                            <div uk-spinner class="uk-hidden"></div>
                        </div>
                        <hr class="uk-divider-icon">
                        <div class="uk-text-center">
                            Войдите через <a class="uk-text-muted uk-text-bold" href="#">Facebook</a> или
                            <a class="uk-text-muted uk-text-bold" href="#">Google</a>
                        </div>
                    </form>
                </li>
            </ul>
        </div>
    </div>
</div>