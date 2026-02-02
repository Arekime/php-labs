<?php
/**
 * Завдання 2: Виведення форматованого тексту
 *
 * Демонстрація: echo, HTML-теги, стилі
 */
?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title>Завдання 2 — Вірш</title>
    <link rel="stylesheet" href="demo.css">
</head>
<body class="task2-body">
    <div class="back-button-container">
        <button onclick="window.location.href='index.php'" class="back-button">← До демо</button>
    </div>
    <div class="poem">
        <?php
        echo "<p>Полину в мріях в купель океану,</p>";
        echo "<p>Відчую <b>шовковистість</b> глибини,</p>";
        echo "<p>Чарівні мушлі з дна собі дістану,</p>";
        echo "<p class='poem-indent-1'>Щоб <i>взимку</i></p>";
        echo "<p class='poem-indent-2'>тішили</p>";
        echo "<p class='poem-indent-3'>мене</p>";
        echo "<p class='poem-indent-4'>вони…</p>";
        ?>
    </div>
</body>
</html>
