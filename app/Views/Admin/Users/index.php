<?= $this->extend("base"); ?>

<?= $this->section("title"); ?>Users<?= $this->endSection(); ?>

<?= $this->section("content"); ?>

<h1 class="title">Users</h1>

<a class="button is-link" href="<?= site_url('/admin/users/new'); ?>">Add a User</a>

<?php if ($users) : ?>
    <table class="table">
        <thead>
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th>Administrator</th>
                <th>Created at</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user) : ?>
                <tr>
                    <td>
                        <a href="<?= site_url('/admin/users/show/' . $user->id); ?>">
                            <?= $user->username; ?>
                        </a>
                    </td>
                    <td>
                        <?= $user->email; ?>
                    </td>
                    <td>
                        <?= $user->is_admin ? 'yes' : 'no'; ?>
                    </td>
                    <td>
                        <?= $user->created_at->humanize(); ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <?= $pages->simpleLinks(); ?>
<?php else : ?>
    <p>There are no users</p>
<?php endif; ?>

<?= $this->endSection(); ?>