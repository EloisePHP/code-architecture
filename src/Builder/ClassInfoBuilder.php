<?php

namespace Eloise\Architecture\Builders;

use ReflectionClass;

class ClassInfoBuilder
{
    public function __construct(
        protected string $className
    ) {
    }

    public function toArray(): array
    {
        $reflector = new ReflectionClass($this->className);

            $parentClass = $reflector->getParentClass();
            $parentClassName = $parentClass ? $parentClass->getName() : null;

            // Get implemented interfaces
            $implementedInterfaces = $reflector->getInterfaceNames();

            // Get class methods
            $methods = array_map(function ($method) {
                return $method->getName();
            }, $reflector->getMethods());

            $parentClassNonAbstractName = ($reflector->isAbstract()) ? null : $parentClassName;
            return [
                'type' => 'class',
                'name' => $this->className,
                'isAbstract' => $reflector->isAbstract(),
                //'isInterface' => $reflector->isInterface(),
                'parentClass' => $parentClassName,
                //'interfaces' => $implementedInterfaces,
                //'methods' => $methods,
            ];
    }
}