<?php

namespace Eloise\Architecture\Scripts;

use Eloise\Architecture\Builders\ClassInfoBuilder;
use Eloise\Architecture\Builders\NodeBuilder;
use Eloise\Architecture\Models\Operations\ListNodeMerger;
use Eloise\Architecture\Models\Operations\ListNodeOperations;
use Eloise\Architecture\Models\Operations\ListToTreeMerger;
use Eloise\Architecture\Readers\PhpFileReader;
use Eloise\Architecture\Writers\TreeWriter;
use ReflectionClass;

class MainScript
{
    public function getClasses(string $directoryPath): array
    {
        $reader = new PhpFileReader();
        
        // Step 1: Get all declared classes and interfaces before loading the PHP files
        $beforeClasses = get_declared_classes();
        $beforeInterfaces = get_declared_interfaces();
        
        // Step 2: Get array of PHP file paths from the directory
        $phpFiles = $reader->readPhpFilesFromDirectory($directoryPath);
        
        // Step 3: Include the files to register their classes and interfaces
        foreach ($phpFiles as $file) {
            include_once $file;  // include_once to avoid redeclaration errors
        }
        
        // Step 4: Get all declared classes and interfaces after including the files
        $afterClasses = get_declared_classes();
        $afterInterfaces = get_declared_interfaces();
        
        // Step 5: Find the new classes and interfaces declared in the loaded files
        $newClasses = array_diff($afterClasses, $beforeClasses);
        $newInterfaces = array_diff($afterInterfaces, $beforeInterfaces);
        
        // Step 6: Optional - Inspect the newly declared classes and interfaces
        $classDetails = [];
        $nodeDetails = [];
        
        foreach ($newClasses as $className) {
            $builder = new ClassInfoBuilder($className);
            $classInfo = $builder->toArray();
            
            $classDetails[] = $classInfo;

            $builder = new NodeBuilder($classInfo);
            $nodeDetails[] = $builder->toNode();
        }

        // Step 7: Inspect interfaces (using ReflectionClass)
        $interfaceDetails = [];
        foreach ($newInterfaces as $interfaceName) {
            
        }

        // Step 8: Return the Tree
        $writer = new TreeWriter();
        return $writer->getTreeFromListOfListNodes($nodeDetails);
    }
}