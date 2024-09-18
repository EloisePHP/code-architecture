<?php

namespace Eloise\Architecture\Models\Operations;

use Eloise\Architecture\Models\ListNode;

class ListNodeOperations
{
    // Function to reverse a linked list
    public function reverseList(?ListNode $head): ?ListNode
    {
        $prev = null;
        $current = $head;

        while ($current !== null) {
            $next = $current->next;
            $current->next = $prev;
            $prev = $current;
            $current = $next;
        }

        return $prev;
    }
}