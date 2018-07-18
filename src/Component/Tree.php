<?php

namespace CatalinMoiceanu\XmlBuilder\Component;

use CatalinMoiceanu\XmlBuilder\Contract\NodeInterface;

class Tree extends Node
{
    /** @var array $nodes */
    private $nodes = [];

    /**
     * @return NodeInterface[]
     */
    public function getNodes(): array
    {
        return $this->nodes;
    }

    /**
     * @param NodeInterface $node
     * @return null|NodeInterface
     */
    public function getNode(NodeInterface $node): ?NodeInterface
    {
        return array_reduce($this->getNodes(), function ($carry, NodeInterface $item) use ($node) {
            if($item->equals($node)) {
                $carry = $item;
            }
            return $carry;
        });
    }

    /**
     * @param NodeInterface $node
     * @return bool
     */
    public function hasNode(NodeInterface $node)
    {
        return (bool) $this->getNode($node);
    }

    /**
     * @param NodeInterface $node
     * @return $this
     */
    public function addNode(NodeInterface $node)
    {
        $this->nodes[] = $node;

        return $this;
    }

    /**
     * @param NodeInterface|null $node
     * @return $this
     */
    public function removeNode(?NodeInterface $node = null)
    {
        $this->nodes = ($node !== null)
            ? array_filter($this->getNodes(), function (NodeInterface $item) use ($node) {
                return ! $item->equals($node);
            })
            : [];

        return $this;
    }

    /**
     * @return array
     */
    public function getValue()
    {
        return $this->getNodes();
    }
}