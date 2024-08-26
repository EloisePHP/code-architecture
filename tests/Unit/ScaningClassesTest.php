<?php

namespace Eloise\Architecture\Tests;

use Eloise\Architecture\Scripts\MainScript;
use Eloise\Architecture\Tokenizers\Tokenizer;
use PHPUnit\Framework\TestCase;

class ScaningClassesTest extends TestCase {

    public function test_greet() {
        $directoryPath = __DIR__.'/../Fixtures';
        $script = new MainScript();
        $phpClasses = $script->getClasses($directoryPath);
        print_r($phpClasses);
    }
}
