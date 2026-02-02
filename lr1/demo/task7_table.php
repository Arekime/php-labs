<?php
/**
 * Завдання 7.1: Кольорова таблиця n×n
 *
 * Демонстрація: цикли for, функції, генерація HTML/CSS
 */

/**
 * Генерує HTML таблицю n×n з випадковими кольорами
 */
function generateColorTable(int $n): string
{
    $html = "<table class='chessboard'>";
    for ($i = 0; $i < $n; $i++) {
        $html .= "<tr>";
        for ($j = 0; $j < $n; $j++) {
            $color = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
            $html .= "<td style='background-color:$color;'></td>";
        }
        $html .= "</tr>";
    }
    $html .= "</table>";
    return $html;
}

// Параметри (demo)
$n = 5;

// Генеруємо таблицю
$table = generateColorTable($n);
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Завдання 7.1 — Кольорова таблиця</title>
    <link rel="stylesheet" href="demo.css">
</head>
<body class="task7-table-body">
    <div class="back-button-container">
        <button onclick="window.location.href='index.php'" class="back-button">← До демо</button>
    </div>
    <h1>🎨 Кольорова таблиця <?= $n ?>×<?= $n ?></h1>
    <div class="params">generateColorTable(<?= $n ?>)</div>

    <?= $table ?>

    <p class="info" style="color:rgba(255,255,255,0.8);margin-top:20px;">Оновіть сторінку для нових кольорів 🔄</p>
</body>
</html>
