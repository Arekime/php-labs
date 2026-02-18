<?php
/**
 * Завдання 1: Форматований текст
 *
 * Вірш про художника з форматуванням: <b>, <i>, margin-left
 */
require_once __DIR__ . '/layout.php';

ob_start();
?>
<div class="poem">
    <?php
    echo '<div style="margin-left: 40px; font-fanily: sans-serif; line-height: 1.6;">';
    echo 'У саду цвітуть <b>вишні</b>. білі,<br>';
    echo 'Бджоли гудуть <i>весело</i> навеоло.<br>';
    echo 'Пелюстки падають несміливі,<br>';
    echo 'весна прийшла у наше село.';
    echo '</div>';
    ?>
</div>
<?php
$content = ob_get_clean();

renderVariantLayout($content, 'Завдання 1', 'task2-body');
