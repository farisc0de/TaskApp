<?= $this->extend("base"); ?>

<?= $this->section("title"); ?>Login<?= $this->endSection(); ?>

<?= $this->section("content"); ?>

<h1 class="title">Login</h1>

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
    <?= form_open("/login/create"); ?>

    <div class="field">
        <label class="label" for="username">Username</label>
        <div class="control">
            <input class="input" type="text" name="username" id="username" value="<?= old('username'); ?>">
        </div>
    </div>

    <div class="field">
        <label class="label" for="password">Password</label>
        <div class="control">
            <input class="input" type="password" name="password" id="password" value="">
        </div>
    </div>

    <div class="field">
        <div class="control">
            <label class="checkbox" for="remember_me">
                <input type="checkbox" name="remember_me" id="remember_me" <?php if (old('remember_me')) : ?>checked<?php endif; ?>> Remember Me
            </label>
        </div>
    </div>

    <button class="button is-primary" type="submit">Login</button>


    <a href="<?= site_url("/password/forget"); ?>">Forget Password ?</a>

    <?= form_close() ?>
</div>

<?= $this->endSection(); ?>