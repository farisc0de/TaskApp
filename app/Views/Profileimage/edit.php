<?= $this->extend("base"); ?>

<?= $this->section("title"); ?>Update My Profile Image<?= $this->endSection(); ?>

<?= $this->section("content"); ?>

<h1 class="title">Update My Profile Image</h1>

<?php if (session()->has('errors')) : ?>
    <ul>
        <?php foreach (session('errors') as $error) : ?>
            <li><?= $error; ?></li>
        <?php endforeach; ?>
    </ul>
<?php endif; ?>

<?= form_open_multipart("/profileimage/update"); ?>

<div class="file">
    <label class="file-label">
        <input class="file-input" type="file" name="image">
        <span class="file-cta">
            <span class="file-icon">
                <i class="fas fa-upload"></i>
            </span>
            <span class="file-label">
                Choose a file…
            </span>
        </span>
    </label>
</div>

<div class="field mt-4">
    <button class="button is-primary" type="submit">Save</button>
    <a class="button is-danger" href="<?= site_url("/profile/show"); ?>">Cancle</a>
</div>

<?= form_close() ?>

<?= $this->endSection(); ?>