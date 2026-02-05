<?php
/**
 * Shared layout template for LR1 demo task pages
 *
 * Features:
 * - Fixed compact header (50px)
 * - Link back to variant if came from one (?from=vN)
 * - Test status display
 *
 * Usage:
 *   require_once __DIR__.'/layout.php';
 *   $content = '...HTML...';
 *   renderDemoLayout($content, $taskName, $bodyClass);
 */

// Use global test helper
require_once dirname(__DIR__, 2) . '/shared/helpers/test_helper.php';

/**
 * Renders compact header status HTML
 */
function renderDemoHeaderStatus(array $results): string
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
 * Renders the full demo page layout with fixed header
 *
 * @param string $content HTML content for the page
 * @param string $taskName Task name for title (e.g., "Завдання 3")
 * @param string $bodyClass CSS class for body (e.g., "task3-body")
 * @param string|null $testName Test name to run (e.g., "task3"), null to skip tests
 */
function renderDemoLayout(string $content, string $taskName, string $bodyClass = '', ?string $testName = null): void
{
    // Check if came from a variant
    $fromVariant = $_GET['from'] ?? null;
    $currentTask = basename($_SERVER['SCRIPT_NAME']);

    // Build variant URL if came from one
    $variantUrl = null;
    if ($fromVariant && preg_match('/^v\d+$/', $fromVariant)) {
        $variantUrl = "/lr1/variants/{$fromVariant}/{$currentTask}";
    }

    // Run tests if test name provided
    $testResults = ['status' => 'no_tests', 'passed' => 0, 'failed' => 0, 'total' => 0, 'details' => []];
    if ($testName) {
        $testResults = runTaskTests($testName, __DIR__);
    }
    ?>
<!DOCTYPE html>
<html lang="uk">
<head>
    <meta charset="UTF-8">
    <title><?= htmlspecialchars($taskName) ?> — Демо ЛР1</title>
    <link rel="stylesheet" href="demo.css">
</head>
<body class="body-with-header <?= htmlspecialchars($bodyClass) ?>">
    <header class="header-fixed">
        <div class="header-left">
            <a href="/" class="header-btn">Головна</a>
            <a href="index.php<?= $fromVariant ? '?from=' . htmlspecialchars($fromVariant) : '' ?>" class="header-btn">← Демо</a>
            <?php if ($variantUrl): ?>
            <a href="<?= htmlspecialchars($variantUrl) ?>" class="header-btn header-btn-variant">← Варіант <?= htmlspecialchars(substr($fromVariant, 1)) ?></a>
            <?php endif; ?>
        </div>
        <div class="header-center">
            <?= renderDemoHeaderStatus($testResults) ?>
        </div>
        <div class="header-right">
            Демо<?php if (preg_match('/(\d+(?:\.\d+)?)/', $taskName, $m)): ?> / Завд. <?= $m[1] ?><?php endif; ?>
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
