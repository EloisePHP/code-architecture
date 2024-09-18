<?php

namespace Eloise\Architecture\Models;

class ListNode
{
    public function __construct(
        public $val = 0, 
        public ?ListNode $next = null
    ) {
    }

    public function getLastNode(): ListNode
    {
        $current = $this;
        while ($current->next !== null) {
            $current = $current->next;
        }
        return $current;
    }

    // Helper to print the list (for debugging)
    public function printList(): void
    {
        $current = $this;
        while ($current !== null) {
            echo $current->val . ' -> ';
            $current = $current->next;
        }
        echo "null\n";
    }
}