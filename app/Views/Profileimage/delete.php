<?= $this->extend("base"); ?>

<?= $this->section('title') ?>Delete Image<?= $this->endSection(); ?>

<?= $this->section('content') ?>

<h1 class="title">Delete the Image</h1>

<p>Are you sure ?</p>

<?= form_open('/profileimage/delete'); ?>
<button class="button is-primary" type="submit">Yes</button>
<a class="button is-danger" href="<?= site_url("/profile/show"); ?>">Cancle</a>
<?= form_close(); ?>

<?= $this->endSection() ?>