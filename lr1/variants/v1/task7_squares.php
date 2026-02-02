<?php
$config = require __DIR__.'/config.php';
require_once __DIR__.'/tasks/task7.php';

$n = 12;
$circles = generateRandomCircles($n);

ob_start();
?>
<?= $circles ?>
<div class="circles-func">generateRandomCircles(<?= $n ?>)</div>
<div class="circles-counter">🟡 Кіл: <?= $n ?></div>
<p class="circles-info">Наведіть курсор на коло для анімації. Оновіть сторінку для нової композиції.</p>
<?php
$content = ob_get_clean();

require dirname(__DIR__).'/shared/layout.php';
renderLayout($content, $config);
