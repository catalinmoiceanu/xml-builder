<?php

namespace CatalinMoiceanu\XmlBuilder\Test\Component;

use PHPUnit\Framework\TestCase;
use CatalinMoiceanu\XmlBuilder\Component\Node;

class NodeTest extends TestCase
{
    /**
     * @covers \CatalinMoiceanu\XmlBuilder\Component\Node::__construct
     */
    public function testConstructor()
    {
        $this->assertInstanceOf(Node::class, new Node('node'));
    }

    /**
     * @covers \CatalinMoiceanu\XmlBuilder\Component\Node::getName()
     */
    public function testGetName()
    {
        $name = 'node';
        $node = new Node($name);
        $this->assertEquals($name, $node->getName());
    }

    /**
     * @covers \CatalinMoiceanu\XmlBuilder\Component\Node::setValue()
     * @covers \CatalinMoiceanu\XmlBuilder\Component\Node::getValue()
     */
    public function testSetValue()
    {
        $name = 'node';
        $value = 'value';

        $node = new Node($name);
        $node->setValue($value);

        $this->assertEquals($value, $node->getValue());
    }

    /**
     * @covers \CatalinMoiceanu\XmlBuilder\Component\Node::equals()
     */
    public function testEquals()
    {
        $node1 = new Node('node1');
        $node2 = new Node('node2');

        $this->assertTrue($node1->equals($node1));

        $this->assertFalse($node1->equals($node2));

        $this->expectException(\TypeError::class);
        $this->assertTrue($node1->equals(false));
    }
}