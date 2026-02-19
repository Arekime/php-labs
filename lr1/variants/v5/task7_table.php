<?php
/**
 * Завдання 6.1: Таблиця 7x5 з випадковими кольорами
 */

require_once dirname(__DIR__, 3) . '/shared/helpers/dev_reload.php';

function generateRandomTable(int $rows, int $cols): string
{
    $html = "<table class='chessboard'>";
    for ($i = 0; $i < $rows; $i++) {
        $html .= "<tr>";
        for ($j = 0; $j < $cols; $j++) {
            $randomColor = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
            $html .= "<td style='background-color:{$randomColor}; width: 50px; height: 50px;'></td>";
        }
        $html .= "</tr>";
    }
    $html .= "</table>";
    return $html;
}

$rows = 7;
$cols = 5;

$table = generateRandomTable($rows, $cols);
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Завдання 6.1 — Кольорова таблиця</title>
    <link rel="stylesheet" href="../../demo/demo.css">
    <style>
        .chessboard {
            margin: 20px auto;
            border-collapse: collapse;
        }
        .chessboard td {
            border: 1px solid #ddd;
        }
    </style>
</head>
<body class="task7-table-body body-with-header">
    <header class="header-fixed">
        <div class="header-left">
            <a href="/" class="header-btn">Головна</a>
            <a href="index.php" class="header-btn">← Варіант 30</a>
            <a href="/lr1/demo/task7_table.php?from=v30" class="header-btn header-btn-demo">Demo</a>
        </div>
        <div class="header-center"></div>
        <div class="header-right">В-30 / Завд. 6.1</div>
    </header>

    <h1>🎨 Кольорова таблиця <?= $rows ?>x<?= $cols ?></h1>
    <div class="params">generateRandomTable(<?= $rows ?>, <?= $cols ?>)</div>

    <?= $table ?>

    <?= devReloadScript() ?>
</body>
</html>