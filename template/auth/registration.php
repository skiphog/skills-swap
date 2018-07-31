<?php
/**
 * @var \Wardex\View\View $this
 */
?>
<?php $this->extend('layouts/app'); ?>

<?php $this->start('content'); ?>
    <div class="uk-container uk-margin-large-top">

        <div class="uk-card uk-card-default uk-card-body uk-background-muted">
            <ul id="sw" uk-tab class="uk-tab uk-child-width-expand">
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
                    </form>
                </li>
                <li>

                </li>
            </ul>
        </div>


    </div>
<?php $this->stop(); ?>