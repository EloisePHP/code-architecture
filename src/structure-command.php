<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Eloise\Architecture\Scripts\MainScript;

$directoryPath = __DIR__;
$script = new MainScript();
var_dump($script->getClasses($directoryPath));