<?php

use Core\Request;

$request = new Request();
$page = $request->get('page');
if (!$page || $page < 1)
    $page = 1;
$limit = $request->get('limit') ? $request->get('limit') : 25;
$totalPages = ceil($this->total / $limit);
$canBack = $page > 1;
$canForward = $page < $totalPages;
?>

<form action="" method="get" id="pagerForm" onsubmit="return false;">
    <div class="d-flex justify-content-center align-items-center my-5">
        <input type="hidden" id="page" name="page" value="<?= $page ?>" />
        <input type="hidden" name="limit" value="<?= $limit ?>" />

        <button class="btn btn-sm btn-primary" <?= $canBack ? "" : "disabled" ?> onclick="pager(<?= $page - 1 ?>)"> Prev
                    </button>
                    <div class="mx-3">
                        <?= $page ?> / <?= $totalPages ?>
                    </div>
                    <button class="btn btn-sm btn-primary" <?= $canForward ? "" : "disabled" ?> onclick="pager(<?= $page +
                            1 ?>)">Next</button>
    </div>
</form>

<script>
    function pager(page) {
        document.getElementById('page').value = page;
        var form = document.getElementById('pagerForm');
        form.submit();
    }
</script>