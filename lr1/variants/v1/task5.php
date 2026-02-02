<?php
$config = require __DIR__.'/config.php';
require_once __DIR__.'/tasks/task5.php';

$digit = 7;
$result = isEvenOrOdd($digit);
$isEven = $result === "парна";
$color = $isEven ? "#10b981" : "#ef4444";
$emoji = $isEven ? "✓" : "✗";
ob_start();
?>
<div class="card">
    <div class="digit-large" style="color:<?= $color ?>;">
        <?= $digit ?>
    </div>
    <div class="emoji" style="color:<?= $color ?>;"><?= $emoji ?></div>
    <div class="result-text" style="font-size:28px;">
        Цифра <strong><?= $digit ?></strong> — <span style="color:<?= $color ?>"><?= $result ?></span>
    </div>
    <p class="info">Функція: isEvenOrOdd(<?= $digit ?>) = "<?= $result ?>"</p>
</div>
<?php
$content = ob_get_clean();

require dirname(__DIR__).'/shared/layout.php';
renderLayout($content, $config);
