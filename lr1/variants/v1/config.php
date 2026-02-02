<?php
/**
 * Variant configuration for LR1, Variant 1
 *
 * This file contains all variant-specific settings.
 * Task files load this config and pass it to the shared layout.
 */

return [
    'variant' => 'v1',
    'variantName' => 'Варіант 1',
    'lab' => 'lr1',
    'labName' => 'ЛР1',
    'variantPath' => __DIR__,
    'tasks' => [
        'task2.php' => ['name' => 'Завдання 2', 'test' => 'task2'],
        'task3.php' => ['name' => 'Завдання 3', 'test' => 'task3'],
        'task4.php' => ['name' => 'Завдання 4', 'test' => 'task4'],
        'task5.php' => ['name' => 'Завдання 5', 'test' => 'task5'],
        'task6.php' => ['name' => 'Завдання 6', 'test' => 'task6'],
        'task7_table.php' => ['name' => 'Завдання 7.1', 'test' => 'task7'],
        'task7_squares.php' => ['name' => 'Завдання 7.2', 'test' => 'task7'],
    ],
];
