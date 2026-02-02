<?php
/**
 * Shared task cards component
 * Renders numbered task cards for index pages
 *
 * Usage:
 *   require_once dirname(__DIR__, 2) . '/shared/templates/task_cards.php';
 *   echo renderTaskCards($tasks, $showDemo, $demoUrl);
 */

/**
 * Renders task cards grid
 *
 * @param array $tasks Task configuration ['task2.php' => ['name' => 'Завдання 2', ...], ...]
 * @param bool $showDemo Whether to show Demo card (first card)
 * @param string $demoUrl URL for demo link
 * @return string HTML
 */
function renderTaskCards(array $tasks, bool $showDemo = true, string $demoUrl = ''): string
{
    $html = '<div class="task-cards">';

    // Demo card (first, only for variant pages)
    if ($showDemo && $demoUrl) {
        $html .= '<a href="' . htmlspecialchars($demoUrl) . '" class="task-card task-card-demo">Demo</a>';
    }

    // Task cards with numbers
    foreach ($tasks as $file => $info) {
        $label = extractTaskNumber($info['name']);
        $html .= '<a href="' . htmlspecialchars($file) . '" class="task-card">' . htmlspecialchars($label) . '</a>';
    }

    $html .= '</div>';
    return $html;
}

/**
 * Extract task number from name
 * "Завдання 2" -> "2"
 * "Завдання 7.1" -> "7.1"
 *
 * @param string $name Task name
 * @return string Number or original name
 */
function extractTaskNumber(string $name): string
{
    if (preg_match('/(\d+(?:\.\d+)?)/', $name, $matches)) {
        return $matches[1];
    }
    return $name;
}