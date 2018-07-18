<?php

namespace CatalinMoiceanu\XmlBuilder\Test\Service\Converter;

use CatalinMoiceanu\XmlBuilder\Component\Node;
use CatalinMoiceanu\XmlBuilder\Component\Tree;
use CatalinMoiceanu\XmlBuilder\Service\Decorator\XmlDecorator;
use PHPUnit\Framework\TestCase;

class XmlDecoratorTest extends TestCase
{
    /**
     * @covers \CatalinMoiceanu\XmlBuilder\Service\Decorator\XmlDecorator
     *
     * @param string $expected
     * @param Node|Tree $object
     *
     * @dataProvider dataProvider
     */
    public function testDecorate($expected, $object)
    {
        $decorator = new XmlDecorator();
        $actual = $decorator->decorate($object);
        $this->assertInternalType('string', $actual);
        $this->assertEquals($expected, $actual);
    }

    /**
     * @return array
     */
    public function dataProvider()
    {
        return [
            'empty tree' => [
                '<tree></tree>',
                new Tree('tree')
            ],
            'empty node' => [
                '<node/>',
                new Node('node')
            ],
            'tree with 1 empty node' => [
                '<tree><node/></tree>',
                (new Tree('tree'))->addNode(
                    new Node('node')
                )
            ],
            'tree with 1 non-empty node' => [
                '<tree><node>value</node></tree>',
                (new Tree('tree'))->addNode(
                    (new Node('node'))->setValue('value')
                )
            ]
        ];
    }
}