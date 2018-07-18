<?php

namespace CatalinMoiceanu\XmlBuilder\Contract;

interface NodeInterface
{
    /**
     * @param string $name
     */
    public function __construct(string $name);

    /**
     * @return string
     */
    public function getName() : string;

    /**
     * @return mixed
     */
    public function getValue();

    /**
     * @param NodeInterface $node
     * @return bool
     */
    public function equals(NodeInterface $node) : bool;
}