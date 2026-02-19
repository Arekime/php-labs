<?php
/**
 * Завдання 6.2: 4 червоних квадрати на чорному тлі
 */
require_once __DIR__ . '/layout.php';

function generateRedSquares(int $n): string
{
    $html = "<div class='shapes-container shapes-container--black'>";

    for ($i = 0; $i < $n; $i++) {
        $size = 50;
        $top = mt_rand(5, 85);
        $left = mt_rand(5, 85);

        $html .= "<div style='
            position:absolute;
            top:{$top}%;
            left:{$left}%;
            width:{$size}px;
            height:{$size}px;
            background-color:#ef4444;
        '></div>";
    }

    $html .= "</div>";
    return $html;
}

$n = 4;
$squares = generateRedSquares($n);

$content = $squares . '
    <div class="circles-func">generateRedSquares(' . $n . ')</div>
    <div class="circles-counter">🟥 Квадратів: ' . $n . '</div>
    <p class="circles-info">Оновіть сторінку для нової композиції 🔄</p>';

renderVariantLayout($content, 'Завдання 6.2', 'task7-circles-body');