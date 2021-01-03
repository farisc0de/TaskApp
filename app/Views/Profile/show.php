<?= $this->extend("base"); ?>

<?= $this->section("title"); ?>Show Profile<?= $this->endSection(); ?>

<?= $this->section("content"); ?>

<h1 class="title">Profile</h1>

<?php if ($user->profile_image) : ?>
    <img src="<?= site_url('/profile/image') ?>" width="200" height="200" alt="" />

    <div>
        <a class="button is-danger" href="/profileimage/delete">Delete Image</a>
    </div>
<?php else : ?>
    <img src="<?= site_url('/images/blank.jpg') ?>" width="200" height="200" alt="" />
<?php endif; ?>

<div class="content">
    <dl>
        <dt class="has-text-weight-bold">Username:</dt>
        <dd><?= esc($user->username); ?></dd>
        <dt class="has-text-weight-bold">Email Address:</dt>
        <dd><?= esc($user->email); ?></dd>
    </dl>
</div>

<a class="button is-link" href="<?= site_url('/profile/edit'); ?>">Edit</a>
<a class="button is-link" href="<?= site_url('/profile/editpassword'); ?>">Update Password</a>
<a class="button is-link" href="<?= site_url('/profileimage/edit'); ?>">Update Profile Image</a>

<?= $this->endSection(); ?>