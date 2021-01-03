<?= $this->extend("base"); ?>

<?= $this->section("title"); ?>Update a User<?= $this->endSection(); ?>

<?= $this->section("content"); ?>

<h1 class="title">Update a Task</h1>

<div class="container">
    <?= form_open("/admin/users/update/{$user->id}"); ?>

    <?= $this->include('/Admin/Users/form'); ?>

    <button class="button is-primary" type="submit">Save</button>
    <a class="button is-danger" href="<?= site_url("/admin/users/show/{$user->id}"); ?>">Cancle</a>

    <?= form_close() ?>
</div>

<?= $this->endSection(); ?>