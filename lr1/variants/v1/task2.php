<?php
$config = require __DIR__.'/config.php';
require_once __DIR__.'/tasks/task2.php';

$content = '<div class="poem">'.generatePoem().'</div>';

require dirname(__DIR__).'/shared/layout.php';
renderLayout($content, $config);