<?php

declare(strict_types=1);

require_once __DIR__ . '/../vendor/autoload.php';

foreach (glob(__DIR__ . '/Support/*.php') as $supportFile) {
    require_once $supportFile;
}
