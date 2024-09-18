<?php

namespace Eloise\Architecture\Models\Operations;

/**
 * This service helps to create a list of ListNodes from a list with mergeable ListNodes
 */
class ListNodeMerger
{
    public function mergeListsIfPossible(array $listNodes): array
    {
        $merged = false;
        
        for ($i = 0; $i < count($listNodes); $i++) {
            for ($j = 0; $j < count($listNodes); $j++) {
                if ($i !== $j) {
                    $l1 = $listNodes[$i];
                    $l2 = $listNodes[$j];

                    // Get the last node of l1
                    $lastNodeOfL1 = $l1->getLastNode();

                    // If the last node of l1 has the same value as the first node of l2, merge
                    if ($lastNodeOfL1->val === $l2->val) {
                        // Merge by attaching l2 to the last node of l1
                        $lastNodeOfL1->next = $l2->next;
                        
                        // Remove l2 from the array and continue
                        array_splice($listNodes, $j, 1);
                        
                        // Set the flag indicating a merge happened
                        $merged = true;
                        break 2; // Break out of both loops after merging
                    }
                }
            }
        }

        return [$listNodes, $merged];
    }

    // Main function to repeatedly merge until no more merges are possible
    public function mergeAllNodes(array $listNodes): array
    {
        do {
            list($listNodes, $merged) = $this->mergeListsIfPossible($listNodes);
        } while ($merged);

        return $listNodes;
    }
}