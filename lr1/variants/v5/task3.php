<?php
/**
 * Завдання 2: Конвертер валют (UAH → USD)
 *
 * 15600 грн → долари, курс 38.75
 */
require_once __DIR__ . '/layout.php';

function convertUahToUsd(float $uah, float $rate): float
{
    return round($uah / $rate, 2);
}

// Вхідні дані (варіант 5)
$uah = 15600;
$rate = 38.75;

$usd = convertUahToUsd($uah, $rate);

$content = '<div class="card">
    <h2>💵 Конвертер UAH → USD</h2>
    <p><strong>Курс:</strong> 1 USD = ' . $rate . ' грн</p>
    <div class="result">' . $uah . ' грн = ' . $usd . ' долар</div>
    <p class="info">convertUahToUsd(' . $uah . ', ' . $rate . ') = ' . $usd . '</p>
</div>';

renderVariantLayout($content, 'Завдання 2', 'task3-body');
