<?php

use App\models\Advertisements;

$partialAds = Advertisements::partialAdvertisement();


?>


<?php if ($partialAds): ?>
<section class="ads-container container border shadow">
    <img src="<?= get_image($partialAds->img ?? '', '') ?>" alt=""
        style="object-fit: <?= $partialAds->objfit ?>; background: <?= $partialAds->bgcolor ?>;">
</section>
<?php endif; ?>