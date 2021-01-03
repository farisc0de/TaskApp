<?= $this->extend("base"); ?>

<?= $this->section('title') ?>Delete Task<?= $this->endSection(); ?>

<?= $this->section('content') ?>

<h1 class="title">Delete the task</h1>

<p>Are you sure ?</p>

<?= form_open('/tasks/delete/' . $task->id); ?>
<button class="button is-primary" type="submit">Yes</button>
<a class="button is-danger" href="<?= site_url("/tasks/show/{$task->id}"); ?>">Cancle</a>
<?= form_close(); ?>

<?= $this->endSection() ?>