<div id="auth" uk-modal>
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

                </li>
            </ul>
        </div>
    </div>
</div>