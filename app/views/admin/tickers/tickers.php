<?php

use Core\Helpers;
use Core\helpers\TimeFormat;

$this->total = $total;

?>

<?php $this->start('content'); ?>
<div class="d-flex align-items-center justify-content-between mb-3">
    <h2>Tickers</h2>
    <a href="<?= ROOT ?>admin/ticker/new" class="btn btn sm btn-primary">New Ticker</a>
</div>

<section class="table-responsive">
    <?php if ($tickers): ?>
    <?php foreach ($tickers as $key => $ticker): ?>
    <div class="card my-2">
        <div class="card-header">
            <h6 class="border-bottom d-inline">Status:
                <?php if($ticker->status === 'active'): ?>
                    <span class="text-uppercase text-success">
                        <?= $ticker->status ?>
                        <i class="bi bi-check-circle"></i>
                    </span>
                <?php else: ?>
                    <span class="text-uppercase text-danger align-content-center">
                        <?= $ticker->status ?>
                        <i class="bi bi-file-minus-fill"></i>
                    </span>
                <?php endif; ?>
            <span class="float-end"><i class="bi bi-clock"></i>
                        <?= TimeFormat::DateOne($ticker->created_at) ?>
                    </span>
            </h6>
        </div>
        <div class="card-body bg-light">
            <h4 class="fst-italic">
                <?= $ticker->content ?>
            </h4>
        </div>
        <div class="card-footer">
            <button onclick="editTicker('<?= $ticker->id ?>')" class="btn btn-sm btn-warning"><i class="bi bi-pencil-square"></i></button>
            <button onclick="confirmDelete('<?= $ticker->id ?>')" class="btn btn-sm btn-danger"><i class="bi bi-trash"></i></button>
        </div>
    </div>
    <?php endforeach; ?>
    <?= $this->partial('includes/pager'); ?>
        <?php else: ?>
        <h4 class="text-center text-danger border-bottom border-3 border-danger py-2">No Data available.</h4>
        <?php endif; ?>
</section>
<?php $this->end(); ?>

<?php $this->start('script') ?>
<script>
    function editTicker(tickerId) {
        window.location.href = `<?= ROOT ?>admin/ticker/${tickerId}`;
    }

    function confirmDelete(tickerId) {
        if (window.confirm("Are you sure you want to delete the ticker? This cannot be undone!")) {
            window.location.href = `<?= ROOT ?>admin/deleteTicker/${tickerId}`;
        }
    }
</script>
<?php $this->end(); ?>
