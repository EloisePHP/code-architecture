<?php

namespace Eloise\Architecture\Readers;

use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;

class PhpFileReader
{
    public function readPhpFilesFromDirectory(string $directory): array
    {
        $phpFiles = $this->getPhpFilesRecursively($directory);
        return $phpFiles;
    }

    private function getPhpFilesRecursively(string $directory): array
    {
        $phpFiles = [];
        $iterator = new RecursiveIteratorIterator(new RecursiveDirectoryIterator($directory));

        foreach ($iterator as $fileInfo) {
            if ($fileInfo->isFile() && $fileInfo->getExtension() === 'php') {
                $phpFiles[] = $fileInfo->getRealPath();
            }
        }

        return $phpFiles;
    }
}