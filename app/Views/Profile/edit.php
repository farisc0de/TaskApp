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
    <?= form_open("/profile/update"); ?>
    <div class="field">
        <label class="label" for="username">Username</label>
        <div class="control">
            <input class="input" type="text" name="username" id="username" value="<?= old('username', $user->username); ?>" />
        </div>
    </div>

    <div class="field">
        <label class="label" for="email">Email Address</label>
        <div class="control">
            <input class="input" type="email" name="email" id="email" value="<?= old('email', $user->email); ?>" />
        </div>
    </div>

    <button class="button is-primary" type="submit">Save</button>
    <a class="button is-danger" href="<?= site_url("/profile/show"); ?>">Cancle</a>

    <?= form_close() ?>
</div>

<?= $this->endSection(); ?>