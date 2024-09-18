<?php

namespace Eloise\Architecture\Builders;

use ReflectionClass;

class InterfaceInfoBuilder
{
    public function __construct(
        protected string $interfaceName
    ) {
    }

    public function toArray(): array
    {
        $reflector = new ReflectionClass($this->interfaceName);
        $methods = array_map(function ($method) {
            return $method->getName();
        }, $reflector->getMethods());

        return [
            'type' => 'interface',
            'name' => $this->interfaceName,
            'methods' => $methods,
        ];
    }
}