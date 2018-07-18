<?php

namespace CatalinMoiceanu\XmlBuilder\Service\Validator;

class ArrayValidator
{
    /**
     * @param array $node
     *
     * @throws \InvalidArgumentException
     */
    public function validate(array $node)
    {
        if (! isset($node['name'])) {
            throw new \InvalidArgumentException('Missing required node \'name\' key.');
        }

        if (! isset($node['value'])) {
            throw new \InvalidArgumentException('Missing required node \'value\' key.');
        }

        if (is_array($node['value']) && empty($node['value'])) {
            throw new \InvalidArgumentException('Invalid node declaration.');
        }

        if (is_array($node['value'])) {
            foreach ($node['value'] as $childNode) {
                $this->validateRootNode($childNode);
            }
        }
    }

    /**
     * @param array $node
     */
    public function validateRootNode(array $node)
    {
        if (! isset($node['node']) || ! is_array($node['node'])) {
            throw new \InvalidArgumentException('Invalid node declaration.');
        }
    }
}