<?php

use Core\Form;
use Core\Helpers;
use Core\helpers\TimeFormat;

?>

<?php $this->start('content'); ?>
<h2> <?= $header ?> </h2>
<form action="" method="post" class="p-4 p-md-5 border rounded-3 bg-light">
    <?= Form::csrfField(); ?>

    <?= Form::textareaField('Content', 'content', $ticker->content ?? '', ['class' => 'form-control'], ['class' => 'form-floating mb-3'], $errors); ?>

    <?= Form::selectField('Status', 'status', $ticker->status ?? '', $ticker_status_opts ?? [], ['class' => 'form-control'], ['class' => 'form-floating mb-3'], $errors) ?>

    <p class="text-center mx-auto text-danger small fw-semibold border-top border-dark border-3 py-2">
        Note that only Ticker with relevant and consistence new can only be created. Thank you.
    </p>
    <div class="row">
        <div class="col">
            <a href="/admin/tickers" class="w-100 btn btn-lg btn-warning"><i class="bi bi-arrow-left-circle"></i>
                Back</a>
        </div>
        <div class="col">
            <button class="w-100 btn btn-lg btn-dark" type="submit">Create New Ticker</button>
        </div>
    </div>
</form>
<?php $this->end(); ?>
