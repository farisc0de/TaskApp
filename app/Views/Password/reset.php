<?= $this->extend("base"); ?>

<?= $this->section("title"); ?>Forget Password<?= $this->endSection(); ?>

<?= $this->section("content"); ?>

<h1 class="title">Reset Password</h1>

<?php if (session()->has('errors')) : ?>
    <ul>
        <?php foreach (session('errors') as $error) : ?>
            <li><?= $error; ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<div class="container">
    <?= form_open("/password/update/$token"); ?>
    <div class="field">
        <label class="label" for="password">Password</label>
        <div class="control">
            <input class="input" type="password" name="password" id="password" value="">
        </div>
    </div>

    <div class="field">
        <label class="label" for="password_confirmation">Password Confirmation</label>
        <div class="control">
            <input class="input" type="password" name="password_confirmation" id="password_confirmation" value="">

        </div>
    </div>

    <button class="button is-primary" type="submit">Reset Password</button>
    <?= form_close(); ?>
</div>

<?= $this->endSection(); ?>