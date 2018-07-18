<?php

namespace CatalinMoiceanu\XmlBuilder\Component;

use CatalinMoiceanu\XmlBuilder\Contract\NodeInterface;

class Node implements NodeInterface
{
    /** @var string $name */
    private $name;
    /** @var mixed $value */
    private $value;

    /**
     * @param string $name
     */
    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * @param $value
     * @return $this
     */
    public function setValue($value)
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @param NodeInterface $node
     * @return bool
     */
    public function equals(NodeInterface $node) : bool
    {
        return $this === $node;
    }
}