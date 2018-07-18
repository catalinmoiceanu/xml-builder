<?php

namespace CatalinMoiceanu\XmlBuilder\Test\Service\Converter;

use CatalinMoiceanu\XmlBuilder\Component\Node;
use CatalinMoiceanu\XmlBuilder\Component\Tree;
use CatalinMoiceanu\XmlBuilder\Service\Converter\ConvertToTree;
use PHPUnit\Framework\TestCase;

class ConvertToTreeTest extends TestCase
{
    /**
     * @covers \CatalinMoiceanu\XmlBuilder\Service\Converter\ConvertToTree::__construct()
     */
    public function testConstructor()
    {
        $converter = new ConvertToTree([
            'node' => [
                'name' => 'node-1',
                'value' => 'value 1'
            ]
        ]);
        $this->assertInstanceOf(ConvertToTree::class, $converter);

        $this->expectException(\TypeError::class);
        new ConvertToTree(false);
    }
    /**
     * @covers \CatalinMoiceanu\XmlBuilder\Service\Converter\ConvertToTree::convert()
     * @covers \CatalinMoiceanu\XmlBuilder\Service\Converter\ConvertToTree::processNode()
     *
     * @param array $input
     * @param bool $expectException
     *
     * @dataProvider dataProvider
     */
    public function testConvert(array $input, $expectException = false)
    {
        if($expectException) {
            $this->expectException(\InvalidArgumentException::class);
        }

        $converter = new ConvertToTree($input);
        $tree = $converter->convert();

        $this->assertInstanceOf(Node::class, $tree);
        $this->assertEquals('root', $tree->getName());

        $nodes = $tree->getNodes();
        $this->assertEquals('node 1', $nodes[0]->getValue());
        $this->assertInstanceOf(Node::class, $nodes[0]);
        $this->assertInstanceOf(Tree::class, $nodes[1]);

        $childNodes = $nodes[1]->getValue();
        $this->assertInternalType('array', $childNodes);
        $this->assertInstanceOf(Node::class, $childNodes[0]);
        $this->assertEquals('node 2 1', $childNodes[0]->getValue());
    }

    public function dataProvider()
    {
        return [
            'tree with no node' => [
                [],
                true
            ],
            'tree with main node without name' => [
                [
                    'node' => []
                ],
                true
            ],
            'tree with main node without value' => [
                [
                    'node' => [
                        'name' => 'root'
                    ]
                ],
                true
            ],
            'tree with invalid child node, empty value' => [
                [
                    'node' => [
                        'name' => 'root',
                        'value' => [
                            [
                                'node' => [
                                    'name' => 'node-1',
                                    'value' => 'node 1'
                                ]
                            ],
                            [
                                'node' => [
                                    'name' => 'node-2',
                                    'value' => []
                                ]
                            ]
                        ]
                    ]
                ],
                true
            ],
            'tree with invalid child node, empty array as value' => [
                [
                    'node' => [
                        'name' => 'root',
                        'value' => [
                            [
                                'node' => [
                                    'name' => 'node-1',
                                    'value' => 'node 1'
                                ]
                            ],
                            [
                                'node' => [
                                    'name' => 'node-2',
                                    'value' => [
                                        []
                                    ]
                                ]
                            ]
                        ]
                    ]
                ],
                true
            ],
            'tree with 2 levels' => [
                [
                    'node' => [
                        'name' => 'root',
                        'value' => [
                            [
                                'node' => [
                                    'name' => 'node-1',
                                    'value' => 'node 1'
                                ]
                            ],
                            [
                                'node' => [
                                    'name' => 'node-2',
                                    'value' => [
                                        [
                                            'node' => [
                                                'name' => 'node-2-1',
                                                'value' => 'node 2 1'
                                            ]
                                        ]
                                    ]
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];
    }
}