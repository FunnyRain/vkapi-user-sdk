<?php

// Cache
require_once __DIR__ . '/cache/Cache.php';

// Src
foreach (glob(__DIR__ . '/src/*') as $filename)
    require_once $filename;