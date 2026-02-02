<?php
/**
 * Global test helper for all PHP labs
 * Used by: all labs (lr1, lr2, ...)
 * Include: require_once dirname(__DIR__, 2) . '/shared/helpers/test_helper.php';
 */

/**
 * Runs tests for a specific task and returns results
 *
 * @param string $taskName Task name (task2, task3, etc.)
 * @param string $variantPath Path to variant folder (e.g., __DIR__ from config.php)
 * @return array Test results with keys: passed, failed, total, details, status
 */
function runTaskTests(string $taskName, string $variantPath): array
{
    $results = [
        'passed' => 0,
        'failed' => 0,
        'total' => 0,
        'details' => [],
        'status' => 'unknown'
    ];

    $testFile = $variantPath . "/tests/test_{$taskName}.php";

    if (!file_exists($testFile)) {
        $results['status'] = 'no_tests';
        return $results;
    }

    $tests = require $testFile;

    foreach ($tests as $functionName => $testCases) {
        foreach ($testCases as $test) {
            $testName = $test['name'];
            $testResult = ['name' => $testName, 'passed' => false, 'error' => null];

            try {
                if (!function_exists($functionName)) {
                    $testResult['error'] = "Function '$functionName' is not implemented";
                    $results['failed']++;
                } else {
                    $result = call_user_func_array($functionName, $test['input']);

                    if (isset($test['validator'])) {
                        $passed = $test['validator']($result);
                    } else {
                        $passed = $result === $test['expected'];
                    }

                    if ($passed) {
                        $testResult['passed'] = true;
                        $results['passed']++;
                    } else {
                        $expected = var_export($test['expected'], true);
                        $actual = var_export($result, true);
                        $testResult['error'] = "Expected: $expected, Got: $actual";
                        $results['failed']++;
                    }
                }
            } catch (Throwable $e) {
                $testResult['error'] = $e->getMessage();
                $results['failed']++;
            }

            $results['details'][] = $testResult;
        }
    }

    $results['total'] = $results['passed'] + $results['failed'];

    if ($results['total'] === 0) {
        $results['status'] = 'no_tests';
    } elseif ($results['failed'] === 0) {
        $results['status'] = 'passed';
    } elseif ($results['passed'] === 0) {
        $results['status'] = 'not_implemented';
    } else {
        $results['status'] = 'partial';
    }

    return $results;
}

/**
 * Generates HTML for test status display
 *
 * @param array $results Test results from runTaskTests()
 * @return string HTML
 */
function renderTestStatus(array $results): string
{
    $statusConfig = [
        'passed' => [
            'icon' => '✅',
            'text' => 'Task completed',
            'textUk' => 'Завдання виконано',
            'bg' => '#d1fae5',
            'border' => '#10b981'
        ],
        'not_implemented' => [
            'icon' => '❌',
            'text' => 'Task not completed',
            'textUk' => 'Завдання не виконано',
            'bg' => '#fee2e2',
            'border' => '#ef4444'
        ],
        'partial' => [
            'icon' => '⚠️',
            'text' => 'Task partially completed',
            'textUk' => 'Завдання частково виконано',
            'bg' => '#fef3c7',
            'border' => '#f59e0b'
        ],
        'no_tests' => [
            'icon' => '❓',
            'text' => 'No tests found',
            'textUk' => 'Тести не знайдено',
            'bg' => '#f3f4f6',
            'border' => '#9ca3af'
        ],
        'unknown' => [
            'icon' => '❓',
            'text' => 'Status unknown',
            'textUk' => 'Статус невідомий',
            'bg' => '#f3f4f6',
            'border' => '#9ca3af'
        ]
    ];

    $config = $statusConfig[$results['status']] ?? $statusConfig['unknown'];
    $percentage = $results['total'] > 0 ? round(($results['passed'] / $results['total']) * 100) : 0;

    // Use Ukrainian text
    $statusText = $config['textUk'];

    $html = "<div class='test-status-bar' style='background:{$config['bg']};border-left:4px solid {$config['border']};'>";
    $html .= "<div class='test-status-main'>";
    $html .= "<span class='test-status-icon'>{$config['icon']}</span>";
    $html .= "<span class='test-status-text'>{$statusText}</span>";
    $html .= "</div>";

    if ($results['total'] > 0) {
        $html .= "<div class='test-status-details'>";
        $html .= "<span class='test-badge test-badge-passed'>✓ {$results['passed']}</span>";
        if ($results['failed'] > 0) {
            $html .= "<span class='test-badge test-badge-failed'>✗ {$results['failed']}</span>";
        }
        $html .= "<span class='test-badge test-badge-total'>{$percentage}%</span>";
        $html .= "</div>";
    }

    $html .= "</div>";

    // Collapsible test details
    if (!empty($results['details'])) {
        $html .= "<details class='test-details'>";
        $html .= "<summary>Показати деталі тестів ({$results['passed']}/{$results['total']})</summary>";
        $html .= "<ul class='test-list'>";
        foreach ($results['details'] as $detail) {
            $icon = $detail['passed'] ? '✓' : '✗';
            $class = $detail['passed'] ? 'test-item-passed' : 'test-item-failed';
            $html .= "<li class='{$class}'><span>{$icon}</span> {$detail['name']}";
            if (!$detail['passed'] && $detail['error']) {
                $errorHtml = htmlspecialchars($detail['error']);
                $html .= "<br><small class='test-error'>{$errorHtml}</small>";
            }
            $html .= "</li>";
        }
        $html .= "</ul>";
        $html .= "</details>";
    }

    return $html;
}
