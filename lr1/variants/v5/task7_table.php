<?php
/**
 * Завдання 6.1: Таблиця 7x5 з випадковими кольорами
 */
require_once __DIR__ . '/layout.php';

function generateRandomTable(int $rows, int $cols): string
{
    $html = "<table class='chessboard'>";
    for ($i = 0; $i < $rows; $i++) {
        $bgColor = sprintf('#%06X', mt_rand(0, 0xFFFFFF));
        $html .= "<tr>";
        for ($j = 0; $j < $cols; $j++) {
            $html .= "<td style='background-color:{$bgColor};'></td>";
        }
        $html .= "</tr>";
    }
    $html .= "</table>";
    return $html;
}

$rows = 7;
$cols = 5;

$table = generateRandomTable($rows, $cols);

$content = '
    <h1>🎨 Кольорова таблиця ' . $rows . 'x' . $cols . '</h1>
    <div class="params">generateRandomTable(' . $rows . ', ' . $cols . ')</div>
    ' . $table;

renderVariantLayout($content, 'Завдання 6.1', 'task7-table-body');