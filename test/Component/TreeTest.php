<?php

namespace CatalinMoiceanu\XmlBuilder\Test\Component;

use CatalinMoiceanu\XmlBuilder\Component\Node;
use CatalinMoiceanu\XmlBuilder\Component\Tree;
use PHPUnit\Framework\TestCase;

class TreeTest extends TestCase
{
    /**
     * @covers \CatalinMoiceanu\XmlBuilder\Component\Tree::addNode()
     */
    public function testAddNode()
    {
        $tree = new Tree('tree');
        $node = new Node('node');
        $tree->addNode($node);

        $this->assertSame($tree, $tree->addNode($node));

        $this->expectException(\TypeError::class);
        $this->assertSame($tree, $tree->addNode(false));
    }

    /**
     * @covers \CatalinMoiceanu\XmlBuilder\Component\Tree::hasNode()
     */
    public function testHasNode()
    {
        $tree = new Tree('tree');
        $node = new Node('node');
        $orphanNode = new Node('orphanNode');

        $tree->addNode($node);

        $this->assertEquals(true, $tree->hasNode($node));
        $this->assertEquals(false, $tree->hasNode($orphanNode));
        $this->expectException(\TypeError::class);
        $this->assertEquals(false, $tree->hasNode(false));
    }

    /**
     * @covers \CatalinMoiceanu\XmlBuilder\Component\Tree::getNodes()
     * @covers \CatalinMoiceanu\XmlBuilder\Component\Tree::getValue()
     */
    public function testGetNodes()
    {
        $tree = new Tree('tree');
        $node1 = new Node('node1');
        $node2 = new Node('node2');

        $tree->addNode($node1);
        $tree->addNode($node2);

        $this->assertCount(2, $tree->getValue());
    }

    /**
     * @covers \CatalinMoiceanu\XmlBuilder\Component\Tree::removeNode()
     */
    public function testRemoveNode()
    {
        $tree = new Tree('tree');
        $node1 = new Node('node1');
        $node2 = new Node('node2');
        $node3 = new Node('node3');

        $tree->addNode($node1);
        $tree->addNode($node2);

        $this->assertCount(2, $tree->getNodes());

        $tree->removeNode($node3);
        $this->assertCount(2, $tree->getNodes());

        $tree->removeNode($node2);
        $this->assertCount(1, $tree->getNodes());

        $tree->removeNode();
        $this->assertEmpty($tree->getNodes());
    }

    /**
     * @covers \CatalinMoiceanu\XmlBuilder\Component\Tree::getValue()
     */
    public function testGetValue()
    {
        $tree = new Tree('tree');
        $node = new Node('node');
        $tree->addNode($node);

        $this->assertSame($tree, $tree->addNode($node));

        $this->expectException(\TypeError::class);
        $this->assertSame($tree, $tree->addNode(false));
    }
}