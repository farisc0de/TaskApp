<?= $this->extend("base"); ?>

<?= $this->section("title"); ?>Update My Account<?= $this->endSection(); ?>

<?= $this->section("content"); ?>

<h1 class="title">Update My Account</h1>

<?php if (session()->has('errors')) : ?>
    <ul>
        <?php foreach (session('errors') as $error) : ?>
            <li><?= $error; ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<div class="container">
    <?= form_open("/profile/processauth"); ?>
    <div class="field">
        <label class="label" for="password">Password</label>
        <div class="control">
            <input class="input" type="password" name="password" id="password" />
        </div>
    </div>

    <button class="button is-primary" type="submit">Submit</button>
    <a class="button is-danger" href="<?= site_url("/profile/show"); ?>">Cancle</a>

    <?= form_close() ?>
</div>

<?= $this->endSection(); ?>