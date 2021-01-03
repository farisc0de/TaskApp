<?= $this->extend("base"); ?>

<?= $this->section("title"); ?>Task<?= $this->endSection(); ?>

<?= $this->section("content"); ?>

<h1 class="title">Task</h1>

<a href="<?= site_url("/tasks"); ?>">&laquo; Back to index</a>

<div class="content">
    <dl>
        <dt class="has-text-weight-bold">ID</dt>
        <dd><?= $task->id; ?></dd>
        <dt class="has-text-weight-bold">Desc</dt>
        <dd><?= $task->description; ?></dd>
        <dt class="has-text-weight-bold">Created at</dt>
        <dd><?= $task->created_at->humanize(); ?></dd>
        <dt class="has-text-weight-bold">Updated at</dt>
        <dd><?= $task->updated_at->humanize(); ?></dd>
    </dl>
</div>
<a class="button is-link" href="<?= site_url("/tasks/edit/{$task->id}"); ?>">Edit task</a>
<a class="button is-danger" href="<?= site_url("/tasks/delete/{$task->id}"); ?>">Delete task</a>

<?= $this->endSection(); ?>