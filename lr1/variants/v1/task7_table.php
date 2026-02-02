<?php
$config = require __DIR__.'/config.php';
require_once __DIR__.'/tasks/task7.php';

$n = 8;
$chessboard = generateChessboard($n);

ob_start();
?>
<div style="text-align:center;">
    <h1 style="color:#333;margin-bottom:30px;">♟️ Шахова дошка <?= $n ?>×<?= $n ?></h1>
    <div class="params">generateChessboard(<?= $n ?>)</div>
    <?= $chessboard ?>
    <p class="info" style="margin-top:20px;">Біла клітинка (0,0) → чергування білих (#fff) та чорних (#000) клітинок</p>
</div>
<?php
$content = ob_get_clean();

require dirname(__DIR__).'/shared/layout.php';
renderLayout($content, $config);
