<?= $this->extend("base"); ?>

<?= $this->section("title"); ?>User<?= $this->endSection(); ?>

<?= $this->section("content"); ?>

<h1 class="title">User</h1>

<a href="<?= site_url("/admin/users"); ?>">&laquo; Back to index</a>

<div class="content">
    <dl>
        <dt class="has-text-weight-bold">Username</dt>
        <dd><?= esc($user->username); ?></dd>

        <dt class="has-text-weight-bold">Email Address</dt>
        <dd><?= esc($user->email); ?></dd>

        <dt class="has-text-weight-bold">Administrator</dt>
        <dd><?= $user->is_admin ? 'yes' : 'no'; ?></dd>

        <dt class="has-text-weight-bold">Active</dt>
        <dd><?= $user->is_active ? 'yes' : 'no'; ?></dd>

        <dt class="has-text-weight-bold">Created at</dt>
        <dd><?= $user->created_at->humanize(); ?></dd>

        <dt class="has-text-weight-bold">Updated at</dt>
        <dd><?= $user->updated_at->humanize(); ?></dd>
    </dl>
</div>

<a class="button is-link" href="<?= site_url("/admin/users/edit/{$user->id}"); ?>">Edit user</a>

<?php if ($user->id != current_user()->id) : ?>
    <a class="button is-danger" href="<?= site_url("/admin/users/delete/{$user->id}"); ?>">Delete user</a>
<?php endif; ?>

<?= $this->endSection(); ?>