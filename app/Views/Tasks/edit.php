<?= $this->extend("base"); ?>

<?= $this->section("title"); ?>Update a Task<?= $this->endSection(); ?>

<?= $this->section("content"); ?>

<h1 class="title">Update a Task</h1>

<?php if (session()->has('errors')) : ?>
    <ul>
        <?php foreach (session('errors') as $error) : ?>
            <li><?= $error; ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<div class="container">
    <?= form_open("/tasks/update/{$task->id}"); ?>

    <?= $this->include('Tasks/form'); ?>

    <button class="button is-primary" type="submit">Save</button>
    <a class="button is-danger" href="<?= site_url("/tasks/show/{$task->id}"); ?>">Cancle</a>

    <?= form_close() ?>
</div>
<?= $this->endSection(); ?>