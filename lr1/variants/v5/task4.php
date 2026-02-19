<?php
/**
 * Завдання 3: Визначення сезону (if-else)
 *
 * Місяць 5 → "весна"
 */
require_once __DIR__ . '/layout.php';

function determineSeason(int $month): string
{
    if ($month >= 3 && $month <= 5) {
        return "весна";
    } elseif ($month >= 6 && $month <= 8) {
        return "літо";
    } elseif ($month >= 9 && $month <= 11) {
        return "осінь";
    } else {
        return "зима";
    }
}

// Вхідні дані (варіант 5)
$month = 5;

$season = determineSeason($month);

$monthNames = [
    1 => "Січень", 2 => "Лютий", 3 => "Березень",
    4 => "Квітень", 5 => "Травень", 6 => "Червень",
    7 => "Липень", 8 => "Серпень", 9 => "Вересень",
    10 => "Жовтень", 11 => "Листопад", 12 => "Грудень"
];

$styles = [
    "весна" => ["class" => "spring", "color" => "#10b981", "emoji" => "🌸"],
    "літо" => ["class" => "summer", "color" => "#f59e0b", "emoji" => "☀️"],
    "осінь" => ["class" => "autumn", "color" => "#f97316", "emoji" => "🍂"],
    "зима" => ["class" => "winter", "color" => "#3b82f6", "emoji" => "❄️"],
];

$style = $styles[$season];

$content = '<div class="card large">
    <div class="season-emoji">' . $style['emoji'] . '</div>
    <div class="season-month" style="color:' . $style['color'] . '">Місяць ' . $month . '</div>
    <div class="season-month-name">' . $monthNames[$month] . '</div>
    <div class="season-result">' . $season . '</div>
    <p class="info">determineSeason(' . $month . ') = "' . $season . '"</p>
</div>';

renderVariantLayout($content, 'Завдання 3', 'task3-body ' . $style['class']);
