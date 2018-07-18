<?php

namespace CatalinMoiceanu\XmlBuilder\Test\Service\Converter;

use CatalinMoiceanu\XmlBuilder\Component\Node;
use CatalinMoiceanu\XmlBuilder\Component\Tree;
use CatalinMoiceanu\XmlBuilder\Service\Converter\ConvertToXml;
use CatalinMoiceanu\XmlBuilder\Service\Decorator\XmlDecorator;
use PHPUnit\Framework\TestCase;

class ToXmlStringTest extends TestCase
{
    /**
     * @covers \CatalinMoiceanu\XmlBuilder\Service\Converter\ConvertToXml::__construct()
     */
    public function testConstructor()
    {
        $tree = new Tree('tree');
        $decorator = new XmlDecorator();
        $converter = new ConvertToXml($tree, $decorator);
        $this->assertInstanceOf(ConvertToXml::class, $converter);
    }

    /**
     * @covers \CatalinMoiceanu\XmlBuilder\Service\Converter\ConvertToXml::convert()
     */
    public function testConvertNode()
    {
        $node = new Node('node');
        $decorator = new XmlDecorator();
        $converter = new ConvertToXml($node, $decorator);

        $this->assertInternalType('string', $converter->convert());
        $this->assertEquals('<node/>', $converter->convert());

        $node->setValue('testValue');
        $this->assertEquals('<node>testValue</node>', $converter->convert());

        $node->setValue(false);
        $this->assertEquals('<node>0</node>', $converter->convert());

        $node->setValue(true);
        $this->assertEquals('<node>1</node>', $converter->convert());
    }

    /**
     * @covers \CatalinMoiceanu\XmlBuilder\Service\Converter\ConvertToXml::convert()
     */
    public function testConvertTree()
    {
        $tree = new Tree('tree');
        $decorator = new XmlDecorator();
        $converter = new ConvertToXml($tree, $decorator);

        $this->assertInternalType('string', $converter->convert());
        $this->assertEquals('<tree></tree>', $converter->convert());

        $node = new Node('node');
        $tree->addNode($node);
        $this->assertEquals('<tree><node/></tree>', $converter->convert());

        $tree->addNode($node);
        $this->assertEquals('<tree><node/><node/></tree>', $converter->convert());

        $node->setValue('Value');
        $tree->removeNode()->addNode($node);
        $this->assertEquals('<tree><node>Value</node></tree>', $converter->convert());
    }
}