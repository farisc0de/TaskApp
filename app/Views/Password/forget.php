<?= $this->extend("base"); ?>

<?= $this->section("title"); ?>Forget Password<?= $this->endSection(); ?>

<?= $this->section("content"); ?>

<h1 class="title">Forget Password</h1>

<div class="container">
    <?= form_open("/password/process"); ?>
    <div class="field">
        <label class="label" for="email"></label>
        <div class="control">
            <input class="input" type="email" name="email" placeholder="Email" value="<?= old("email"); ?>">
        </div>
    </div>
    <button class="button is-primary" type="submit">Send</button>
    <?= form_close(); ?>
</div>

<?= $this->endSection(); ?>