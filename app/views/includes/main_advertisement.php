<?php

use App\models\Advertisements;

$mainAds = Advertisements::mainAdvertisement();


?>


<?php if ($mainAds): ?>
<section class="ads-container container border shadow">
    <img src="<?= get_image($mainAds->img ?? '', '') ?>" alt=""
        style="object-fit: <?= $mainAds->objfit ?>; background: <?= $mainAds->bgcolor ?>;">
</section>
<?php endif; ?>
