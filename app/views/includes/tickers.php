<?php

use App\models\Tickers;
use Core\Helpers;

$tickers = Tickers::tickersDisplay();


?>


<?php if($tickers): ?>
<section class="container-fluid">
    <div class="my-1">
        <div class="news_container">
            <div class="title">
                Breaking News
            </div>

            <ul>
                <?php foreach($tickers as $ticker): ?>
                <li>
                    <?= $ticker->content ?>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
    </div>
</section>
<?php endif; ?>
