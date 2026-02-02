<?php
/**
 * Demo Index Page
 * Shows task cards (NO Demo link - this IS the demo)
 */

require_once dirname(__DIR__, 2) . '/shared/templates/task_cards.php';

$tasks = [
    'task2.php' => ['name' => 'Завдання 2'],
    'task3.php' => ['name' => 'Завдання 3'],
    'task4.php' => ['name' => 'Завдання 4'],
    'task5.php' => ['name' => 'Завдання 5'],
    'task6.php' => ['name' => 'Завдання 6'],
    'task7_table.php' => ['name' => 'Завдання 7.1'],
    'task7_squares.php' => ['name' => 'Завдання 7.2'],
];
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Демо — ЛР1</title>
    <link rel="stylesheet" href="demo.css">
</head>
<body class="index-page">
    <header class="header-fixed">
        <div class="header-left">
            <a href="/" class="header-btn">Головна</a>
            <a href="javascript:history.back()" class="header-btn">← Назад</a>
        </div>
        <div class="header-center"></div>
        <div class="header-right">
            Демо
        </div>
    </header>

    <h1 class="index-title">
        Демо
        <br><span class="index-subtitle">Приклади виконаних завдань</span>
    </h1>

    <?= renderTaskCards($tasks, false, '') ?>
</body>
</html>
