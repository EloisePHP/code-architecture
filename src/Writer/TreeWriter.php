<?php

namespace Eloise\Architecture\Writers;

use Eloise\Architecture\Models\Operations\ListNodeMerger;
use Eloise\Architecture\Models\Operations\ListNodeOperations;
use Eloise\Architecture\Models\Operations\ListToTreeMerger;

class TreeWriter
{
    public function getTreeFromListOfListNodes($nodeDetails)
    {
        $merger = new ListNodeMerger();
        $mergedNodes = $merger->mergeAllNodes($nodeDetails);
        $reversedNodes = [];
        $operation = new ListNodeOperations();
        foreach($mergedNodes as $node) {
            $reversedNodes[] = $operation->reverseList($node);
        }
        $treeOperations = new ListToTreeMerger();
        $trees = $treeOperations->mergeAllNodes($reversedNodes);
        
        return $trees;
    }
}