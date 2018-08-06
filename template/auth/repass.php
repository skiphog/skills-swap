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

            <h1>Привет Незнакомец <span uk-icon="icon: happy; ratio: 1.5"></span></span></h1>
            <p>Введие ствой email для восстановления доступа</p>

            <form class="auth-form" action="<?php echo url('/auth/repass'); ?>" method="post"
                data-callback="authRepass">
                <div class="uk-margin">
                    <div class="uk-inline uk-width-1-2@m">
                        <span class="uk-form-icon" uk-icon="icon: mail"></span>
                        <input class="uk-input"
                            type="text" name="email" placeholder="Почта" required>
                    </div>
                </div>

                <div class="uk-margin">
                    <button type="submit" class="uk-button uk-button-primary">Восстановить доступ</button>
                    <div uk-spinner class="uk-hidden"></div>
                </div>
                <hr class="uk-divider-icon">
            </form>

        </div>
    </div>

<?php $this->stop(); ?>