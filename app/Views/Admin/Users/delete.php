<?= $this->extend("base"); ?>

<?= $this->section('title') ?>Delete User<?= $this->endSection(); ?>

<?= $this->section('content') ?>

<h1 class="title">Delete the user</h1>

<p>Are you sure ?</p>

<?= form_open('/admin/users/delete/' . $user->id); ?>
<button class="button is-primary" type="submit">Yes</button>
<a class="button is-danger" href="<?= site_url("/admin/users/show/{$user->id}"); ?>">Cancle</a>
<?= form_close(); ?>

<?= $this->endSection() ?>