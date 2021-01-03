<?= $this->extend("base"); ?>

<?= $this->section("title"); ?>Signup<?= $this->endSection(); ?>

<?= $this->section("content"); ?>

<h1 class="title">Signup</h1>

<?php if (session()->has('errors')) : ?>
    <ul>
        <?php foreach (session('errors') as $error) : ?>
            <li>
                <?= $error; ?>
            </li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<div class="container">
    <?= form_open("/signup/create"); ?>

    <div class="field">
        <label class="label" for="username">Username</label>
        <div class="control">
            <input class="input" type="text" name="username" id="username" value="<?= old('username'); ?>">
        </div>
    </div>

    <div class="field">
        <label class="label" for="email">Email</label>
        <div class="control">
            <input class="input" type="email" name="email" id="email" value="<?= old('email'); ?>">
        </div>
    </div>

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

    <div class="field">
        <button class="button is-primary" type="submit">Register</button>

        <a class="button is-danger" href="<?= site_url("/"); ?>">Cancle</a>
    </div>

    <?= form_close() ?>
</div>

<?= $this->endSection(); ?>