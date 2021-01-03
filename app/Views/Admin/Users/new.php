<?= $this->extend("base"); ?>

<?= $this->section("title"); ?>Add new user<?= $this->endSection(); ?>

<?= $this->section("content"); ?>

<h1 class="title">Add new user</h1>

<?php if (session()->has('errors')) : ?>
    <ul>
        <?php foreach (session('errors') as $error) : ?>
            <li><?= $error; ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<div class="container">
    <?= form_open("/admin/users/create"); ?>

    <?= $this->include('/Admin/Users/form'); ?>

    <button class="button is-primary" type="submit">Save</button>
    <a class="button is-danger" href="<?= site_url("/admin/users"); ?>">Cancle</a>

    <?= form_close() ?>
</div>

<?= $this->endSection(); ?>