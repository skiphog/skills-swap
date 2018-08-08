<?php
/**
 * @var \Wardex\View\View      $this
 * @var \App\Models\Users\User $user
 */
?>
<?php $this->extend('layouts/app'); ?>

<?php $this->start('title'); ?>skills-swap<?php $this->stop(); ?>
<?php $this->start('description'); ?>skills-swap<?php $this->stop(); ?>

<?php $this->start('content'); ?>

    <div class="uk-section uk-section-primary uk-text-center ss-section-second">
        <div class="uk-container auth">

            <h1>Привет <?php echo e($user->first_name); ?> <span uk-icon="icon: happy; ratio: 1.5"></span></span></h1>
            <p>Придумайте пароль для входа</p>

            <form class="auth-form" action="<?php echo url('/auth/confirm'); ?>" method="post"
                    data-callback="authConfirm">
                <div class="uk-margin">
                    <div class="uk-inline uk-width-1-2@m">
                        <span class="uk-form-icon" uk-icon="icon: lock"></span>
                        <input class="uk-input"
                                type="text" name="password" placeholder="Пароль" autocomplete="off" required>
                    </div>
                    <div class="ss-form-error"></div>
                </div>

                <div class="uk-margin">
                    <label class="ss-hovered">
                        <input class="uk-checkbox" type="checkbox" name="remember" checked>
                        Запомнить меня
                    </label>
                </div>

                <div class="uk-margin">
                    <button type="submit" class="uk-button uk-button-primary">Войти</button>
                    <div uk-spinner class="uk-hidden"></div>
                </div>
                <hr class="uk-divider-icon">
                <input type="hidden" name="token" value="<?php echo request()->get('token'); ?>">
            </form>

        </div>
    </div>

<?php $this->stop(); ?>