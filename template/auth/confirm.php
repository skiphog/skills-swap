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
<?php var_dump($user) ?>
<?php $this->stop(); ?>