<?= $this->extend('base.php') ?>

<?= $this->section('title') ?>Password reset<?= $this->endSection() ?>

<?= $this->section('content') ?>

<h1 class="title">Password reset</h1>

<p>Password reset successful.</p>

<div>
    <a class="button is-link" href="<?= site_url("/login") ?>">Login</a>
</div>

<?= $this->endSection() ?>