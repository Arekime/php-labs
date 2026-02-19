<?php
/**
 * Завдання 1: Форматований текст
 *
 * Вірш про вишні з форматуванням: <b>, <i>, margin-left
 */
require_once __DIR__ . '/layout.php';

ob_start();
?>
<div class="poem">
    <?php
    echo "<p class='poem-indent-1'>У саду цвітуть <b>вишні</b> білі,</p>";
    echo "<p class='poem-indent-1'>Бджоли гудуть <i>весело</i> навколо,</p>";
    echo "<p class='poem-indent-1'>Пелюстки падають несміливі,</p>";
    echo "<p class='poem-indent-1'>Весна прийшла у наше село.</p>";
    ?>
</div>
<?php
$content = ob_get_clean();

renderVariantLayout($content, 'Завдання 1', 'task2-body');
