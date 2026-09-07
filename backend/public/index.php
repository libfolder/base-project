<?php

declare(strict_types=1);

// Front controller: every HTTP request enters the application here.

// Autoload dependencies (Fat-Free Framework) and app classes.
require_once __DIR__ . '/../vendor/autoload.php';

$f3 = \Base::instance();

// Load configuration (globals, debug settings).
$f3->config(__DIR__ . '/../app/config/config.ini');

// Register routes.
$f3->config(__DIR__ . '/../app/config/routes.ini');

$f3->run();
