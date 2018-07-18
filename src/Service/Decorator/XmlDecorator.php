<?php

namespace CatalinMoiceanu\XmlBuilder\Service\Decorator;

use CatalinMoiceanu\XmlBuilder\Contract\NodeInterface;

class XmlDecorator
{
    /**
     * @param NodeInterface $object
     * @return string
     */
    public function decorate(NodeInterface $object) : string
    {
        return is_null($object->getValue()) ? $this->decorateNull($object) : $this->decorateValue($object);
    }

    /**
     * @param NodeInterface $object
     * @return string
     */
    private function decorateNull(NodeInterface $object) : string
    {
        return sprintf('<%s/>', $object->getName());
    }

    /**
     * @param NodeInterface $object
     * @return string
     */
    private function decorateValue(NodeInterface $object) : string
    {
        return sprintf('<%s>%s</%s>', $object->getName(), $this->getObjectValue($object), $object->getName());
    }

    /**
     * @param array $objects
     * @return null|string
     */
    private function decorateArray(array $objects) : ?string
    {
        $output = null;

        foreach ($objects as $object) {
            if ($object instanceof NodeInterface) {
                $output .= $this->decorate($object);
            }
        }

        return $output;
    }

    /**
     * @param NodeInterface $object
     * @return null|string
     */
    private function getObjectValue(NodeInterface $object) : ?string
    {
        $value = $object->getValue();

        if (is_array($value)) {
            return $this->decorateArray($value);
        }

        return $value ?: '0';
    }
}