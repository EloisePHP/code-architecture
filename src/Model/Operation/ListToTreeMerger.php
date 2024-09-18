<?php

namespace Eloise\Architecture\Models\Operations;

use Eloise\Architecture\Models\ListNode;
use Eloise\Architecture\Models\TreeNode;

class ListToTreeMerger
{
    // Function to convert ListNode to a TreeNode recursively
    public function listNodeToTreeNode(ListNode $node): TreeNode
    {
        $root = new TreeNode($node->val);

        // Recursively convert the rest of the list to a tree
        if ($node->next !== null) {
            $root->addChild($this->listNodeToTreeNode($node->next));
        }

        return $root;
    }

    // Function to merge two trees if they have a common node (recursively)
    public function mergeTrees(TreeNode $tree1, TreeNode $tree2): ?TreeNode
    {
        // If the root of both trees has the same value, we can merge
        if ($tree1->val === $tree2->val) {
            foreach ($tree2->children as $child) {
                $tree1->addChild($child);
            }
            return $tree1;
        }

        // Recursively attempt to merge in the children of tree1
        foreach ($tree1->children as $child) {
            $merged = $this->mergeTrees($child, $tree2);
            if ($merged !== null) {
                return $tree1;
            }
        }

        return null;
    }

    // Main function to iteratively merge list nodes into trees
    public function mergeAllNodes(array $listNodes): array
    {
        // Convert all ListNodes to TreeNodes
        $trees = array_map(fn($listNode) => $this->listNodeToTreeNode($listNode), $listNodes);

        $merged = true;

        // Continue merging until no more merges can be made
        while ($merged) {
            $merged = false;
            for ($i = 0; $i < count($trees); $i++) {
                for ($j = $i + 1; $j < count($trees); $j++) {
                    // Attempt to merge trees[i] and trees[j]
                    $mergedTree = $this->mergeTrees($trees[$i], $trees[$j]);

                    if ($mergedTree !== null) {
                        // If merged, remove the two trees and add the merged tree
                        unset($trees[$i], $trees[$j]);

                        // Re-index the array
                        $trees = array_values($trees);

                        // Add the merged tree back to the list
                        $trees[] = $mergedTree;

                        // Mark that a merge happened and break out to continue merging
                        $merged = true;
                        break 2;
                    }
                }
            }
        }

        return $trees;
    }
}