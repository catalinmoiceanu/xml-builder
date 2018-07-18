<?php

namespace CatalinMoiceanu\XmlBuilder\Service\Converter;

use CatalinMoiceanu\XmlBuilder\Contract\NodeInterface;
use CatalinMoiceanu\XmlBuilder\Contract\ConverterInterface;
use CatalinMoiceanu\XmlBuilder\Service\Decorator\XmlDecorator;

class ConvertToXml implements ConverterInterface
{
    /** @var NodeInterface $input */
    private $input;
    /** @var XmlDecorator $decorator */
    private $decorator;

    /**
     * @param NodeInterface $input
     * @param XmlDecorator|null $decorator
     */
    public function __construct(NodeInterface $input, XmlDecorator $decorator = null)
    {
        $this->input = $input;
        $this->decorator = $decorator ?: new XmlDecorator();
    }

    /**
     * @return string
     */
    public function convert() : string
    {
        return $this->decorator->decorate($this->input);
    }
}