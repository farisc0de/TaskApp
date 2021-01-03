<?= $this->extend("base"); ?>

<?= $this->section("title"); ?>Task<?= $this->endSection(); ?>

<?= $this->section("content"); ?>

<h1 class="title">Tasks</h1>

<div class="mb-4">
    <a class="button is-link" href="<?= site_url('/tasks/new'); ?>">Add a task</a>
</div>

<div class="field">
    <label class="label" for="query">Search</label>
    <div class="control">
        <input class="input" name="query" id="query" />
    </div>
</div>
<div class="content">
    <?php if ($tasks) : ?>
        <ul>
            <?php foreach ($tasks as $task) : ?>
                <li><a href="<?= site_url('/tasks/show/' . $task->id); ?>">
                        <?= $task->description; ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
        <?= $pages->simpleLinks(); ?>
    <?php else : ?>
        <p class="is-medium">There are no tasks</p>
    <?php endif; ?>
</div>

<script src="<?= site_url('/js/auto-complete.min.js') ?>"></script>

<script>
    var searchUrl = "<?= site_url('/tasks/search?q=') ?>";
    var showTask = "<?= site_url('/tasks/show/') ?>";
    var data;
    var i;

    var searchAutoComplete = new autoComplete({
        selector: 'input[name="query"]',
        cache: false,
        source: function(term, response) {
            var request = new XMLHttpRequest();

            request.open('GET', searchUrl + term, true);

            request.onload = function() {
                data = JSON.parse(this.response);

                i = 0;

                var suggestion = data.map(task => task.description);

                response(suggestion);
            };

            request.send();
        },
        renderItem: function(item, search) {
            var id = data[i].id;

            i++;

            return '<div class="autocomplete-suggestion" data-id="' + id + '">' + item + '</div>';
        },
        onSelect: function(e, term, item) {
            window.location.href = showTask + item.getAttribute('data-id');
        }
    });
</script>

<?= $this->endSection(); ?>