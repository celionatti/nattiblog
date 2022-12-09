<?php

$this->total = $total;


?>

<?php $this->start('content') ?>
<div class="d-flex align-items-center justify-content-between mb-3">
    <h2>Advertisements</h2>
    <a href="<?= ROOT ?>admin/advertisement/new" class="btn btn sm btn-primary">New Advertisement</a>
</div>

<section class="table-responsive">
    <table class="table">
        <thead>
            <tr>
                <th>#</th>
                <th>Company</th>
                <th>Image</th>
                <th>Position</th>
                <th>Link</th>
                <th>Status</th>
                <th>Date</th>
                <th class="text-end">Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($advertisements as $key => $advertisement): ?>
            <tr>
                <td>
                    <?= $key + 1; ?>
                </td>
                <td>
                    <?= $advertisement->company ?>
                </td>
                <td>
                    <img src="<?= ROOT . $advertisement->img ?>" alt="<?= $advertisement->company ?>"
                        style="width: 50px; height: 50px;object-fit: cover;border-radius: 10px;">
                </td>
                <td>
                    <?= $advertisement->position ?>
                </td>
                <td>
                    <?= $advertisement->link ?>
                </td>
                <td>
                    <?= $advertisement->status ?>
                </td>
                <td>
                    <?= date("M j, Y ~ g:i a", strtotime($advertisement->created_at)) ?>
                </td>
                <td class="text-end">
                    <a href="<?= ROOT ?>admin/advertisement/<?= $advertisement->id ?>" class="btn btn-sm btn-info"><i
                            class="bi bi-pencil-square"></i></a>
                    <button class="btn btn-sm btn-danger" onclick="confirmDelete('<?= $advertisement->id ?>')"><i
                            class="bi bi-trash"></i></button>
                </td>
            </tr>
            <?php endforeach ?>
        </tbody>
    </table>
    <?= $this->partial('includes/pager'); ?>
</section>
<?php $this->end(); ?>

<?php $this->start('script') ?>
<script>
    function confirmDelete(adsId) {
        if (window.confirm("Are you sure you want to delete the advertisement? This cannot be undone!")) {
            window.location.href = `<?= ROOT ?>admin/deleteAdvertisement/${adsId}`;
        }
    }
</script>
<?php $this->end() ?>