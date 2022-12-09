<?php


use Core\Form;


?>

<?php $this->start('content') ?>
<div class="col-md-10 mx-auto my-4">
    <form action="" method="post" enctype="multipart/form-data">
        <h1 class="h3 mb-3 fw-normal text-center">
            <?= $header ?>
        </h1>
        <?= Form::csrfField(); ?>

            <div class="row">
                <div class="col">
                    <?= Form::inputField('Company', 'company', $advertisement->company ?? '', ['class' => 'form-control'],
                        ['class' => 'form-floating mb-3'], $errors); ?>
                </div>
                <div class="col">
                    <?= Form::inputField('Background Color', 'bgcolor', $advertisement->bgcolor ?? '', ['class' =>
                        'form-control'], ['class' => 'form-floating mb-3'], $errors); ?>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <?= Form::selectField('Object fit', 'objfit', $advertisement->objfit ?? '', $objOpts ?? [],
                        ['class' => 'form-control'], ['class' => 'form-floating mb-3'], $errors); ?>
                </div>
                <div class="col">
                    <?= Form::selectField('Position', 'position', $advertisement->position ?? '', $positionOpts ??
                        [], ['class' => 'form-control'], ['class' => 'form-floating mb-3'], $errors); ?>
                </div>
            </div>

            <div class="row">
                <div class="col">
                    <?= Form::selectField('Status', 'status', $advertisement->status ?? '', $statusOpts ?? [],
                        ['class' => 'form-control'], ['class' => 'form-floating mb-3'], $errors); ?>
                </div>
                <div class="col">
                    <?= Form::inputField('Link', 'link', $advertisement->link ?? '', ['class' => 'form-control', 'type'=>
                        'url'], ['class' => 'form-floating mb-3'], $errors); ?>
                </div>
            </div>

            <?= Form::fileField('Advertisement Image', 'img', ['class'=> 'form-control', 'onchange'=>
                "display_image_preview(this.files[0])"], ['class'=> 'col-md-12 mb-3'], $errors); ?>

                <div class="d-flex align-items-center justify-content-center mb-3">
                    <h5 class="mx-3">Current Advertisement Image: </h5>
                    <img src="<?= get_image($advertisement->img ?? '') ?>" alt=""
                        class="mx-auto d-block image-preview-preview"
                        style="height:150px;width:250px;object-fit:cover;border-radius: 10px;cursor: pointer;">
                </div>

                <div class="row">
                    <div class="col">
                        <a href="<?= ROOT ?>admin/advertisements" class="btn btn-warning w-100"><i
                                class="bi bi-arrow-left-circle"></i>
                            Back</a>
                    </div>
                    <div class="col">
                        <button type="submit" class="btn btn-dark w-100">Create Advert</button>
                    </div>
                </div>

    </form>
</div>
<?php $this->end(); ?>

<?php $this->start('script'); ?>
<script>
    function display_image_preview(file) {
        document.querySelector(".image-preview-preview").src = URL.createObjectURL(file);
    }
</script>
<?php $this->end(); ?>
