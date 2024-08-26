<?php

namespace Eloise\Architecture\Scripts;

use Eloise\Architecture\Readers\PhpFileReader;
use Eloise\Architecture\Tokenizers\Tokenizer;

class MainScript
{
    public function getClasses(string $directoryPath): array
    {
        $reader = new PhpFileReader();
        $phpFiles = $reader->readPhpFilesFromDirectory($directoryPath);

        $classes = [];
        foreach ($phpFiles as $file) {
            $tokenizer = new Tokenizer();
            $classes[] = $tokenizer->tokenizeFile($file);
        }

        return $classes;
    }
}