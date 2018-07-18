<?php

namespace CatalinMoiceanu\XmlBuilder\Service\Converter;

use CatalinMoiceanu\XmlBuilder\Contract\NodeInterface;
use CatalinMoiceanu\XmlBuilder\Contract\ConverterInterface;

class ConvertToTree implements ConverterInterface
{
    /** @var array $input */
    private $input;
    /** @var NodeInterface $output */
    private $output;

    public function __construct(array $input)
    {
        $this->input = $input;
    }

    public function convert()
    {
        return $this->output;
    }
}