<?php
/**
 * Shared layout template for LR1 variant task pages
 *
 * Features:
 * - Fixed compact header (50px)
 * - Test status in header
 * - Back button to index
 *
 * Usage:
 *   $config = require __DIR__.'/config.php';
 *   require_once __DIR__.'/tasks/taskX.php';
 *   $content = '...HTML...';
 *   require dirname(__DIR__).'/shared/layout.php';
 *   renderLayout($content, $config);
 */

// Use global test helper
require_once dirname(__DIR__, 3) . '/shared/helpers/test_helper.php';

/**
 * Renders compact header status HTML
 */
function renderHeaderStatus(array $results): string
{
    $statusConfig = [
        'passed' => ['icon' => '✅', 'text' => 'Виконано', 'class' => 'header-status-passed'],
        'not_implemented' => ['icon' => '❌', 'text' => 'Не виконано', 'class' => 'header-status-failed'],
        'partial' => ['icon' => '⚠️', 'text' => 'Частково', 'class' => 'header-status-partial'],
        'no_tests' => ['icon' => '❓', 'text' => 'Немає тестів', 'class' => 'header-status-failed'],
    ];

    $config = $statusConfig[$results['status']] ?? $statusConfig['no_tests'];
    $score = $results['total'] > 0 ? "{$results['passed']}/{$results['total']}" : '';
    $percent = $results['total'] > 0 ? round(($results['passed'] / $results['total']) * 100) . '%' : '';

    return "<div class='header-status {$config['class']}'>"
        . "<span class='header-status-icon'>{$config['icon']}</span>"
        . "<span>{$config['text']}</span>"
        . ($score ? "<span class='header-status-score'>{$score} {$percent}</span>" : '')
        . "</div>";
}

/**
 * Renders the full page layout with fixed header
 */
function renderLayout(string $content, array $config): void
{
    $variantName = $config['variantName'] ?? "Варіант";
    $lab = $config['lab'] ?? 'lr1';
    $labName = $config['labName'] ?? 'ЛР1';
    $tasks = $config['tasks'] ?? [];
    $variantPath = $config['variantPath'] ?? __DIR__;
    $currentTask = $config['currentTask'] ?? basename($_SERVER['SCRIPT_NAME']);

    $taskInfo = $tasks[$currentTask] ?? ['name' => 'Завдання', 'test' => null];
    $taskName = $taskInfo['name'];

    // Extract task number for display
    $taskNum = '';
    if (preg_match('/(\d+(?:\.\d+)?)/', $taskName, $matches)) {
        $taskNum = "Завд. {$matches[1]}";
    }

    // Run tests automatically
    $testResults = ['status' => 'no_tests', 'passed' => 0, 'failed' => 0, 'total' => 0, 'details' => []];
    if (isset($taskInfo['test'])) {
        $testResults = runTaskTests($taskInfo['test'], $variantPath);
    }

    // Path to shared styles
    $sharedPath = '../shared';
    ?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($taskName) ?> — <?= htmlspecialchars($labName) ?>, <?= htmlspecialchars($variantName) ?></title>
    <link rel="stylesheet" href="<?= $sharedPath ?>/style.css">
</head>
<body class="body-with-header">
    <header class="header-fixed">
        <div class="header-left">
            <a href="/" class="header-btn">Головна</a>
            <a href="javascript:history.back()" class="header-btn">← Назад</a>
        </div>
        <div class="header-center">
            <?= renderHeaderStatus($testResults) ?>
        </div>
        <div class="header-right">
            <?= htmlspecialchars($variantName) ?><?= $taskNum ? " / {$taskNum}" : '' ?>
        </div>
    </header>

    <div class="content-wrapper">
        <?= $content ?>
    </div>

    <?php if (!empty($testResults['details'])): ?>
    <details class="test-details" style="max-width:900px;margin:20px auto;">
        <summary>Деталі тестів (<?= $testResults['passed'] ?>/<?= $testResults['total'] ?>)</summary>
        <ul class="test-list">
            <?php foreach ($testResults['details'] as $detail): ?>
            <li class="<?= $detail['passed'] ? 'test-item-passed' : 'test-item-failed' ?>">
                <span><?= $detail['passed'] ? '✓' : '✗' ?></span>
                <?= htmlspecialchars($detail['name']) ?>
                <?php if (!$detail['passed'] && $detail['error']): ?>
                <br><small class="test-error"><?= htmlspecialchars($detail['error']) ?></small>
                <?php endif; ?>
            </li>
            <?php endforeach; ?>
        </ul>
    </details>
    <?php endif; ?>
</body>
</html>
<?php
}
