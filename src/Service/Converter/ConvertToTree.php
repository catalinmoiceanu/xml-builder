<?php

namespace CatalinMoiceanu\XmlBuilder\Service\Converter;

use CatalinMoiceanu\XmlBuilder\Component\Node;
use CatalinMoiceanu\XmlBuilder\Component\Tree;
use CatalinMoiceanu\XmlBuilder\Contract\ConverterInterface;
use CatalinMoiceanu\XmlBuilder\Service\Validator\ArrayValidator;

class ConvertToTree implements ConverterInterface
{
    /** @var array $input */
    private $input;
    /** @var ArrayValidator $validator */
    private $validator;
    /** @var Tree $output */
    private $output;

    /**
     * @param array $input
     * @param ArrayValidator $validator
     *
     * @throws \InvalidArgumentException
     */
    public function __construct(array $input, ?ArrayValidator $validator = null)
    {
        $this->input = $input;
        $this->validator = $validator ?: new ArrayValidator();
    }

    /**
     * @return null|Tree
     */
    public function convert() : ?Tree
    {
        $this->validator->validateRootNode($this->input);

        $this->output = $this->processNode($this->input['node']);
        return $this->output;
    }


    private function processNode(array $node)
    {
        $this->validator->validate($node);

        if (! is_array($node['value'])) {
            return (new Node($node['name']))->setValue($node['value']);
        }

        $tree = new Tree($node['name']);
        foreach ($node['value'] as $childNode) {
            $tree->addNode($this->processNode($childNode['node']));
        }

        return $tree;
    }
}