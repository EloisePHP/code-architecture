<?php

namespace Eloise\Architecture\Models;

class TreeNode
{
    public $val;
    public array $children = [];

    public function __construct($val)
    {
        $this->val = $val;
    }

    public function addChild(TreeNode $child): void
    {
        $this->children[] = $child;
    }

    public function printTree($level = 0): void
    {
        echo str_repeat("  ", $level) . $this->val . PHP_EOL;
        foreach ($this->children as $child) {
            $child->printTree($level + 1);
        }
    }
}
