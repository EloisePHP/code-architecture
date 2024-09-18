<?php

namespace Eloise\Architecture\Builders;

use Eloise\Architecture\Models\ListNode;

class NodeBuilder
{
    public function __construct(
        protected array $classProperties
    ) {
    }

    public function toNode(): ListNode
    {
        $node = new ListNode($this->classProperties['name']);
        if ($this->classProperties['parentClass']) {
            $node->next = new ListNode($this->classProperties['parentClass']);
        }
        return $node;
    }
}