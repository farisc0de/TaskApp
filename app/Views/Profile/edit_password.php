<?= $this->extend("base"); ?>

<?= $this->section("title"); ?>Update My Account<?= $this->endSection(); ?>

<?= $this->section("content"); ?>

<h1 class="title">Update My Password</h1>

<?php if (session()->has('errors')) : ?>
    <ul>
        <?php foreach (session('errors') as $error) : ?>
            <li><?= $error; ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<div class="container">
    <?= form_open("/profile/updatepassword"); ?>

    <div class="field">
        <label class="label" for="current_password">Current Password</label>
        <div class="control">
            <input class="input" type="password" name="current_password" id="current_password" value="" />
        </div>
    </div>

    <div class="field">
        <label class="label" for="password">Password</label>
        <div class="control">
            <input class="input" type="password" name="password" id="password" value="" />
        </div>
    </div>

    <div class="field">
        <label class="label" for="password_confirmation">Password Confirmation</label>
        <div class="control">
            <input class="input" type="password" name="password_confirmation" id="password_confirmation" value="" />
        </div>
    </div>

    <button class="button is-primary" type="submit">Save</button>
    <a class="button is-danger" href="<?= site_url("/profile/show"); ?>">Cancle</a>

    <?= form_close() ?>

</div>
<?= $this->endSection(); ?>